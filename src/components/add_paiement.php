<?php
// Connexion à la base de données
include_once '../config/config.php';

$pdo = getConnexion();

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Récupérer les valeurs du formulaire
$charge_id = $_POST['charge_id'];
$montant_paye = $_POST['montant_paye'];
$methode_paiement = $_POST['methode_paiement'];

// Insérer le paiement dans la base de données
$query = "INSERT INTO paiements (id, charge_id, montant, moyen_paiement, date_paiement, statut) 
          VALUES (UUID(), :charge_id, :montant, :moyen_paiement, CURDATE(),  'payé')";
$stmt = $pdo->prepare($query);
$stmt->execute([
    ':charge_id' => $charge_id,
    ':montant' => $montant_paye,
    ':moyen_paiement' => $methode_paiement
]);

echo "Paiement enregistré avec succès !";
header('Location: ../../src/pages/main/charges.php');
