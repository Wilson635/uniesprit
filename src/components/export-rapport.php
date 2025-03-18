<?php

// Connexion à la base de données
include_once '../config/config.php';

$pdo = getConnexion();

// Fonction pour écrire une table dans un fichier CSV avec le séparateur ";"
function writeTableToCSV($pdo, $table, $file) {
    $stmt = $pdo->query("SELECT * FROM $table");
    $columns = array_keys($stmt->fetch(PDO::FETCH_ASSOC));

    // Ajouter un séparateur entre les tables
    fputcsv($file, [], ';');
    fputcsv($file, ["Table: $table"], ';');
    fputcsv($file, $columns, ';');

    // Ajouter les données
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($file, $row, ';');
    }
}

// Ouvrir le fichier CSV en écriture
$file = fopen('rapport-global.csv', 'w');

// Liste des tables à traiter
$tables = ['users', 'employees', 'clients', 'services', 'tickets', 'reservations', 'boissons', 'categories', 'ventes', 'categories_charges', 'charges', 'paiements'];

// Ajouter les tables dans le fichier CSV
foreach ($tables as $table) {
    writeTableToCSV($pdo, $table, $file);
}

// Ajouter les revenus dans le même fichier CSV
$queries = [
    'Journalier' => "SELECT DATE(date_vente) as periode, SUM(prix_total) as revenu FROM ventes GROUP BY DATE(date_vente)",
    'Hebdomadaire' => "SELECT YEARWEEK(date_vente) as periode, SUM(prix_total) as revenu FROM ventes GROUP BY YEARWEEK(date_vente)",
    'Mensuel' => "SELECT DATE_FORMAT(date_vente, '%Y-%m') as periode, SUM(prix_total) as revenu FROM ventes GROUP BY DATE_FORMAT(date_vente, '%Y-%m')",
    'Trimestriel' => "SELECT CONCAT(YEAR(date_vente), '-T', QUARTER(date_vente)) as periode, SUM(prix_total) as revenu FROM ventes GROUP BY YEAR(date_vente), QUARTER(date_vente)",
    'Annuel' => "SELECT YEAR(date_vente) as periode, SUM(prix_total) as revenu FROM ventes GROUP BY YEAR(date_vente)"
];

// Ajouter les revenus dans le fichier CSV
fputcsv($file, [], ';');
fputcsv($file, ['Revenus'], ';');
fputcsv($file, ['Période', 'Type', 'Revenu'], ';');

foreach ($queries as $type => $query) {
    $stmt = $pdo->query($query);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($file, [$row['periode'], $type, $row['revenu']], ';');
    }
}

fclose($file);

// Télécharger le fichier CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="rapport-global.csv"');
readfile('rapport-global.csv');
exit();
