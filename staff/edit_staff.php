<?php
include '../db.php';  // Assurez-vous que ce chemin d'accès est correct

// Vérifie si un ID est passé dans l'URL
if (!isset($_GET['id'])) {
    die('ID du membre du personnel manquant.');
}

$idPersonel = $_GET['id'];

// Préparation de la requête SQL pour récupérer les informations du membre du personnel
$sql = "SELECT * FROM Personnel WHERE idPersonel = :idPersonel LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':idPersonel', $idPersonel, PDO::PARAM_INT);
$stmt->execute();

// Récupération du membre du personnel
$personnel = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$personnel) {
    die('Membre du personnel introuvable.');
}

if (isset($_POST['update'])) {
    // Récupérer les valeurs du formulaire
    $nomComplet = $_POST['nomComplet'];
    $description = $_POST['description'];

    // Traitement de la photo si elle est modifiée
    $photoPath = $personnel['photo']; // Utilisez l'ancienne photo par défaut
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        // Supposons que vous souhaitez enregistrer la nouvelle photo dans un répertoire nommé "uploads"
        $targetDirectory = "../uploads/";
        $fileName = basename($_FILES['photo']['name']);
        $targetFilePath = $targetDirectory . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);


        // Tentative de téléchargement du fichier
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
            $photoPath = $targetFilePath; // Nouveau chemin de la photo
        }
    }

    // Préparation de la requête de mise à jour
    $updateSql = "UPDATE Personnel SET nomComplet = :nomComplet, description = :description, photo = :photo WHERE idPersonel = :idPersonel";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->bindParam(':nomComplet', $nomComplet);
    $updateStmt->bindParam(':description', $description);
    $updateStmt->bindParam(':photo', $photoPath);
    $updateStmt->bindParam(':idPersonel', $idPersonel);

    // Exécution de la requête
    if ($updateStmt->execute()) {
        echo "Mise à jour réussie.";
        // Redirection vers une autre page ou affichage d'un message de succès
    } else {
        echo "Erreur lors de la mise à jour.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier un membre du personnel</title>
    <style>
        *{
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
            padding-top: 50px;
        }

        h1 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="file"] {
            border: none;
            margin-bottom: 20px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        img {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <a href="../admin.html" style="position: absolute; top: 20px; left: 20px;"><img style="height: 40px;" src="../assets/Menu.png" alt=""></a>
    <h1>Modifier le membre du personnel</h1>
    <form action="edit_staff.php?id=<?= htmlspecialchars($idPersonel) ?>" method="post" enctype="multipart/form-data">
        <div>
            <label for="nomComplet">Nom Complet :</label>
            <input type="text" id="nomComplet" name="nomComplet"
                value="<?= htmlspecialchars($personnel['nomComplet']) ?>" required>
        </div>
        <div>
            <label for="description">Description :</label>
            <textarea id="description" name="description" rows="5"
                required><?= htmlspecialchars($personnel['description']) ?></textarea>
        </div>
        <div>
            <label for="photo">Photo actuelle :</label>
            <img src="../<?= htmlspecialchars($personnel['photo']) ?>" alt="Photo" style="width: 100px; height: auto;">
            <input type="file" id="photo" name="photo">
        </div>
        <button type="submit" name="update">Mettre à jour</button>
    </form>
</body>

</html>