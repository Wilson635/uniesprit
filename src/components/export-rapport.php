<?php


include_once '../config/config.php';

$pdo = getConnexion();

// Déterminer le mois à analyser (mois précédent par défaut)
$moisAnalyse = isset($_GET['mois']) ? $_GET['mois'] : date('Y-m', strtotime('-1 month'));
$startDate = date('Y-m-01', strtotime($moisAnalyse));
$endDate = date('Y-m-t', strtotime($moisAnalyse));

// Calculer les dates du mois précédent pour comparaison
$moisPrecedent = date('Y-m', strtotime($startDate . ' -1 month'));
$startDatePrecedent = date('Y-m-01', strtotime($moisPrecedent));
$endDatePrecedent = date('Y-m-t', strtotime($moisPrecedent));

// ===== SECTION 1 : RÉSUMÉ EXÉCUTIF =====
$resume = [];

// Revenus du mois en cours
$queryRevenus = "
    SELECT 
        COALESCE(SUM(v.prix_total), 0) as revenus_ventes,
        COALESCE(SUM(t.price), 0) as revenus_services,
        COALESCE(SUM(v.prix_total), 0) + COALESCE(SUM(t.price), 0) as total_revenus
    FROM (SELECT 1) dummy
    LEFT JOIN ventes v ON DATE(v.date_vente) BETWEEN :start AND :end
    LEFT JOIN tickets t ON DATE(t.service_date) BETWEEN :start AND :end
";
$stmt = $pdo->prepare($queryRevenus);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
$resume['revenus'] = $stmt->fetch(PDO::FETCH_ASSOC);

// Dépenses du mois en cours
$queryDepenses = "
    SELECT 
        COALESCE(SUM(p.montant), 0) as total_depenses,
        COUNT(DISTINCT p.charge_id) as nombre_charges_payees
    FROM paiements p
    WHERE DATE(p.date_paiement) BETWEEN :start AND :end
";
$stmt = $pdo->prepare($queryDepenses);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
$resume['depenses'] = $stmt->fetch(PDO::FETCH_ASSOC);

// Calculs du mois en cours
$resume['benefice_brut'] = $resume['revenus']['total_revenus'] - $resume['depenses']['total_depenses'];
$resume['marge_brute'] = $resume['revenus']['total_revenus'] > 0
    ? ($resume['benefice_brut'] / $resume['revenus']['total_revenus']) * 100
    : 0;

// Données du mois précédent pour comparaison
$stmt->execute(['start' => $startDatePrecedent, 'end' => $endDatePrecedent]);
$depensesPrecedent = $stmt->fetch(PDO::FETCH_ASSOC);

$stmtRevenusPrecedent = $pdo->prepare($queryRevenus);
$stmtRevenusPrecedent->execute(['start' => $startDatePrecedent, 'end' => $endDatePrecedent]);
$revenusPrecedent = $stmtRevenusPrecedent->fetch(PDO::FETCH_ASSOC);

$beneficePrecedent = $revenusPrecedent['total_revenus'] - $depensesPrecedent['total_depenses'];

// Calcul des variations
$resume['variation_revenus'] = $revenusPrecedent['total_revenus'] > 0
    ? (($resume['revenus']['total_revenus'] - $revenusPrecedent['total_revenus']) / $revenusPrecedent['total_revenus']) * 100
    : 0;
$resume['variation_benefice'] = $beneficePrecedent != 0
    ? (($resume['benefice_brut'] - $beneficePrecedent) / abs($beneficePrecedent)) * 100
    : 0;

// ===== SECTION 2 : ANALYSE DES VENTES (BOISSONS) =====
$queryTopBoissons = "
    SELECT 
        b.nom as boisson_nom,
        c.nom as categorie,
        SUM(v.quantite_vendue) as quantite_totale,
        SUM(v.prix_total) as revenu_total,
        AVG(v.prix_unitaire) as prix_moyen,
        SUM(v.prix_total - (b.prix_achat * v.quantite_vendue)) as marge_totale
    FROM ventes v
    JOIN boissons b ON v.boisson_id = b.id
    JOIN categories c ON b.categorie_id = c.id
    WHERE DATE(v.date_vente) BETWEEN :start AND :end
    GROUP BY v.boisson_id, b.nom, c.nom
    ORDER BY revenu_total DESC
    LIMIT 10
";
$stmt = $pdo->prepare($queryTopBoissons);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
$topBoissons = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Ventes par catégorie
$queryVentesCategorie = "
    SELECT 
        c.nom as categorie,
        COUNT(DISTINCT v.boisson_id) as nombre_produits,
        SUM(v.quantite_vendue) as quantite_totale,
        SUM(v.prix_total) as revenu_total
    FROM ventes v
    JOIN boissons b ON v.boisson_id = b.id
    JOIN categories c ON b.categorie_id = c.id
    WHERE DATE(v.date_vente) BETWEEN :start AND :end
    GROUP BY c.id, c.nom
    ORDER BY revenu_total DESC
";
$stmt = $pdo->prepare($queryVentesCategorie);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
$ventesParCategorie = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ===== SECTION 3 : ANALYSE DES SERVICES =====
$queryTopServices = "
    SELECT 
        s.name as service_nom,
        COUNT(t.id) as nombre_prestations,
        SUM(t.price) as revenu_total,
        AVG(t.price) as prix_moyen,
        SUM(CASE WHEN t.appreciation = 'Satisfaite' THEN 1 ELSE 0 END) as satisfaits,
        SUM(CASE WHEN t.appreciation = 'Pas Satisfaite' THEN 1 ELSE 0 END) as non_satisfaits
    FROM tickets t
    JOIN services s ON t.service_id = s.id
    WHERE DATE(t.service_date) BETWEEN :start AND :end
    GROUP BY t.service_id, s.name
    ORDER BY revenu_total DESC
