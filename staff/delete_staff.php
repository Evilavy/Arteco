<?php
// Vérifie si l'ID du personnel est fourni via la méthode GET
if (isset($_GET['id'])) {
    $idPersonel = $_GET['id'];

    // Connexion à la base de données
    include '../db.php';

    try {
        // Prépare et exécute la requête de suppression
        $sql = "DELETE FROM Personnel WHERE idPersonel = :idPersonel";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':idPersonel', $idPersonel, PDO::PARAM_INT);
        $stmt->execute();

        // Si tout se passe bien, redirige vers une page ou affiche un message de succès
        echo "Le personnel a été supprimé avec succès.";
        // Redirection optionnelle: header('Location: index.php');
    } catch (PDOException $e) {
        // Gestion des erreurs
        die("Erreur lors de la suppression du personnel : " . $e->getMessage());
    }
} else {
    echo "Identifiant du personnel non spécifié.";
}
?>