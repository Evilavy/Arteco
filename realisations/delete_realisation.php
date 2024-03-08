<?php
include '../db.php';

if (isset($_GET['id'])) {
    $idRealisation = $_GET['id'];

    // Récupérez les chemins des images avant de supprimer l'enregistrement
    $sqlImage = "SELECT srcImgAvant, srcImgApres FROM Realisations WHERE idRealisation = :idRealisation";
    $stmtImage = $pdo->prepare($sqlImage);
    $stmtImage->bindParam(':idRealisation', $idRealisation, PDO::PARAM_INT);
    $stmtImage->execute();
    $images = $stmtImage->fetch(PDO::FETCH_ASSOC);

    if ($images) {
        // Chemins absolus des images sur le serveur
        $imgAvantPath = "../" . $images['srcImgAvant'];
        $imgApresPath = "../" . $images['srcImgApres'];

        // Supprimez les fichiers images si elles existent
        if (file_exists($imgAvantPath)) {
            unlink($imgAvantPath);
        }
        if (file_exists($imgApresPath)) {
            unlink($imgApresPath);
        }
    }

    // Suppression de la réalisation de la base de données
    $sqlDelete = "DELETE FROM Realisations WHERE idRealisation = :idRealisation";
    $stmtDelete = $pdo->prepare($sqlDelete);
    $stmtDelete->bindParam(':idRealisation', $idRealisation, PDO::PARAM_INT);
    $stmtDelete->execute();

    // Redirection vers la page de consultation après la suppression
    header('Location: consult_realisations.php');
    exit;
} else {
    echo "Aucun identifiant de réalisation fourni.";
}
?>