";
$stmt = $pdo->prepare($queryTopServices);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
$topServices = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Performance des employés
$queryPerformanceEmployes = "
    SELECT 
        CONCAT(e.first_name, ' ', e.last_name) as employe,
        e.occupation,
        COUNT(t.id) as nombre_services,
        SUM(t.price) as revenu_genere,
        AVG(t.price) as ticket_moyen,
        SUM(CASE WHEN t.appreciation = 'Satisfaite' THEN 1 ELSE 0 END) as clients_satisfaits,
        ROUND(SUM(CASE WHEN t.appreciation = 'Satisfaite' THEN 1 ELSE 0 END) * 100.0 / COUNT(t.id), 2) as taux_satisfaction
    FROM tickets t
    JOIN employees e ON t.employee_id = e.id
    WHERE DATE(t.service_date) BETWEEN :start AND :end
    GROUP BY t.employee_id, e.first_name, e.last_name, e.occupation
    ORDER BY revenu_genere DESC
";
$stmt = $pdo->prepare($queryPerformanceEmployes);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
$performanceEmployes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ===== SECTION 4 : ANALYSE DES CHARGES =====
$queryChargesParCategorie = "
    SELECT 
        cc.nom as categorie,
        COUNT(DISTINCT c.id) as nombre_charges,
        c.frequence,
        SUM(p.montant) as montant_paye,
        SUM(c.montant) as montant_total_charges
    FROM paiements p
    JOIN charges c ON p.charge_id = c.id
    JOIN categories_charges cc ON c.categorie_id = cc.id
    WHERE DATE(p.date_paiement) BETWEEN :start AND :end
    GROUP BY cc.id, cc.nom, c.frequence
    ORDER BY montant_paye DESC
";
$stmt = $pdo->prepare($queryChargesParCategorie);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
$chargesParCategorie = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Charges non payées (en retard)
$queryChargesEnRetard = "
    SELECT 
        c.nom as charge_nom,
        cc.nom as categorie,
        c.montant,
        c.date_debut,
        c.frequence,
        COALESCE(SUM(p.montant), 0) as montant_paye,
        (c.montant - COALESCE(SUM(p.montant), 0)) as reste_a_payer
    FROM charges c
    JOIN categories_charges cc ON c.categorie_id = cc.id
    LEFT JOIN paiements p ON c.id = p.charge_id AND p.statut = 'payé'
    WHERE c.date_debut <= :end
      AND (c.date_fin IS NULL OR c.date_fin >= :start)
    GROUP BY c.id, c.nom, cc.nom, c.montant, c.date_debut, c.frequence
    HAVING reste_a_payer > 0
    ORDER BY reste_a_payer DESC
";
$stmt = $pdo->prepare($queryChargesEnRetard);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
$chargesEnRetard = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ===== SECTION 5 : STATISTIQUES CLIENTS =====
$queryStatsClients = "
    SELECT 
        COUNT(DISTINCT t.client_id) as nombre_clients_actifs,
        COUNT(t.id) as nombre_total_services,
        AVG(t.price) as panier_moyen,
        SUM(t.price) as ca_total_services
    FROM tickets t
    WHERE DATE(t.service_date) BETWEEN :start AND :end
";
$stmt = $pdo->prepare($queryStatsClients);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
$statsClients = $stmt->fetch(PDO::FETCH_ASSOC);

// Top clients
$queryTopClients = "
    SELECT 
        CONCAT(c.first_name, ' ', c.last_name) as client,
        c.phone,
        COUNT(t.id) as nombre_visites,
        SUM(t.price) as montant_depense,
        AVG(t.price) as depense_moyenne
    FROM tickets t
    JOIN clients c ON t.client_id = c.id
    WHERE DATE(t.service_date) BETWEEN :start AND :end
    GROUP BY t.client_id, c.first_name, c.last_name, c.phone
    ORDER BY montant_depense DESC
    LIMIT 10
";
$stmt = $pdo->prepare($queryTopClients);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
$topClients = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ===== SECTION 6 : DONNÉES JOURNALIÈRES =====
$dataByDate = [];
$period = new DatePeriod(
    new DateTime($startDate),
    new DateInterval('P1D'),
    (new DateTime($endDate))->modify('+1 day')
);
foreach ($period as $date) {
    $day = $date->format('Y-m-d');
    $dataByDate[$day] = [
        'revenus_ventes' => 0,
        'revenus_services' => 0,
        'total_revenus' => 0,
        'depenses' => 0,
        'benefice' => 0,
        'nombre_ventes' => 0,
        'nombre_services' => 0,
    ];
}

// Ventes journalières
$queryVentes = "
    SELECT 
        DATE(date_vente) as jour, 
        SUM(prix_total) as total,
        COUNT(*) as nombre
    FROM ventes 
    WHERE DATE(date_vente) BETWEEN :start AND :end 
    GROUP BY jour
";
$stmt = $pdo->prepare($queryVentes);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
foreach ($stmt as $row) {
    $dataByDate[$row['jour']]['revenus_ventes'] = $row['total'];
    $dataByDate[$row['jour']]['total_revenus'] += $row['total'];
    $dataByDate[$row['jour']]['nombre_ventes'] = $row['nombre'];
}

// Services journaliers
$queryTickets = "
    SELECT 
        DATE(service_date) as jour, 
        SUM(price) as total,
        COUNT(*) as nombre
    FROM tickets 
    WHERE DATE(service_date) BETWEEN :start AND :end 
    GROUP BY jour
";
$stmt = $pdo->prepare($queryTickets);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
foreach ($stmt as $row) {
    $dataByDate[$row['jour']]['revenus_services'] = $row['total'];
    $dataByDate[$row['jour']]['total_revenus'] += $row['total'];
    $dataByDate[$row['jour']]['nombre_services'] = $row['nombre'];
}

// Paiements journaliers
$queryPaiements = "
    SELECT 
        DATE(date_paiement) as jour, 
        SUM(montant) as total 
    FROM paiements 
    WHERE DATE(date_paiement) BETWEEN :start AND :end 
    GROUP BY jour
