<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
            /* Largeur du conteneur de l'image */
            height: 300px;
            /* Hauteur fixe pour toutes les images */
            background-position: center;
            /* Centre l'image dans le conteneur */
            background-size: cover;
            /* S'assure que l'image couvre tout l'espace disponible sans être étirée */
            border-radius: 5px;
            /* Optionnel: ajoute un bord arrondi comme pour vos images actuelles */
            overflow: hidden;
            /* Empêche l'image de déborder du conteneur */
        }

        .article-overlay {
            position: absolute;
            top: 0;
            width: 100%;
            /* Largeur du conteneur de l'image */
            height: 300px;
            background: linear-gradient(180deg, rgba(8, 105, 0, 0.8) 0%, rgba(19, 161, 6, 0.40) 100%) !important;
            border-radius: 5px;
        }

        .contImage{
            position: relative;
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
    include '../db.php'; // Assurez-vous d'avoir un fichier 'db.php' pour la connexion à la base de données
    
    $sqlArticles = "SELECT * FROM Article WHERE published = 1"; // Sélectionnez tous les articles publiés
    $stmtArticles = $pdo->prepare($sqlArticles);
    $stmtArticles->execute();

    while ($article = $stmtArticles->fetch()) {
        echo "<div class='article-container'>";

        if (!empty($article['srcImage'])) {
            $imagePath = htmlspecialchars($article['srcImage']); // Assurez-vous d'échapper correctement le chemin de l'image
            echo '<div class="contImage">';
            echo "<div class='article-image-container' style='background-image: url(\"$imagePath\");'></div>";
            echo "<div class='article-overlay'></div>";
            echo '</div>';
        }

        echo "<h1 class='article-title'>" . htmlspecialchars($article['titre']) . "</h1>";

        $sqlSections = "SELECT * FROM Section WHERE idArticle = ? ORDER BY ordre";
        $stmtSections = $pdo->prepare($sqlSections);
        $stmtSections->execute([$article['idArticle']]);

        while ($section = $stmtSections->fetch()) {
            echo "<h2 class='section-title'>" . htmlspecialchars($section['titre']) . "</h2>";
            echo "<p class='section-content'>" . nl2br(htmlspecialchars($section['texte'])) . "</p>";
        }

        echo "<hr>";
        echo "<a href='edit_article.php?id=" . $article['idArticle'] . "' class='edit-button'>Éditer</a>";
        echo "<a href='delete_article.php?id=" . $article['idArticle'] . "' class='edit-button'>Supprimer</a>";
        echo "</div>";
    }
    ?>
</body>

</html>