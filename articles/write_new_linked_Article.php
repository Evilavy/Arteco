<?php
include '../db.php';
// Vérification si les données du formulaire sont soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs du formulaire
    $titre = $_POST['titre'];
    $datePublication = $_POST['datePublication'];
    $lien = $_POST['lien'];

    // Requête SQL pour insérer un nouvel article dans la base de données
    $sql = "INSERT INTO Article (titre, datePublication, isLien, lien, published) VALUES (:titre, :datePublication, 1, :lien, 1)";

    try {
        $stmt = $pdo->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':datePublication', $datePublication);
        $stmt->bindParam(':lien', $lien);

        // Exécution de la requête
        $stmt->execute();

        // Redirection ou message de confirmation après insertion
        header('Location: article_saved.php');
    } catch (PDOException $e) {
        die("Erreur lors de l'insertion de l'article : " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un Article Lien</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            padding: 20px;
            margin: 0;
        }

        form {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="datetime-local"],
        input[type="url"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            /* Assure que padding ne déborde pas */
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a img {
            height: 40px;
            position: absolute;
            top: 20px;
            left: 20px;
        }
    </style>
</head>

<body>
    <a href="../admin.html"><img src="../assets/Menu.png" alt="Menu"></a>
    <form action="write_new_linked_Article.php" method="post">
        <label for="titre">Titre de l'article:</label>
        <input type="text" id="titre" name="titre" required>

        <label for="datePublication">Date de publication:</label>
        <input type="datetime-local" id="datePublication" name="datePublication" required>

        <label for="lien">Lien de l'article:</label>
        <input type="url" id="lien" name="lien" required>

        <input type="submit" value="Ajouter l'article">
    </form>
</body>

</html>