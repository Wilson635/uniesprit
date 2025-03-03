<?php
include_once 'config.php';

// Connexion à la base de données
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
$stmt = $conn->prepare($sql);
$stmt->execute();
$tickets = $stmt->fetchAll();

$filename = "tickets_history.csv";

header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$output = fopen('php://output', 'w');

fputcsv($output, ['Ticket ID', 'Client', 'Service Date', 'Service Name', 'Employee', 'Ticket Price']);

foreach ($tickets as $ticket) {
    fputcsv($output, [
        $ticket['ticket_id'],
        $ticket['client_first_name'] . ' ' . $ticket['client_last_name'],
        $ticket['service_date'],
        $ticket['service_name'],
        $ticket['employee_first_name'] . ' ' . $ticket['employee_last_name'],
        $ticket['ticket_price']
    ]);
}

fclose($output);
exit;
