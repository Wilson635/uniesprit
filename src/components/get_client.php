<?php
header('Content-Type: application/json');

include_once '../config/config.php';

if (isset($_GET['phone'])) {
    $phone = trim($_GET['phone']);

    if (empty($phone)) {
        echo json_encode(['first_name' => '', 'last_name' => '']);
        exit;
    }

    try {
        $conn = getConnexion();
        $sql = "SELECT first_name, last_name FROM clients WHERE phone = :phone LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
        $stmt->execute();
        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($client) {
            echo json_encode([
                'first_name' => $client['first_name'],
                'last_name' => $client['last_name']
            ]);
        } else {
            echo json_encode(['first_name' => '', 'last_name' => '']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Erreur serveur', 'message' => $e->getMessage()]);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Paramètre phone manquant']);
}