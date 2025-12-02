<?php
header('Content-Type: application/json');

include_once '../config/config.php';

try {
    $conn = getConnexion();

    // Recherche par téléphone
    if (isset($_GET['phone']) && !empty(trim($_GET['phone']))) {
        $phone = trim($_GET['phone']);

        $sql = "SELECT first_name, last_name, phone FROM clients WHERE phone = :phone LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
        $stmt->execute();
        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($client) {
            echo json_encode([
                'found' => true,
                'multiple' => false,
                'client' => [
                    'first_name' => $client['first_name'],
                    'last_name' => $client['last_name'],
                    'phone' => $client['phone']
                ]
            ]);
        } else {
            echo json_encode(['found' => false, 'multiple' => false]);
        }
    }
    // Recherche par prénom
    elseif (isset($_GET['first_name']) && !empty(trim($_GET['first_name']))) {
        $first_name = trim($_GET['first_name']);

        $sql = "SELECT first_name, last_name, phone FROM clients WHERE first_name LIKE :first_name";
        $stmt = $conn->prepare($sql);
        $search_term = $first_name . '%';
        $stmt->bindParam(":first_name", $search_term, PDO::PARAM_STR);
        $stmt->execute();
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($clients) > 1) {
            echo json_encode([
                'found' => true,
                'multiple' => true,
                'clients' => $clients
            ]);
        } elseif (count($clients) === 1) {
            echo json_encode([
                'found' => true,
                'multiple' => false,
                'client' => $clients[0]
            ]);
        } else {
            echo json_encode(['found' => false, 'multiple' => false]);
        }
    }
    // Recherche par nom
    elseif (isset($_GET['last_name']) && !empty(trim($_GET['last_name']))) {
        $last_name = trim($_GET['last_name']);

        $sql = "SELECT first_name, last_name, phone FROM clients WHERE last_name LIKE :last_name";
        $stmt = $conn->prepare($sql);
        $search_term = $last_name . '%';
        $stmt->bindParam(":last_name", $search_term, PDO::PARAM_STR);
        $stmt->execute();
        $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($clients) > 1) {
            echo json_encode([
                'found' => true,
                'multiple' => true,
                'clients' => $clients
            ]);
        } elseif (count($clients) === 1) {
            echo json_encode([
                'found' => true,
                'multiple' => false,
                'client' => $clients[0]
            ]);
        } else {
            echo json_encode(['found' => false, 'multiple' => false]);
        }
    }
    else {
        http_response_code(400);
        echo json_encode(['error' => 'Aucun paramètre de recherche fourni']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur serveur', 'message' => $e->getMessage()]);
}

/****

<?php
header('Content-Type: application/json');

include_once '../config/config.php';

try {
    $conn = getConnexion();

    // Recherche par téléphone
    if (isset($_GET['phone']) && !empty(trim($_GET['phone']))) {
        $phone = trim($_GET['phone']);

        $sql = "SELECT first_name, last_name, phone FROM clients WHERE phone = :phone LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
        $stmt->execute();
        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($client) {
            echo json_encode([
                'first_name' => $client['first_name'],
                'last_name' => $client['last_name'],
                'phone' => $client['phone']
            ]);
        } else {
            echo json_encode(['first_name' => '', 'last_name' => '', 'phone' => '']);
        }
    }
    // Recherche par prénom
    elseif (isset($_GET['first_name']) && !empty(trim($_GET['first_name']))) {
        $first_name = trim($_GET['first_name']);

        $sql = "SELECT first_name, last_name, phone FROM clients WHERE first_name LIKE :first_name LIMIT 1";
        $stmt = $conn->prepare($sql);
        $search_term = $first_name . '%';
        $stmt->bindParam(":first_name", $search_term, PDO::PARAM_STR);
        $stmt->execute();
        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($client) {
            echo json_encode([
                'first_name' => $client['first_name'],
                'last_name' => $client['last_name'],
                'phone' => $client['phone']
            ]);
        } else {
            echo json_encode(['first_name' => '', 'last_name' => '', 'phone' => '']);
        }
    }
    // Recherche par nom
    elseif (isset($_GET['last_name']) && !empty(trim($_GET['last_name']))) {
        $last_name = trim($_GET['last_name']);

        $sql = "SELECT first_name, last_name, phone FROM clients WHERE last_name LIKE :last_name LIMIT 1";
        $stmt = $conn->prepare($sql);
        $search_term = $last_name . '%';
        $stmt->bindParam(":last_name", $search_term, PDO::PARAM_STR);
        $stmt->execute();
        $client = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($client) {
            echo json_encode([
                'first_name' => $client['first_name'],
                'last_name' => $client['last_name'],
                'phone' => $client['phone']
            ]);
        } else {
            echo json_encode(['first_name' => '', 'last_name' => '', 'phone' => '']);
        }
    }
    else {
        http_response_code(400);
        echo json_encode(['error' => 'Aucun paramètre de recherche fourni']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur serveur', 'message' => $e->getMessage()]);
}

/***

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

*/