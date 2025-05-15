<?php
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


include_once '../config/config.php';

$pdo = getConnexion();

// Déterminer la plage du mois en cours
$startDate = date('Y-m-01');
$endDate = date('Y-m-t');

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
