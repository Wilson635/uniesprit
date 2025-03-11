<?php
// Connexion à la base de données
include_once '../config/config.php';

$pdo = getConnexion();

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $montant = $_POST['montant'];
    $categorie_nom = $_POST['categorie'];
    $frequence = $_POST['frequence'];
    $date_debut = $_POST['date_debut'];
    $date_fin = !empty($_POST['date_fin']) ? $_POST['date_fin'] : NULL;

    // Récupérer l'ID de la catégorie
    $stmt = $pdo->prepare("SELECT id FROM categories_charges WHERE nom = ?");
    $stmt->execute([$categorie_nom]);
    $categorie = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($categorie) {
        $categorie_id = $categorie['id'];

        // Insérer la charge
        $stmt = $pdo->prepare("INSERT INTO charges (id, nom, categorie_id, montant, frequence, date_debut, date_fin) 
                              VALUES (UUID(), ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$nom, $categorie_id, $montant, $frequence, $date_debut, $date_fin]);

        echo "Charge enregistrée avec succès !";
        header("Location: ../../src/pages/main/charges.php");
    } else {
        echo "Erreur : Catégorie non trouvée.";
    }
}