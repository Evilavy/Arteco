<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../db.php';

function compressImage($source, $destination, $quality, $imageType)
{
    $success = false; // Initialiser la variable de succès
    switch ($imageType) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source);
            $success = imagejpeg($image, $destination, $quality);
            break;
        case 'image/png':
            $image = imagecreatefrompng($source);
            // La qualité PNG va de 0 (sans compression) à 9
            $pngQuality = 6; // Ajustez selon les besoins
            $success = imagepng($image, $destination, $pngQuality);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($source);
            $success = imagegif($image, $destination);
            break;
    }
    if ($image) {
        imagedestroy($image);
    }
    return $success; // Retourner le statut de succès
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $datePublication = $_POST['datePublication'];
    $situation = $_POST['situation'];
    $probleme = $_POST['probleme'];
    $solution = $_POST['solution'];

    $uniqueIdAvant = uniqid('avant-');
    $uniqueIdApres = uniqid('apres-');

    $imgAvantName = $uniqueIdAvant . '-' . basename($_FILES['srcImgAvant']['name']);
    $imgAvantTmpName = $_FILES['srcImgAvant']['tmp_name'];
    $imgAvantFolder = "../realisationRepo/avant/" . $imgAvantName;
    $imgAvantFolderDB = "realisationRepo/avant/" . $imgAvantName;

    $imgApresName = $uniqueIdApres . '-' . basename($_FILES['srcImgApres']['name']);
    $imgApresTmpName = $_FILES['srcImgApres']['tmp_name'];
    $imgApresFolder = "../realisationRepo/apres/" . $imgApresName;
    $imgApresFolderDB = "realisationRepo/apres/" . $imgApresName;

    $imgAvantType = getimagesize($imgAvantTmpName)['mime'];
    $imgApresType = getimagesize($imgApresTmpName)['mime'];

    $compressionQuality = 75; // Ajuster selon les besoins

    if (compressImage($imgAvantTmpName, $imgAvantFolder, $compressionQuality, $imgAvantType) && compressImage($imgApresTmpName, $imgApresFolder, $compressionQuality, $imgApresType)) {
        $sql = "INSERT INTO Realisations (titre, datePublication, situation, probleme, solution, srcImgAvant, srcImgApres) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$titre, $datePublication, $situation, $probleme, $solution, $imgAvantFolderDB, $imgApresFolderDB])) {
            header("Location: realisation_saved.php");
        } else {
            echo "Erreur lors de l'insertion dans la base de données.";
        }
    } else {
        echo "Erreur lors de la compression des images.";
    }
}
?>