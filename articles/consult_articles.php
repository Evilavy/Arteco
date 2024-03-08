<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../db.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Articles</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            overflow-x: hidden;
        }

        .container {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .contImg {
            position: relative;
            width: 100%;
            height: 200px;
            /* Hauteur fixe pour l'image */
            margin-bottom: 20px;
        }

        .container img {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            object-fit: cover;
            /* Assure que l'image couvre la zone sans se déformer */
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, rgba(8, 105, 0, 0.70) 0%, rgba(19, 161, 6, 0.70) 100%);
            border-radius: 10px;
        }

        .date {
            font-style: italic;
            color: #888;
        }

        h1,
        h2 {
            color: #333;
        }

        h1 {
            border-bottom: 1px solid #d3d3d3;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        h2 {
            margin-top: 30px;
            margin-bottom: 10px;
            color: green;
        }

        p {
            text-align: justify;
            text-indent: 40px;
            margin-top: 20px;
        }

        .consult-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .consult-button:hover {
            background-color: #45a049;
        }

        hr {
            margin-top: 30px;
            border: none;
            border-top: 1px solid #ccc;
        }

        .button {
            display: inline-block;
            padding: 10px 15px;
            margin: 10px 5px 0 0;
            /* Espacement autour des boutons */
            background-color: #007bff;
            /* Couleur de fond par défaut */
            color: #ffffff;
            /* Couleur du texte */
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
            /* Couleur de fond au survol */
        }

        .button.edit {
            background-color: #28a745;
            /* Vert pour le bouton Éditer */
        }

        .button.edit:hover {
            background-color: #218838;
            /* Vert foncé au survol */
        }

        .button.delete {
            background-color: #dc3545;
            /* Rouge pour le bouton Supprimer */
        }

        .button.delete:hover {
            background-color: #c82333;
            /* Rouge foncé au survol */
        }
    </style>
</head>

<body>
    <a href="../admin.html" style="position: absolute; top: 20px; left: 20px;"><img style="height: 40px;" src="../assets/Menu.png" alt=""></a>

    <?php
    $sqlArticles = "SELECT * FROM Article WHERE published = 1";
    $stmtArticles = $pdo->prepare($sqlArticles);
    $stmtArticles->execute();

    while ($article = $stmtArticles->fetch()) {
        echo "<div class='container'>";
        echo "<h1>" . htmlspecialchars($article['titre']) . "</h1>";
        echo "<div class='contImg'>";

        if (!empty($article['srcImage'])) {
            $imagePath = "../" . htmlspecialchars($article['srcImage']);
            echo "<img src=\"$imagePath\" alt=\"Image de l'article\">";
        }

        echo "<div class='overlay'></div></div>"; // Fermeture de .contImg et .overlay
        echo "<p class='date'>Date de publication: " . htmlspecialchars($article['datePublication']) . "</p>";

        $sqlSections = "SELECT * FROM Section WHERE idArticle = ? ORDER BY ordre ASC";
        $stmtSections = $pdo->prepare($sqlSections);
        $stmtSections->execute([$article['idArticle']]);

        while ($section = $stmtSections->fetch()) {
            echo "<h2>" . htmlspecialchars($section['titre']) . "</h2>";
            echo "<p>" . nl2br(htmlspecialchars($section['texte'])) . "</p>";
        }

        echo "<a href='edit_article.php?id=" . $article['idArticle'] . "' class='button edit'>Editer</a>";
        echo "<a href='delete_article.php?id=" . $article['idArticle'] . "' class='button delete'>Supprimer</a>";        

        echo "</div>"; // Fermeture de .container
    }
    ?>
    <a href="./write_new_article.php"><input type="button" value="Nouvel article"></a>
</body>

</html>