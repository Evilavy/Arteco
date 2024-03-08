<?php
session_start();
require '../db.php';

try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['article_title'])) {
        $articleTitle = $_POST['article_title'];
        $sections = isset($_SESSION['sections']) ? $_SESSION['sections'] : [];
        $uploadDir = '../articleRepo/';
        $uploadDirDB = 'articleRepo/';
        $imagePath = null;

        if (isset($_FILES['article_image']) && $_FILES['article_image']['error'] === UPLOAD_ERR_OK) {
            $imageName = uniqid() . '-' . basename($_FILES['article_image']['name']);
            $imageFullPath = $uploadDir . $imageName;
            $imageFullPathDB = $uploadDirDB . $imageName;

            $imageFileType = strtolower(pathinfo($imageFullPath, PATHINFO_EXTENSION));
            switch ($imageFileType) {
                case 'jpg':
                case 'jpeg':
                    $image = imagecreatefromjpeg($_FILES['article_image']['tmp_name']);
                    break;
                case 'gif':
                    $image = imagecreatefromgif($_FILES['article_image']['tmp_name']);
                    break;
                case 'png':
                    $image = imagecreatefrompng($_FILES['article_image']['tmp_name']);
                    break;
                default:
                    throw new Exception("Format de fichier non pris en charge.");
            }

            // Ajuster la qualité de l'image ici
            $quality = 75;
            switch ($imageFileType) {
                case 'jpg':
                case 'jpeg':
                    imagejpeg($image, $imageFullPath, $quality);
                    break;
                case 'gif':
                    imagegif($image, $imageFullPath);
                    break;
                case 'png':
                    $pngQuality = (9 - round(($quality / 100) * 9));
                    imagepng($image, $imageFullPath, $pngQuality);
                    break;
            }
            imagedestroy($image);
            $imagePath = $imageFullPathDB;
        }

        $pdo->beginTransaction();
        $sqlArticle = "INSERT INTO Article (titre, datePublication, srcImage, published) VALUES (?, NOW(), ?, 1)";
        $stmtArticle = $pdo->prepare($sqlArticle);
        $stmtArticle->execute([$articleTitle, $imagePath]);

        $articleId = $pdo->lastInsertId();

        if (!empty($sections)) {
            $sqlSection = "INSERT INTO Section (idArticle, titre, texte, ordre) VALUES (?, ?, ?, ?)";
            $stmtSection = $pdo->prepare($sqlSection);

            foreach ($sections as $index => $section) {
                $stmtSection->execute([$articleId, $section['title'], $section['content'], $index + 1]);
            }
        }

        $pdo->commit();
        unset($_SESSION['sections']);
        header('Location: ./article_saved.php');
        exit;
    } else {
        throw new Exception("Les données de l'article sont manquantes.");
    }
} catch (Exception $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "Erreur lors de l'enregistrement : " . $e->getMessage();
}
?>