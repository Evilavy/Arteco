<?php
include '../db.php';

if (isset($_GET['id'])) {
    $idPrestation = $_GET['id'];

    // Suppression de la prestation
    $sql = "DELETE FROM Prestation WHERE idPrestation = :idPrestation";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idPrestation', $idPrestation, PDO::PARAM_INT);
    $stmt->execute();

    // Redirection vers la page de consultation
    header('Location: consult_prestation.php');
} else {
    echo "Aucun identifiant de prestation fourni.";
}
?>