";
$stmt = $pdo->prepare($queryPaiements);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
foreach ($stmt as $row) {
    $dataByDate[$row['jour']]['depenses'] = $row['total'];
}

// Calculer le bénéfice
foreach ($dataByDate as &$values) {
    $values['benefice'] = $values['total_revenus'] - $values['depenses'];
}

// ===== GÉNÉRATION DU FICHIER CSV =====
setlocale(LC_TIME, 'fr_FR.UTF-8', 'fra');
$nomMois = strftime('%B %Y', strtotime($startDate));
$filePath = 'rapport-mensuel-' . $moisAnalyse . '.csv';
$file = fopen($filePath, 'w');

if (!$file) {
    die("Erreur lors de l'ouverture du fichier CSV");
}

// BOM UTF-8 pour Excel
fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

// EN-TÊTE DU RAPPORT
fputcsv($file, ['╔═══════════════════════════════════════════════════════════╗'], ';');
fputcsv($file, ['║    RAPPORT MENSUEL - ' . strtoupper($nomMois) . '    ║'], ';');
fputcsv($file, ['╚═══════════════════════════════════════════════════════════╝'], ';');
fputcsv($file, ['Généré le : ' . date('d/m/Y à H:i')], ';');
fputcsv($file, [''], ';');

// RÉSUMÉ EXÉCUTIF
fputcsv($file, ['═══════════════════════════════════════'], ';');
fputcsv($file, ['         RÉSUMÉ EXÉCUTIF'], ';');
fputcsv($file, ['═══════════════════════════════════════'], ';');
fputcsv($file, [''], ';');
fputcsv($file, ['Indicateur', 'Montant (FCFA)', 'Variation vs mois précédent'], ';');
fputcsv($file, ['───────────────────────────────────────'], ';');
fputcsv($file, ['REVENUS TOTAUX', number_format($resume['revenus']['total_revenus'], 0, ',', ' '), number_format($resume['variation_revenus'], 2) . '%'], ';');
fputcsv($file, ['  └─ Ventes (Boissons)', number_format($resume['revenus']['revenus_ventes'], 0, ',', ' '), ''], ';');
fputcsv($file, ['  └─ Services', number_format($resume['revenus']['revenus_services'], 0, ',', ' '), ''], ';');
fputcsv($file, [''], ';');
fputcsv($file, ['DÉPENSES TOTALES', number_format($resume['depenses']['total_depenses'], 0, ',', ' '), ''], ';');
fputcsv($file, ['  └─ Nombre de charges payées', $resume['depenses']['nombre_charges_payees'], ''], ';');
fputcsv($file, [''], ';');
fputcsv($file, ['BÉNÉFICE BRUT', number_format($resume['benefice_brut'], 0, ',', ' '), number_format($resume['variation_benefice'], 2) . '%'], ';');
fputcsv($file, ['MARGE BRUTE', number_format($resume['marge_brute'], 2) . '%', ''], ';');
fputcsv($file, [''], ';');
fputcsv($file, [''], ';');

// TOP 10 BOISSONS
fputcsv($file, ['═══════════════════════════════════════'], ';');
fputcsv($file, ['    TOP 10 BOISSONS LES PLUS VENDUES'], ';');
fputcsv($file, ['═══════════════════════════════════════'], ';');
fputcsv($file, [''], ';');
fputcsv($file, ['Boisson', 'Catégorie', 'Quantité', 'Revenu (FCFA)', 'Marge (FCFA)', '% du CA'], ';');
fputcsv($file, ['───────────────────────────────────────'], ';');
foreach ($topBoissons as $boisson) {
    $pourcentage = ($boisson['revenu_total'] / $resume['revenus']['revenus_ventes']) * 100;
    fputcsv($file, [
        $boisson['boisson_nom'],
        $boisson['categorie'],
        number_format($boisson['quantite_totale'], 0, ',', ' '),
        number_format($boisson['revenu_total'], 0, ',', ' '),
        number_format($boisson['marge_totale'], 0, ',', ' '),
        number_format($pourcentage, 2) . '%'
    ], ';');
}
fputcsv($file, [''], ';');

// VENTES PAR CATÉGORIE
fputcsv($file, ['═══════════════════════════════════════'], ';');
fputcsv($file, ['       VENTES PAR CATÉGORIE'], ';');
fputcsv($file, ['═══════════════════════════════════════'], ';');
fputcsv($file, [''], ';');
fputcsv($file, ['Catégorie', 'Produits', 'Quantité totale', 'Revenu (FCFA)', '% du CA'], ';');
fputcsv($file, ['───────────────────────────────────────'], ';');
foreach ($ventesParCategorie as $cat) {
    $pourcentage = ($cat['revenu_total'] / $resume['revenus']['revenus_ventes']) * 100;
    fputcsv($file, [
        $cat['categorie'],
        $cat['nombre_produits'],
        number_format($cat['quantite_totale'], 0, ',', ' '),
        number_format($cat['revenu_total'], 0, ',', ' '),
        number_format($pourcentage, 2) . '%'
    ], ';');
}
fputcsv($file, [''], ';');
fputcsv($file, [''], ';');

// TOP SERVICES
fputcsv($file, ['═══════════════════════════════════════'], ';');
fputcsv($file, ['    SERVICES LES PLUS DEMANDÉS'], ';');
fputcsv($file, ['═══════════════════════════════════════'], ';');
fputcsv($file, [''], ';');
fputcsv($file, ['Service', 'Prestations', 'Revenu (FCFA)', 'Prix moyen', 'Satisfaits', 'Non satisfaits', 'Taux satisfaction'], ';');
fputcsv($file, ['───────────────────────────────────────'], ';');
foreach ($topServices as $service) {
    $tauxSatisfaction = $service['nombre_prestations'] > 0
        ? ($service['satisfaits'] / $service['nombre_prestations']) * 100
        : 0;
    fputcsv($file, [
        $service['service_nom'],
        $service['nombre_prestations'],
        number_format($service['revenu_total'], 0, ',', ' '),
        number_format($service['prix_moyen'], 0, ',', ' '),
        $service['satisfaits'],
        $service['non_satisfaits'],
        number_format($tauxSatisfaction, 2) . '%'
    ], ';');
}
fputcsv($file, [''], ';');
fputcsv($file, [''], ';');

