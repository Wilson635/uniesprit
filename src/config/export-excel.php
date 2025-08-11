<?php
include_once 'config.php';

$conn = getConnexion();
$sql = "
    SELECT t.id AS ticket_id, t.service_date, t.appreciation, t.price AS ticket_price,
           c.first_name AS client_first_name, c.last_name AS client_last_name, c.phone AS client_phone,
           s.name AS service_name, e.first_name AS employee_first_name, e.last_name AS employee_last_name
    FROM tickets t
    JOIN clients c ON t.client_id = c.id
    JOIN services s ON t.service_id = s.id
    JOIN employees e ON t.employee_id = e.id
    WHERE t.service_date >= CURRENT_DATE
    ORDER BY t.service_date DESC
";

$sql_vente = "SELECT v.id AS vente_id, v.date_vente AS vente_date, v.prix_unitaire AS vente_price, v.prix_total AS prix_total, v.quantite_vendue AS quantite_vendue,
b.nom AS boisson_name, b.quantite AS boisson_quantite
FROM ventes v
JOIN boissons b ON v.boisson_id = b.id
WHERE v.date_vente >= CURRENT_DATE
ORDER BY v.date_vente DESC";

$stmt = $conn->prepare($sql);
$stmt_vente = $conn->prepare($sql_vente);
$stmt->execute();
$stmt_vente->execute();
$tickets = $stmt->fetchAll();
$ventes = $stmt_vente->fetchAll();

$totalTickets = array_sum(array_column($tickets, 'ticket_price'));
$totalVentes = array_sum(array_column($ventes, 'prix_total'));

$filename = "tickets_history.csv";

header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$output = fopen('php://output', 'w');

// Bloc des tickets
fputcsv($output, ['Ticket ID', 'Client', 'Service Date', 'Service Name', 'Employee', 'Ticket Price'], ";");

foreach ($tickets as $ticket) {
    fputcsv($output, [
        $ticket['ticket_id'],
        $ticket['client_first_name'] . ' ' . $ticket['client_last_name'],
        $ticket['service_date'],
        $ticket['service_name'],
        $ticket['employee_first_name'] . ' ' . $ticket['employee_last_name'],
        $ticket['ticket_price']
    ], ";");
}

fputcsv($output, ['Total ', '', '', '', '', '', number_format($totalTickets, 2, ',', '')], ";");

fputcsv($output, [], ";");
fputcsv($output, [], ";");

//Bloc des ventes
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

fputcsv($output, [], ";");

fputcsv($output, ['Total Ventes', '', '', '', number_format($totalVentes, 2, ',', ''), ''], ";");


//Bloc des boissons

fclose($output);
exit;

