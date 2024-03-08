<?php
require '../db.php'; // Vérifiez le chemin

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $image = $_FILES['srcImg']['tmp_name'];
    $description = $_POST["description"];
    $imageName = uniqid() . '-' . $_FILES['srcImg']['name']; // Nom unique
    $targetDir = "../partnersRepo/";
    $targetDirDB = "partnersRepo/";

    // Compresser et sauvegarder l'image
    $compressedImage = compressImage($image, $targetDir . $imageName, 75);

    // Insertion dans la base de données
    $sql = "INSERT INTO Partenaire (nom, srcImg, description) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    try {
        $stmt->execute([$nom, $targetDirDB . $imageName, $description]);
        header("Location: partner_added.php");
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout du partenaire: " . $e->getMessage();
    }
}

// Fonction de compression d'image
function compressImage($source, $destination, $quality)
{
    $info = getimagesize($source);

    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
        imagejpeg($image, $destination, $quality);
    } elseif ($info['mime'] == 'image/gif') {
        $image = imagecreatefromgif($source);
        imagegif($image, $destination);
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
        // Conserver la transparence
        imagealphablending($image, false);
        imagesavealpha($image, true);
        // Compression PNG
        $quality = 9 - (int) ((0.9 * $quality) / 10.0); // Convertir la qualité de 0-100 à 0-9
        imagepng($image, $destination, $quality);
    }

    return $destination;
}
?>