// PERFORMANCE EMPLOYÉS
fputcsv($file, ['═══════════════════════════════════════'], ';');
fputcsv($file, ['       PERFORMANCE DES EMPLOYÉS'], ';');
fputcsv($file, ['═══════════════════════════════════════'], ';');
fputcsv($file, [''], ';');
fputcsv($file, ['Employé', 'Poste', 'Services', 'Revenu généré', 'Ticket moyen', 'Taux satisfaction'], ';');
fputcsv($file, ['───────────────────────────────────────'], ';');
foreach ($performanceEmployes as $emp) {
    fputcsv($file, [
        $emp['employe'],
        $emp['occupation'],
        $emp['nombre_services'],
        number_format($emp['revenu_genere'], 0, ',', ' '),
        number_format($emp['ticket_moyen'], 0, ',', ' '),
        number_format($emp['taux_satisfaction'], 2) . '%'
    ], ';');
}
fputcsv($file, [''], ';');
fputcsv($file, [''], ';');

// CHARGES PAR CATÉGORIE
fputcsv($file, ['═══════════════════════════════════════'], ';');
fputcsv($file, ['      RÉPARTITION DES CHARGES'], ';');
fputcsv($file, ['═══════════════════════════════════════'], ';');
fputcsv($file, [''], ';');
fputcsv($file, ['Catégorie', 'Fréquence', 'Nombre charges', 'Montant payé (FCFA)', '% du total'], ';');
fputcsv($file, ['───────────────────────────────────────'], ';');
foreach ($chargesParCategorie as $charge) {
    $pourcentage = ($charge['montant_paye'] / $resume['depenses']['total_depenses']) * 100;
    fputcsv($file, [
        $charge['categorie'],
        $charge['frequence'],
        $charge['nombre_charges'],
        number_format($charge['montant_paye'], 0, ',', ' '),
        number_format($pourcentage, 2) . '%'
    ], ';');
}
fputcsv($file, [''], ';');
fputcsv($file, [''], ';');

// CHARGES EN RETARD
if (count($chargesEnRetard) > 0) {
    fputcsv($file, ['═══════════════════════════════════════'], ';');
    fputcsv($file, ['    ⚠️  CHARGES NON SOLDÉES  ⚠️'], ';');
    fputcsv($file, ['═══════════════════════════════════════'], ';');
    fputcsv($file, [''], ';');
    fputcsv($file, ['Charge', 'Catégorie', 'Montant total', 'Déjà payé', 'Reste à payer', 'Fréquence'], ';');
    fputcsv($file, ['───────────────────────────────────────'], ';');
    foreach ($chargesEnRetard as $charge) {
        fputcsv($file, [
            $charge['charge_nom'],
            $charge['categorie'],
            number_format($charge['montant'], 0, ',', ' '),
            number_format($charge['montant_paye'], 0, ',', ' '),
            number_format($charge['reste_a_payer'], 0, ',', ' '),
            $charge['frequence']
        ], ';');
    }
    fputcsv($file, [''], ';');
    fputcsv($file, [''], ';');
}

// STATISTIQUES CLIENTS
fputcsv($file, ['═══════════════════════════════════════'], ';');
fputcsv($file, ['        STATISTIQUES CLIENTS'], ';');
fputcsv($file, ['═══════════════════════════════════════'], ';');
fputcsv($file, [''], ';');
fputcsv($file, ['Nombre de clients actifs', $statsClients['nombre_clients_actifs']], ';');
fputcsv($file, ['Nombre total de services rendus', $statsClients['nombre_total_services']], ';');
fputcsv($file, ['Panier moyen', number_format($statsClients['panier_moyen'], 0, ',', ' ') . ' FCFA'], ';');
fputcsv($file, [''], ';');

// TOP CLIENTS
fputcsv($file, ['Top 10 Clients'], ';');
fputcsv($file, ['───────────────────────────────────────'], ';');
fputcsv($file, ['Client', 'Téléphone', 'Visites', 'Total dépensé', 'Dépense moyenne'], ';');
foreach ($topClients as $client) {
    fputcsv($file, [
        $client['client'],
        $client['phone'],
        $client['nombre_visites'],
        number_format($client['montant_depense'], 0, ',', ' '),
        number_format($client['depense_moyenne'], 0, ',', ' ')
    ], ';');
}
fputcsv($file, [''], ';');
fputcsv($file, [''], ';');

// DÉTAILS JOURNALIERS
fputcsv($file, ['═══════════════════════════════════════'], ';');
fputcsv($file, ['        DÉTAILS JOURNALIERS'], ';');
fputcsv($file, ['═══════════════════════════════════════'], ';');
fputcsv($file, [''], ';');
fputcsv($file, ['Date', 'Ventes', 'Services', 'Total Revenus', 'Dépenses', 'Bénéfice', 'Nb Ventes', 'Nb Services'], ';');
fputcsv($file, ['───────────────────────────────────────'], ';');

foreach ($dataByDate as $date => $values) {
    fputcsv($file, [
        date('d/m/Y (D)', strtotime($date)),
        number_format($values['revenus_ventes'], 0, ',', ' '),
        number_format($values['revenus_services'], 0, ',', ' '),
        number_format($values['total_revenus'], 0, ',', ' '),
        number_format($values['depenses'], 0, ',', ' '),
        number_format($values['benefice'], 0, ',', ' '),
        $values['nombre_ventes'],
        $values['nombre_services']
    ], ';');
}

fputcsv($file, [''], ';');
fputcsv($file, ['╔═══════════════════════════════════════════════════════════╗'], ';');
fputcsv($file, ['║                   FIN DU RAPPORT                          ║'], ';');
fputcsv($file, ['╚═══════════════════════════════════════════════════════════╝'], ';');

