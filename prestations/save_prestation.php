<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $idPrestation = !empty($_POST['idPrestation']) ? $_POST['idPrestation'] : null;
    $titre = $_POST['titre'];
    $description = $_POST['description'];

    // Gestion de l'upload de l'image
    $fileName = basename($_FILES["photo"]["name"]);
    $uniqueId = uniqid(); // Génère un identifiant unique
    $newFileName = $uniqueId . '-' . $fileName; // Préfixer le nom de fichier avec l'identifiant unique
    $photo = "prestationRepo/" . $newFileName;
    $targetFilePath = "../prestationRepo/" . $newFileName;

    // Déterminer le type MIME de l'image téléversée
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Charger l'image téléversée en fonction de son type MIME
    switch ($imageFileType) {
        case 'jpg':
        case 'jpeg':
            $image = imagecreatefromjpeg($_FILES["photo"]["tmp_name"]);
            break;
        case 'gif':
            $image = imagecreatefromgif($_FILES["photo"]["tmp_name"]);
            break;
        case 'png':
            $image = imagecreatefrompng($_FILES["photo"]["tmp_name"]);
            break;
        default:
            echo "Format de fichier non pris en charge.";
            exit;
    }

    // Compression et enregistrement de l'image
    if ($image) {
        // Ajuster la qualité de l'image (0 à 100, 100 étant la meilleure qualité)
        $quality = 75; // Ajuster selon les besoins

        switch ($imageFileType) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($image, $targetFilePath, $quality);
                break;
            case 'gif':
                imagegif($image, $targetFilePath); // La qualité n'est pas applicable pour les GIFs
                break;
            case 'png':
                // La qualité PNG est de 0 (sans compression) à 9
                $pngQuality = ($quality - 100) / 11.111111;
                $pngQuality = round(abs($pngQuality));
                imagepng($image, $targetFilePath, $pngQuality);
                break;
        }
    } else {
        echo "Erreur lors du chargement de l'image.";
        exit;
    }

    // Libérer la mémoire
    imagedestroy($image);

    // Suite du traitement (mise à jour ou insertion dans la base de données)
    if ($idPrestation) {
        $sql = "UPDATE Prestation SET titre = :titre, description = :description, srcImage = :photo WHERE idPrestation = :idPrestation";
    } else {
        $sql = "INSERT INTO Prestation (titre, description, srcImage) VALUES (:titre, :description, :photo)";
    }

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':photo', $photo);
    if ($idPrestation) {
        $stmt->bindParam(':idPrestation', $idPrestation, PDO::PARAM_INT);
    }
    $stmt->execute();

    // Redirection après l'enregistrement
    header('Location: consult_prestation.php');
}
?>