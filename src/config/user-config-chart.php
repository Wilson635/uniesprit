<?php
session_start();
include_once "config.php";

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Utilisateur non authentifié"]);
    exit();
}

try {
    $userId = $_SESSION['user_id'];
    $pdo = getConnexion();

    // Récupérer les ventes de l'utilisateur
    $stmt = $pdo->prepare("SELECT created_at FROM users WHERE id = :id ORDER BY created_at ASC ");
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $salesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calcul du taux de croissance (exemple simple basé sur la dernière valeur)
    $growthRate = 0;
    if (count($salesData) > 1) {
        $last = end($salesData)['sales'];
        $previous = prev($salesData)['sales'];
        if ($previous > 0) {
            $growthRate = round((($last - $previous) / $previous) * 100, 2);
        }
    }

    echo json_encode(["sales" => $salesData, "growthRate" => $growthRate]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Erreur SQL : " . $e->getMessage()]);
}


