<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../db.php';
    $nomComplet = $_POST['nomComplet'];
    $description = $_POST['description'];

    $dossierCible = "../staffRepo/";
    $dossierCibleDB = "staffRepo/";
    $uniqueId = uniqid();
    $nomFichierOriginal = basename($_FILES["photo"]["name"]);
    $extensionFichier = strtolower(pathinfo($nomFichierOriginal, PATHINFO_EXTENSION));
    $nomFichierUnique = $uniqueId . '-' . $nomFichierOriginal;
    $fichierCible = $dossierCible . $nomFichierUnique;
    $fichierCibleDB = $dossierCibleDB . $nomFichierUnique;
    $uploadOk = 1; // Initialisez $uploadOk à 1 au début

    // La vérification pour $_POST["submit"] semble superflue sauf si vous avez un bouton spécifique nommé "submit"
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        echo "Le fichier est une image - " . $check["mime"] . ".";
    } else {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }

    if ($extensionFichier != "jpg" && $extensionFichier != "png" && $extensionFichier != "jpeg" && $extensionFichier != "gif") {
        echo "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Désolé, votre fichier n'a pas été téléversé.";
    } else {
        switch ($extensionFichier) {
            case 'jpg':
            case 'jpeg':
                $image = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
                $compressionQuality = 75;
                imagejpeg($image, $fichierCible, $compressionQuality);
                break;
            case 'png':
                $image = imagecreatefrompng($_FILES['photo']['tmp_name']);
                $compressionQuality = 6; // La qualité de compression PNG va de 0 (sans compression) à 9
                imagepng($image, $fichierCible, $compressionQuality);
                break;
            case 'gif':
                $image = imagecreatefromgif($_FILES['photo']['tmp_name']);
                imagegif($image, $fichierCible);
                break;
        }

        imagedestroy($image);

        $sql = "INSERT INTO Personnel (nomComplet, description, photo) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([$nomComplet, $description, $fichierCibleDB]);

        if ($result) {
            header('Location: ./staff_saved.php');
        } else {
            echo "<p>Erreur lors de l'ajout du membre du personnel.</p>";
        }
    }
}
?>