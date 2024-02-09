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
    <link rel="stylesheet" href="styles.css">
    <title>Articles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .article-container {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .article-image-container {
            width: 100%;
            height: 300px;
            background-position: center;
            background-size: cover;
            border-radius: 5px;
            overflow: hidden;
        }

        .article-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .section-title {
            font-size: 20px;
            font-weight: bold;
            margin-top: 40px;
        }

        .section-content {
            font-size: 16px;
            line-height: 1.4;
            margin-top: 10px;
            text-indent: 40px;
        }

        .consult-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .consult-button:hover {
            background-color: #45a049;
        }

        hr {
            margin-top: 20px;
            border: none;
            border-top: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <a href="./write_new_article.php"><input type="button" value="Nouvel article"></a>

    <?php
    $sqlArticles = "SELECT * FROM Article WHERE published = 1";
    $stmtArticles = $pdo->prepare($sqlArticles);
    $stmtArticles->execute();

    while ($article = $stmtArticles->fetch()) {
        echo "<div class='article-container'>";
        echo "<h1 class='article-title'>" . htmlspecialchars($article['titre']) . "</h1>";

        if ($article['isLien'] == 1) {
            echo "<div class='article-image-container' style='background-image: url(\"../assets/defaultArticle.webp\");'></div>";
            echo "<a href='" . htmlspecialchars($article['lien']) . "' target='_blank' class='consult-button'>Consulter</a>";
            echo "<a href='delete_article.php?id=". $article['idArticle'] ."' class='consult-button'>Suprimer</a>";
        } else {
            if (!empty($article['srcImage'])) {
                $imagePath = htmlspecialchars($article['srcImage']);
                echo "<div class='article-image-container' style='background-image: url(\"$imagePath\");'></div>";
            }

            $sqlSections = "SELECT * FROM Section WHERE idArticle = ? ORDER BY ordre";
            $stmtSections = $pdo->prepare($sqlSections);
            $stmtSections->execute([$article['idArticle']]);

            while ($section = $stmtSections->fetch()) {
                echo "<h2 class='section-title'>" . htmlspecialchars($section['titre']) . "</h2>";
                echo "<p class='section-content'>" . nl2br(htmlspecialchars($section['texte'])) . "</p>";
            }
            echo "<a href='edit_article.php?id=". $article['idArticle'] ."' class='consult-button'>Editer</a>";
            echo "<a href='delete_article.php?id=". $article['idArticle'] ."' class='consult-button'>Suprimer</a>";
        }

        echo "<hr>";
        echo "</div>";
    }
    ?>
</body>

</html>