fclose($file);

// Télécharger le fichier
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="rapport-mensuel-' . $moisAnalyse . '.csv"');
readfile($filePath);

// Supprimer le fichier temporaire (optionnel)
unlink($filePath);

exit();

/****

include_once '../config/config.php';

$pdo = getConnexion();

// Déterminer le mois à analyser (mois précédent par défaut)
$moisAnalyse = $_GET['mois'] ?? date('Y-m', strtotime('-1 month'));
$startDate = date('Y-m-01', strtotime($moisAnalyse));
$endDate = date('Y-m-t', strtotime($moisAnalyse));

// Calculer les dates du mois précédent pour comparaison
$moisPrecedent = date('Y-m', strtotime($startDate . ' -1 month'));
$startDatePrecedent = date('Y-m-01', strtotime($moisPrecedent));
$endDatePrecedent = date('Y-m-t', strtotime($moisPrecedent));

// ===== SECTION 1 : RÉSUMÉ EXÉCUTIF =====
$resume = [];

// Revenus du mois en cours
$queryRevenus = "
    SELECT 
        COALESCE(SUM(v.prix_total), 0) + COALESCE(SUM(t.price), 0) as total_revenus,
        COALESCE(SUM(v.prix_total), 0) as revenus_ventes,
        COALESCE(SUM(t.price), 0) as revenus_tickets
    FROM (SELECT 1) dummy
    LEFT JOIN ventes v ON DATE(v.date_vente) BETWEEN :start AND :end
    LEFT JOIN tickets t ON DATE(t.service_date) BETWEEN :start AND :end
";
$stmt = $pdo->prepare($queryRevenus);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
$resume['revenus'] = $stmt->fetch(PDO::FETCH_ASSOC);

// Dépenses du mois en cours
$queryDepenses = "
    SELECT 
        COALESCE(SUM(c.montant), 0) as charges,
        COALESCE(SUM(p.montant), 0) as paiements,
        COALESCE(SUM(c.montant), 0) + COALESCE(SUM(p.montant), 0) as total_depenses
    FROM (SELECT 1) dummy
    LEFT JOIN charges c ON DATE(c.date_debut) BETWEEN :start AND :end
    LEFT JOIN paiements p ON DATE(p.date_paiement) BETWEEN :start AND :end
";
$stmt = $pdo->prepare($queryDepenses);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
$resume['depenses'] = $stmt->fetch(PDO::FETCH_ASSOC);

// Calculs du mois en cours
$resume['benefice_brut'] = $resume['revenus']['total_revenus'] - $resume['depenses']['total_depenses'];
$resume['marge_brute'] = $resume['revenus']['total_revenus'] > 0
    ? ($resume['benefice_brut'] / $resume['revenus']['total_revenus']) * 100
    : 0;

// Données du mois précédent pour comparaison
$stmt->execute(['start' => $startDatePrecedent, 'end' => $endDatePrecedent]);
$depensesPrecedent = $stmt->fetch(PDO::FETCH_ASSOC);

$queryRevenusPrecedent = $pdo->prepare($queryRevenus);
$queryRevenusPrecedent->execute(['start' => $startDatePrecedent, 'end' => $endDatePrecedent]);
$revenusPrecedent = $queryRevenusPrecedent->fetch(PDO::FETCH_ASSOC);

$beneficePrecedent = $revenusPrecedent['total_revenus'] - $depensesPrecedent['total_depenses'];

// Calcul des variations
$resume['variation_revenus'] = $revenusPrecedent['total_revenus'] > 0
    ? (($resume['revenus']['total_revenus'] - $revenusPrecedent['total_revenus']) / $revenusPrecedent['total_revenus']) * 100
    : 0;
$resume['variation_benefice'] = $beneficePrecedent != 0
    ? (($resume['benefice_brut'] - $beneficePrecedent) / abs($beneficePrecedent)) * 100
    : 0;

// ===== SECTION 2 : DÉTAILS PAR CATÉGORIE =====
// Top 5 des produits/services les plus vendus
$queryTopProduits = "
    SELECT 
        v.boisson_id,
        p.nom as produit_nom,
        SUM(v.quantite_vendue) as quantite_totale,
        SUM(v.prix_total) as revenu_total
    FROM ventes v
    JOIN boissons p ON v.boisson_id = p.id
    WHERE DATE(v.date_vente) BETWEEN :start AND :end
    GROUP BY v.boisson_id, p.nom
    ORDER BY revenu_total DESC
    LIMIT 5
";
$stmt = $pdo->prepare($queryTopProduits);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
$topProduits = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Répartition des dépenses par type
$queryDepensesDetaillees = "
    SELECT 
        c.categorie_id,
        SUM(c.montant) as montant_total,
        COUNT(*) as nombre
    FROM charges c
    WHERE DATE(c.date_debut) BETWEEN :start AND :end
    GROUP BY c.categorie_id
    ORDER BY montant_total DESC
";
$stmt = $pdo->prepare($queryDepensesDetaillees);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
$depensesDetaillees = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ===== SECTION 3 : ANALYSE PAR SEMAINE =====
$queryParSemaine = "
    SELECT 
        WEEK(date_vente, 1) as semaine,
        SUM(prix_total) as revenus_ventes
    FROM ventes
    WHERE DATE(date_vente) BETWEEN :start AND :end
    GROUP BY semaine
    ORDER BY semaine
";
$stmt = $pdo->prepare($queryParSemaine);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
$donneesParSemaine = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ===== SECTION 4 : DONNÉES JOURNALIÈRES =====
$dataByDate = [];
$period = new DatePeriod(
    new DateTime($startDate),
    new DateInterval('P1D'),
    (new DateTime($endDate))->modify('+1 day')
);
foreach ($period as $date) {
    $day = $date->format('Y-m-d');
    $dataByDate[$day] = [
        'revenus_ventes' => 0,
        'revenus_tickets' => 0,
        'total_revenus' => 0,
        'charges' => 0,
        'paiements' => 0,
        'total_depenses' => 0,
        'benefice' => 0,
    ];
}

// Ventes journalières
$queryVentes = "SELECT DATE(date_vente) as jour, SUM(prix_total) as total 
                FROM ventes 
                WHERE DATE(date_vente) BETWEEN :start AND :end 
                GROUP BY jour";
$stmt = $pdo->prepare($queryVentes);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
foreach ($stmt as $row) {
    $dataByDate[$row['jour']]['revenus_ventes'] = $row['total'];
    $dataByDate[$row['jour']]['total_revenus'] += $row['total'];
}

// Tickets journaliers
$queryTickets = "SELECT DATE(service_date) as jour, SUM(price) as total 
                 FROM tickets 
                 WHERE DATE(service_date) BETWEEN :start AND :end 
                 GROUP BY jour";
$stmt = $pdo->prepare($queryTickets);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
foreach ($stmt as $row) {
    $dataByDate[$row['jour']]['revenus_tickets'] = $row['total'];
    $dataByDate[$row['jour']]['total_revenus'] += $row['total'];
}

// Charges journalières
$queryCharges = "SELECT DATE(date_debut) as jour, SUM(montant) as total 
                 FROM charges 
                 WHERE DATE(date_debut) BETWEEN :start AND :end 
                 GROUP BY jour";
$stmt = $pdo->prepare($queryCharges);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
foreach ($stmt as $row) {
    $dataByDate[$row['jour']]['charges'] = $row['total'];
    $dataByDate[$row['jour']]['total_depenses'] += $row['total'];
}

// Paiements journaliers
$queryPaiements = "SELECT DATE(date_paiement) as jour, SUM(montant) as total 
                   FROM paiements 
                   WHERE DATE(date_paiement) BETWEEN :start AND :end 
                   GROUP BY jour";
$stmt = $pdo->prepare($queryPaiements);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
foreach ($stmt as $row) {
    $dataByDate[$row['jour']]['paiements'] = $row['total'];
    $dataByDate[$row['jour']]['total_depenses'] += $row['total'];
}

// Calculer le bénéfice
foreach ($dataByDate as &$values) {
    $values['benefice'] = $values['total_revenus'] - $values['total_depenses'];
}

// ===== GÉNÉRATION DU FICHIER CSV =====
$nomMois = strftime('%B %Y', strtotime($startDate));
$filePath = 'rapport-mensuel-' . $moisAnalyse . '.csv';
$file = fopen($filePath, 'w');

if (!$file) {
    die("Erreur lors de l'ouverture du fichier CSV");
}

// BOM UTF-8 pour Excel
fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

// EN-TÊTE DU RAPPORT
fputcsv($file, ['RAPPORT MENSUEL - ' . strtoupper($nomMois)], ';');
fputcsv($file, ['Généré le : ' . date('d/m/Y à H:i')], ';');
fputcsv($file, [''], ';');

// RÉSUMÉ EXÉCUTIF
fputcsv($file, ['=== RÉSUMÉ EXÉCUTIF ==='], ';');
fputcsv($file, [''], ';');
fputcsv($file, ['Indicateur', 'Montant (FCFA)', 'Variation vs mois précédent'], ';');
fputcsv($file, ['Revenus totaux', number_format($resume['revenus']['total_revenus'], 0, ',', ' '), number_format($resume['variation_revenus'], 2) . '%'], ';');
fputcsv($file, ['  - Ventes', number_format($resume['revenus']['revenus_ventes'], 0, ',', ' ')], ';');
fputcsv($file, ['  - Tickets/Services', number_format($resume['revenus']['revenus_tickets'], 0, ',', ' ')], ';');
fputcsv($file, ['Dépenses totales', number_format($resume['depenses']['total_depenses'], 0, ',', ' ')], ';');
fputcsv($file, ['  - Charges', number_format($resume['depenses']['charges'], 0, ',', ' ')], ';');
fputcsv($file, ['  - Paiements', number_format($resume['depenses']['paiements'], 0, ',', ' ')], ';');
fputcsv($file, ['Bénéfice brut', number_format($resume['benefice_brut'], 0, ',', ' '), number_format($resume['variation_benefice'], 2) . '%'], ';');
fputcsv($file, ['Marge brute (%)', number_format($resume['marge_brute'], 2) . '%'], ';');
fputcsv($file, [''], ';');

// TOP PRODUITS
fputcsv($file, ['=== TOP 5 PRODUITS/SERVICES ==='], ';');
fputcsv($file, [''], ';');
fputcsv($file, ['Produit', 'Quantité vendue', 'Revenu généré (FCFA)', '% du CA'], ';');
foreach ($topProduits as $produit) {
    $pourcentage = ($produit['revenu_total'] / $resume['revenus']['total_revenus']) * 100;
    fputcsv($file, [
        $produit['produit_nom'],
        $produit['quantite_totale'],
        number_format($produit['revenu_total'], 0, ',', ' '),
        number_format($pourcentage, 2) . '%'
    ], ';');
}
fputcsv($file, [''], ';');

// RÉPARTITION DES DÉPENSES
fputcsv($file, ['=== RÉPARTITION DES DÉPENSES ==='], ';');
fputcsv($file, [''], ';');
fputcsv($file, ['Type de dépense', 'Montant (FCFA)', 'Nombre', '% du total'], ';');
foreach ($depensesDetaillees as $depense) {
    $pourcentage = ($depense['montant_total'] / $resume['depenses']['total_depenses']) * 100;
    fputcsv($file, [
        $depense['type_charge'],
        number_format($depense['montant_total'], 0, ',', ' '),
        $depense['nombre'],
        number_format($pourcentage, 2) . '%'
    ], ';');
}
fputcsv($file, [''], ';');

// DÉTAILS JOURNALIERS
fputcsv($file, ['=== DÉTAILS JOURNALIERS ==='], ';');
fputcsv($file, [''], ';');
fputcsv($file, ['Date', 'Revenus Ventes', 'Revenus Tickets', 'Total Revenus', 'Charges', 'Paiements', 'Total Dépenses', 'Bénéfice Net'], ';');

unset($values);
foreach ($dataByDate as $date => $values) {
    fputcsv($file, [
        date('d/m/Y', strtotime($date)),
        number_format($values['revenus_ventes'], 0, ',', ' '),
        number_format($values['revenus_tickets'], 0, ',', ' '),
        number_format($values['total_revenus'], 0, ',', ' '),
        number_format($values['charges'], 0, ',', ' '),
        number_format($values['paiements'], 0, ',', ' '),
        number_format($values['total_depenses'], 0, ',', ' '),
        number_format($values['benefice'], 0, ',', ' ')
    ], ';');
}

fputcsv($file, [''], ';');
fputcsv($file, ['=== FIN DU RAPPORT ==='], ';');

fclose($file);

// Télécharger le fichier
header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="rapport-mensuel-' . $moisAnalyse . '.csv"');
readfile($filePath);

// Supprimer le fichier temporaire (optionnel)
// unlink($filePath);

exit();




//
//// Connexion à la base de données
//include_once '../config/config.php';
//
//$pdo = getConnexion();
//
//// Fonction pour écrire une table dans un fichier CSV avec le séparateur ";"
//function writeTableToCSV($pdo, $table, $file)
//{
//    $stmt = $pdo->query("SELECT * FROM $table");
//    $columns = array_keys($stmt->fetch(PDO::FETCH_ASSOC));
//
//    // Ajouter un séparateur entre les tables
//    fputcsv($file, [] , ';');
//    fputcsv($file, ["Table: $table"], ';');
//    fputcsv($file, $columns, ';');
//
//    // Réexécuter la requête pour récupérer les données
//    $stmt = $pdo->query("SELECT * FROM $table");
//    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//        fputcsv($file, $row, ';');
//    }
//}
//
//// Ouvrir le fichier CSV en écriture
//$filePath = 'rapport-global.csv';
//$file = fopen($filePath, 'w');
//
//if (!$file) {
//    die("Erreur lors de l'ouverture du fichier CSV");
//}
//
//// Liste des tables à traiter
//$tables = ['users', 'employees', 'clients', 'services', 'tickets', 'boissons', 'categories', 'ventes', 'categories_charges', 'charges', 'paiements'];
//
//// Ajouter les tables dans le fichier CSV
//foreach ($tables as $table) {
//    writeTableToCSV($pdo, $table, $file);
//}
//
//// Fonction pour ajouter les revenus au fichier CSV
//function writeRevenueToCSV($pdo, $queries, $file, $title, &$totalRevenues)
//{
//    fputcsv($file, [], ';');
//    fputcsv($file, [$title], ';');
//    fputcsv($file, ['Période', 'Type', 'Revenu'], ';');
//
//    foreach ($queries as $type => $query) {
//        $stmt = $pdo->query($query);
//        $sum = 0;
//        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//            fputcsv($file, [$row['periode'], $type, $row['revenu']], ';');
//            $sum += $row['revenu'];
//        }
//        $totalRevenues[$type] += $sum;
//    }
//}
//
//$totalRevenues = ['Journalier' => 0, 'Hebdomadaire' => 0, 'Mensuel' => 0, 'Trimestriel' => 0, 'Annuel' => 0];
//
//// Ajouter les revenus des ventes
//$queriesVentes = [
//    'Journalier' => "SELECT DATE(date_vente) as periode, SUM(prix_total) as revenu FROM ventes GROUP BY DATE(date_vente)",
//    'Hebdomadaire' => "SELECT YEARWEEK(date_vente) as periode, SUM(prix_total) as revenu FROM ventes GROUP BY YEARWEEK(date_vente)",
//    'Mensuel' => "SELECT DATE_FORMAT(date_vente, '%Y-%m') as periode, SUM(prix_total) as revenu FROM ventes GROUP BY DATE_FORMAT(date_vente, '%Y-%m')",
//    'Trimestriel' => "SELECT CONCAT(YEAR(date_vente), '-T', QUARTER(date_vente)) as periode, SUM(prix_total) as revenu FROM ventes GROUP BY YEAR(date_vente), QUARTER(date_vente)",
//    'Annuel' => "SELECT YEAR(date_vente) as periode, SUM(prix_total) as revenu FROM ventes GROUP BY YEAR(date_vente)"
//];
//
//writeRevenueToCSV($pdo, $queriesVentes, $file, 'Revenus des Ventes', $totalRevenues);
//
//// Ajouter les revenus des tickets
//$queriesTickets = [
//    'Journalier' => "SELECT DATE(service_date) as periode, SUM(price) as revenu FROM tickets GROUP BY DATE(service_date)",
//    'Hebdomadaire' => "SELECT YEARWEEK(service_date) as periode, SUM(price) as revenu FROM tickets GROUP BY YEARWEEK(service_date)",
//    'Mensuel' => "SELECT DATE_FORMAT(service_date, '%Y-%m') as periode, SUM(price) as revenu FROM tickets GROUP BY DATE_FORMAT(service_date, '%Y-%m')",
//    'Trimestriel' => "SELECT CONCAT(YEAR(service_date), '-T', QUARTER(service_date)) as periode, SUM(price) as revenu FROM tickets GROUP BY YEAR(service_date), QUARTER(service_date)",
//    'Annuel' => "SELECT YEAR(service_date) as periode, SUM(price) as revenu FROM tickets GROUP BY YEAR(service_date)"
//];
//
//writeRevenueToCSV($pdo, $queriesTickets, $file, 'Revenus des Tickets', $totalRevenues);
//
//// Ajouter le total des revenus par période
//fputcsv($file, [], ';');
//fputcsv($file, ['Total des Revenus par Période'], ';');
//fputcsv($file, ['Période', 'Total Revenu'], ';');
//
//foreach ($totalRevenues as $periode => $total) {
//    fputcsv($file, [$periode, $total], ';');
//}
//
//// Fermer le fichier
//fclose($file);
//
//// Télécharger le fichier CSV
//header('Content-Type: text/csv');
//header('Content-Disposition: attachment; filename="rapport-global.csv"');
//readfile($filePath);
//exit();


// Connexion à la base de données
/* include_once '../config/config.php';

$pdo = getConnexion();

// Ouvrir le fichier CSV en écriture
$filePath = 'rapport-global.csv';
$file = fopen($filePath, 'w');
if (!$file) {
    die("Erreur lors de l'ouverture du fichier CSV");
}

// Écrire l'en-tête du fichier CSV
fputcsv($file, ['Date', 'Client', 'Téléphone', 'Catégorie', 'Prestations', 'Prix', 'Dépenses', 'Bénéfice'], ';');

// Requête pour récupérer les ventes avec les informations des clients
$queryVentes = "SELECT v.date_vente AS date, COALESCE(c.first_name, '') || ' ' || COALESCE(c.last_name, '') AS client, c.phone AS telephone, 'Boissons' AS categorie, b.nom AS prestations, v.prix_total AS prix, 0 AS depenses 
                FROM ventes v
                JOIN boissons b ON v.boisson_id = b.id
                LEFT JOIN clients c ON c.id = (SELECT client_id FROM tickets t WHERE t.id = v.id LIMIT 1)";
$ventes = $pdo->query($queryVentes);

// Requête pour récupérer les tickets
$queryTickets = "SELECT t.service_date AS date, CONCAT(c.first_name, ' ', c.last_name) AS client, c.phone AS telephone, 'Institut' AS categorie, s.name AS prestations, t.price AS prix, 0 AS depenses 
                 FROM tickets t
                 JOIN clients c ON t.client_id = c.id
                 JOIN services s ON t.service_id = s.id";
$tickets = $pdo->query($queryTickets);

// Requête pour récupérer les charges
$queryCharges = "SELECT ch.date_debut AS date, '' AS client, '' AS telephone, 'Dépenses' AS categorie, ch.nom AS prestations, 0 AS prix, ch.montant AS depenses 
                 FROM charges ch";
$charges = $pdo->query($queryCharges);

// Fusionner et écrire les données dans le fichier CSV
$rows = [];
foreach ($ventes as $vente) {
    $vente['benefice'] = $vente['prix'] - $vente['depenses'];
    $rows[] = $vente;
}
foreach ($tickets as $ticket) {
    $ticket['benefice'] = $ticket['prix'] - $ticket['depenses'];
    $rows[] = $ticket;
}
foreach ($charges as $charge) {
    $charge['benefice'] = $charge['prix'] - $charge['depenses'];
    $rows[] = $charge;
}

// Trier les données par date
usort($rows, function ($a, $b) {
    return strtotime($a['date']) - strtotime($b['date']);
});

// Écrire les lignes dans le fichier CSV
foreach ($rows as $row) {
    fputcsv($file, $row, ';');
}

// Fermer le fichier
fclose($file);

// Télécharger le fichier CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="rapport-global.csv"');
readfile($filePath);
exit();
*/

