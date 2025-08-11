<?php
header('Content-Type: application/json');
include_once '../config/config.php';
$conn = getConnexion();

$action = $_GET['action'] ?? '';

if ($action === 'getMonths') {
    // Récupérer la liste des mois disponibles
    $sql = "
        SELECT DISTINCT DATE_FORMAT(date_vente, '%Y-%m') AS mois FROM ventes
        UNION
        SELECT DISTINCT DATE_FORMAT(service_date, '%Y-%m') AS mois FROM tickets
        UNION
        SELECT DISTINCT DATE_FORMAT(date_paiement, '%Y-%m') AS mois FROM paiements
        ORDER BY mois DESC
    ";
    $rows = $conn->query($sql)->fetchAll(PDO::FETCH_COLUMN);
    $months = array_map(function($m) {
        return [
            'value' => $m,
            'label' => date('F Y', strtotime($m . '-01'))
        ];
    }, $rows);
    echo json_encode($months);
    exit;
}

if ($action === 'getData') {
    $mois = $_GET['mois'] ?? date('Y-m');
    $jours = [];
    $ventes = [];
    $tickets = [];
    $depenses = [];

    $nbJours = date('t', strtotime($mois . '-01'));
    for ($j = 1; $j <= $nbJours; $j++) {
        $jours[] = str_pad($j, 2, '0', STR_PAD_LEFT);
        $ventes[] = 0;
        $tickets[] = 0;
        $depenses[] = 0;
    }

    // Requêtes pour ventes
    $sqlVentes = "SELECT DAY(date_vente) AS jour, SUM(prix_total) AS total 
                  FROM ventes WHERE DATE_FORMAT(date_vente, '%Y-%m') = :mois GROUP BY jour";
    $stmt = $conn->prepare($sqlVentes);
    $stmt->execute(['mois' => $mois]);
    foreach ($stmt as $row) {
        $ventes[$row['jour'] - 1] = (float) $row['total'];
    }

    // Tickets
    $sqlTickets = "SELECT DAY(service_date) AS jour, SUM(price) AS total 
                   FROM tickets WHERE DATE_FORMAT(service_date, '%Y-%m') = :mois GROUP BY jour";
    $stmt = $conn->prepare($sqlTickets);
    $stmt->execute(['mois' => $mois]);
    foreach ($stmt as $row) {
        $tickets[$row['jour'] - 1] = (float) $row['total'];
    }

    // Dépenses
    $sqlDepenses = "SELECT DAY(date_paiement) AS jour, SUM(montant) AS total 
                    FROM paiements WHERE DATE_FORMAT(date_paiement, '%Y-%m') = :mois GROUP BY jour";
    $stmt = $conn->prepare($sqlDepenses);
    $stmt->execute(['mois' => $mois]);
    foreach ($stmt as $row) {
        $depenses[$row['jour'] - 1] = (float) $row['total'];
    }

    // Chiffres clés
    $sqlCA_Mois = "SELECT ( 
                        (SELECT SUM(prix_total) FROM ventes WHERE DATE_FORMAT(date_vente, '%Y-%m') = :mois) + 
                        (SELECT SUM(price) FROM tickets WHERE DATE_FORMAT(service_date, '%Y-%m') = :mois) - 
                        (SELECT SUM(montant) FROM paiements WHERE DATE_FORMAT(date_paiement, '%Y-%m') = :mois)
                    ) AS total";
    $stmt = $conn->prepare($sqlCA_Mois);
    $stmt->execute(['mois' => $mois]);
    $caMois = number_format($stmt->fetchColumn() ?? 0, 2, ',', ' ');

    $sqlCA_Semaine = "SELECT ( 
                            (SELECT SUM(prix_total) FROM ventes WHERE YEARWEEK(date_vente, 1) = YEARWEEK(CURDATE(), 1)) + 
                            (SELECT SUM(price) FROM tickets WHERE YEARWEEK(service_date, 1) = YEARWEEK(CURDATE(), 1)) - 
                            (SELECT SUM(montant) FROM paiements WHERE YEARWEEK(date_paiement, 1) = YEARWEEK(CURDATE(), 1))
                        ) AS total";
    $caSemaine = number_format($conn->query($sqlCA_Semaine)->fetchColumn() ?? 0, 2, ',', ' ');

    $sqlCA_Trimestre = "SELECT ( 
                              (SELECT SUM(prix_total) FROM ventes WHERE QUARTER(date_vente) = QUARTER(CURDATE()) AND YEAR(date_vente) = YEAR(CURDATE())) + 
                              (SELECT SUM(price) FROM tickets WHERE QUARTER(service_date) = QUARTER(CURDATE()) AND YEAR(service_date) = YEAR(CURDATE())) - 
                              (SELECT SUM(montant) FROM paiements WHERE QUARTER(date_paiement) = QUARTER(CURDATE()) AND YEAR(date_paiement) = YEAR(CURDATE()))
                          ) AS total";
    $caTrimestre = number_format($conn->query($sqlCA_Trimestre)->fetchColumn() ?? 0, 2, ',', ' ');

    echo json_encode([
        'jours' => $jours,
        'ventes' => $ventes,
        'tickets' => $tickets,
        'depenses' => $depenses,
        'caMois' => $caMois,
        'caSemaine' => $caSemaine,
        'caTrimestre' => $caTrimestre
    ]);
    exit;
}

