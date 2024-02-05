<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require '../db.php'; // Assurez-vous que ce chemin est correct

// Récupérer l'article et les sections si on est en GET
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $articleId = $_GET['id'];

    // Récupérer les informations de l'article
    $sqlGetArticle = "SELECT * FROM Article WHERE idArticle = ?";
    $stmtGetArticle = $pdo->prepare($sqlGetArticle);
    $stmtGetArticle->execute([$articleId]);
    $article = $stmtGetArticle->fetch();

    // Récupérer les sections liées à l'article
    $sqlGetSections = "SELECT * FROM Section WHERE idArticle = ? ORDER BY ordre";
    $stmtGetSections = $pdo->prepare($sqlGetSections);
    $stmtGetSections->execute([$articleId]);
    $sections = $stmtGetSections->fetchAll();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_article'], $_POST['section_ids'])) {
    $articleId = $_GET['id'];
    $articleTitle = $_POST['article_title'];
    $sectionTitles = $_POST['section_titles'];
    $sectionContents = $_POST['section_contents'];
    $sectionIds = $_POST['section_ids']; // Assurez-vous que les IDs de sections sont bien passés dans le formulaire

    // Initialiser le chemin de l'image à null
    $imagePath = null;

    // Gérer le téléversement de l'image
    if (isset($_FILES['article_image']) && $_FILES['article_image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../articleRepo/';
        $imageName = time() . '-' . basename($_FILES['article_image']['name']);
        $imageFullPath = $uploadDir . $imageName;

        if (move_uploaded_file($_FILES['article_image']['tmp_name'], $imageFullPath)) {
            $imagePath = $imageFullPath;
        } else {
            throw new Exception("Erreur lors du téléversement de l'image.");
        }
    }

    $sqlUpdateArticle = "UPDATE Article SET titre = ?, srcImage = COALESCE(?, srcImage) WHERE idArticle = ?";
    $stmtUpdateArticle = $pdo->prepare($sqlUpdateArticle);
    $stmtUpdateArticle->execute([$articleTitle, $imagePath, $articleId]);

    foreach ($sectionIds as $index => $sectionId) {
        $title = $sectionTitles[$index];
        $content = $sectionContents[$index];

        $sqlUpdateSection = "UPDATE Section SET titre = ?, texte = ? WHERE idSection = ? AND idArticle = ?";
        $stmtUpdateSection = $pdo->prepare($sqlUpdateSection);
        $stmtUpdateSection->execute([$title, $content, $sectionId, $articleId]);
    }

    echo "Article mis à jour avec succès!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Éditer l'article</title>
    <style>
        *{
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .form-container {
            background-color: #ffffff;
            margin: 0 auto;
            max-width: 800px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .edit-form h1 {
            color: #333333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
        }

        .form-group input[type="file"] {
            border: none;
        }

        .section {
            padding: 10px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            border: 1px solid #eaeaea;
            border-radius: 5px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Éditer l'article</h1>
        <form method="post" enctype="multipart/form-data" class="edit-form">
            <div class="form-group">
                <label for="article_title">Titre de l'article</label>
                <input type="text" id="article_title" name="article_title"
                    value="<?= htmlspecialchars($article['titre'] ?? '') ?>" required>
            </div>

            <div class="form-group">
                <label for="article_image">Image de l'article</label>
                <input type="file" id="article_image" name="article_image" accept="image/*">
            </div>

            <?php if (!empty($sections)): ?>
                <?php foreach ($sections as $index => $section): ?>
                    <div class="section">
                        <div class="form-group">
                            <label for="section_title_<?= $index ?>">Titre de la section</label>
                            <input type="text" id="section_title_<?= $index ?>" name="section_titles[]"
                                value="<?= htmlspecialchars($section['titre']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="section_content_<?= $index ?>">Contenu de la section</label>
                            <textarea id="section_content_<?= $index ?>" name="section_contents[]"
                                required><?= htmlspecialchars($section['texte']) ?></textarea>
                        </div>

                        <input type="hidden" name="section_ids[]" value="<?= $section['idSection'] ?>">
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <button type="submit" name="update_article">Mettre à jour l'article</button>
        </form>
    </div>
</body>

</html>