/***
include_once '../config/config.php';

$pdo = getConnexion();

// Déterminer la plage du mois en cours
$startDate = date('2025-06-01');
$endDate = date('2025-06-30');

// Créer une structure pour stocker les données par date
$dataByDate = [];

// Initialiser toutes les dates du mois
$period = new DatePeriod(
    new DateTime($startDate),
    new DateInterval('P1D'),
    (new DateTime($endDate))->modify('+1 day')
);
foreach ($period as $date) {
    $day = $date->format('Y-m-d');
    $dataByDate[$day] = [
        'revenus' => 0,
        'depenses' => 0,
        'benefice' => 0,
    ];
}

// Récupérer les ventes dans le mois
$queryVentes = "SELECT DATE(date_vente) as jour, SUM(prix_total) as total 
                FROM ventes 
                WHERE date_vente BETWEEN :start AND :end 
                GROUP BY jour";
$stmt = $pdo->prepare($queryVentes);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
foreach ($stmt as $row) {
    $jour = $row['jour'];
    $dataByDate[$jour]['revenus'] += $row['total'];
}

// Récupérer les tickets dans le mois
$queryTickets = "SELECT DATE(service_date) as jour, SUM(price) as total 
                 FROM tickets 
                 WHERE service_date BETWEEN :start AND :end 
                 GROUP BY jour";
$stmt = $pdo->prepare($queryTickets);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
foreach ($stmt as $row) {
    $jour = $row['jour'];
    $dataByDate[$jour]['revenus'] += $row['total'];
}

// Récupérer les charges dans le mois
$queryCharges = "SELECT DATE(date_debut) as jour, SUM(montant) as total 
                 FROM charges 
                 WHERE date_debut BETWEEN :start AND :end 
                 GROUP BY jour";
$stmt = $pdo->prepare($queryCharges);
$stmt->execute(['start' => $startDate, 'end' => $endDate]);
foreach ($stmt as $row) {
    $jour = $row['jour'];
    $dataByDate[$jour]['depenses'] += $row['total'];
}

// Calculer le bénéfice pour chaque jour
foreach ($dataByDate as $jour => &$values) {
    $values['benefice'] = $values['revenus'] - $values['depenses'];
}

// Générer le fichier CSV
$filePath = 'etat-mensuel.csv';
$file = fopen($filePath, 'w');

if (!$file) {
    die("Erreur lors de l'ouverture du fichier CSV");
}

fputcsv($file, ['Date', 'Revenus', 'Dépenses', 'Bénéfice'], ';');

foreach ($dataByDate as $date => $values) {
    fputcsv($file, [$date, $values['revenus'], $values['depenses'], $values['benefice']], ';');
}

fclose($file);

// Télécharger le fichier
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="etat-mensuel.csv"');
readfile($filePath);
exit();
*/