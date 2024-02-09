<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    include '../db.php';
    // Récupération des données du formulaire
    $nomComplet = $_POST['nomComplet'];
    $description = $_POST['description'];

    // Gestion de l'upload de la photo
    $dossierCible = "../staffRepo/";
    $dossierCibleDB = "staffRepo/";
    $fichierCible = $dossierCible . basename($_FILES["photo"]["name"]);
    $fichierCibleDB = $dossierCibleDB . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $typeImage = strtolower(pathinfo($fichierCible, PATHINFO_EXTENSION));

    // Vérifie si le fichier est une image réelle
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if ($check !== false) {
            echo "Le fichier est une image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Le fichier n'est pas une image.";
            $uploadOk = 0;
        }
    }

    // Vérifie si le fichier existe déjà
    if (file_exists($fichierCible)) {
        echo "Désolé, le fichier existe déjà.";
        $uploadOk = 0;
    }
    
    // Autorise certains formats de fichier
    if (
        $typeImage != "jpg" && $typeImage != "png" && $typeImage != "jpeg"
        && $typeImage != "gif"
    ) {
        echo "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
        $uploadOk = 0;
    }

    // Vérifie si $uploadOk est défini à 0 par une erreur
    if ($uploadOk == 0) {
        echo "Désolé, votre fichier n'a pas été téléversé.";
        // si tout est ok, essaye de téléverser le fichier
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $fichierCible)) {
            echo "Le fichier " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " a été téléversé.";

            // Préparation de la requête d'insertion avec le chemin de l'image
            $sql = "INSERT INTO Personnel (nomComplet, description, photo) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);

            // Exécution de la requête
            $result = $stmt->execute([$nomComplet, $description, $fichierCibleDB]);

            // Vérification de la réussite de l'insertion
            if ($result) {
                echo "<p>Le nouveau membre du personnel a été ajouté avec succès, photo incluse.</p>";
            } else {
                echo "<p>Erreur lors de l'ajout du membre du personnel.</p>";
            }

        } else {
            echo "Désolé, il y a eu une erreur lors du téléversement de votre fichier.";
        }
    }
}
?>