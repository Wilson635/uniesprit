<?php
include_once 'config.php';

$conn = getConnexion();

// Récupérer la date depuis l'URL, ou la date d'aujourd'hui si non spécifiée
$date = $_GET['date'] ?? date('Y-m-d'); // Valeur par défaut à la date d'aujourd'hui

// Requête SQL avec un filtre de date
$sql = "
SELECT t.id AS ticket_id, t.service_date, t.appreciation, t.price AS ticket_price,
c.first_name AS client_first_name, c.last_name AS client_last_name, c.phone AS client_phone,
s.name AS service_name, e.first_name AS employee_first_name, e.last_name AS employee_last_name
FROM tickets t
JOIN clients c ON t.client_id = c.id
JOIN services s ON t.service_id = s.id
JOIN employees e ON t.employee_id = e.id
WHERE t.service_date >= :date
ORDER BY t.service_date DESC
";

$sql_vente = "SELECT v.id AS vente_id, v.date_vente AS vente_date, v.prix_unitaire AS vente_price, v.prix_total AS prix_total, v.quantite_vendue AS quantite_vendue,
b.nom AS boisson_name, b.quantite AS boisson_quantite
FROM ventes v
JOIN boissons b ON v.boisson_id = b.id
WHERE v.date_vente >= :date
ORDER BY v.date_vente DESC";

$query_boissons = "SELECT b.id as boisson_id, b.nom as boisson_nom, b.quantite as boisson_qty, b.prix_unitaire as boisson_pu, b.prix_achat as boisson_pa,  b.prix_gros as boisson_pg, c.nom as categorie FROM boissons b
JOIN categories c ON b.categorie_id = c.id
";

$stmt = $conn->prepare($sql);
$stmt_vente = $conn->prepare($sql_vente);
$stmt_boissons = $conn->prepare($query_boissons);
$stmt->bindParam(':date', $date, PDO::PARAM_STR);
$stmt_vente->bindParam(':date', $date, PDO::PARAM_STR); // Ajouter le paramètre de date
$stmt_boissons->execute();
$stmt->execute();
$stmt_vente->execute();
$tickets = $stmt->fetchAll();
$ventes = $stmt_vente->fetchAll();
$boissons = $stmt_boissons->fetchAll();

// Calcul du total des revenus
$totalRevenue = array_sum(array_column($tickets, 'ticket_price'));

// Calcul du total des ventes
$totalVente = array_sum(array_column($ventes, 'prix_total'));

$filename = "tickets&ventes_history_" . $date . ".csv"; // Ajouter la date dans le nom du fichier

header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$output = fopen('php://output', 'w');

// Définir un séparateur " ;" pour compatibilité Excel
fputcsv($output, ['Référence Ticket', 'Client', 'Client Number', 'Service Date', 'Service Name', 'Employee', 'Ticket Price'], ";");

foreach ($tickets as $ticket) {
fputcsv($output, [
$ticket['ticket_id'],
$ticket['client_first_name'] . ' ' . $ticket['client_last_name'],
$ticket['client_phone'],
$ticket['service_date'],
$ticket['service_name'],
$ticket['employee_first_name'] . ' ' . $ticket['employee_last_name'],
number_format($ticket['ticket_price'], 2, ',', '') // Formatage du prix
], ";");
}

// Ajouter une ligne vide avant le total pour la lisibilité
fputcsv($output, [], ";");

// Ajouter la ligne du total des tickets
fputcsv($output, ['Total', '', '', '', '', '', number_format($totalRevenue, 2, ',', '')], ";");

// Ajouter une ligne vide avant le total pour la lisibilité
fputcsv($output, [], ";");
// Ajouter une ligne vide avant le total pour la lisibilité
fputcsv($output, [], ";");

// Définir un séparateur " ;" pour compatibilité Excel
fputcsv($output, ['Référence Vente', 'Boisson', 'Date de vente', 'Prix de vente', 'Quantité Vendue', 'Quantité Disponible', 'Prix Total'], ";");

foreach ($ventes as $vente) {
fputcsv($output, [
$vente['vente_id'],
$vente['boisson_name'],
$vente['vente_date'],
number_format($vente['vente_price'], 2, ',', ''), // Formatage du prix
$vente['quantite_vendue'],
$vente['boisson_quantite'],
number_format($vente['prix_total'], 2, ',', '') // Formatage du prix
], ";");
}

// Ajouter une ligne vide avant le total pour la lisibilité
fputcsv($output, [], ";");

// Ajouter la ligne du total des ventes
fputcsv($output, ['Total Ventes', '', '', '', number_format($totalVente, 2, ',', ''), ''], ";");

// Ajouter une ligne vide avant le total pour la lisibilité
fputcsv($output, [], ";");
// Ajouter une ligne vide avant le total pour la lisibilité
fputcsv($output, [], ";");

// Ajouter la ligne du total des revenues
fputcsv($output, ['Total Revenues', number_format($totalRevenue + $totalVente, 2, ',', ''), ''], ";");

// Ajouter une ligne vide avant le total pour la lisibilité
fputcsv($output, [], ";");
// Ajouter une ligne vide avant le total pour la lisibilité
fputcsv($output, [], ";");

fputcsv($output, ['Stock des boissons'], ";");
// Ajouter une ligne vide avant le total pour la lisibilité
fputcsv($output, [], ";");
// Définir un séparateur " ;" pour compatibilité Excel
fputcsv($output, ['Référence Boisson', 'Nom Boisson', 'Quantité', 'Prix Unitaire', 'Prix Achat', 'Prix Gros', 'Categorie'], ";");

foreach ($boissons as $boisson) {
fputcsv($output, [
$boisson['boisson_id'],
$boisson['boisson_nom'],
$boisson['boisson_qty'],
number_format($boisson['boisson_pu'], 2, ',', ''), // Formatage du prix
number_format($boisson['boisson_pa'], 2, ',', ''), // Formatage du prix
number_format($boisson['boisson_pg'], 2, ',', ''), // Formatage du prix
$boisson['categorie']
], ";");
}



fclose($output);
exit;

