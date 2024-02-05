<?php
session_start();
require '../db.php'; // Assurez-vous que ce chemin vers le fichier de connexion à la base de données est correct

try {
    // Activez les exceptions PDO pour gérer les erreurs de base de données
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['article_title'])) {
        $articleTitle = $_POST['article_title']; // Récupération du titre de l'article depuis le formulaire
        $sections = isset($_SESSION['sections']) ? $_SESSION['sections'] : []; // Récupération des sections depuis la session
        $uploadDir = '../articleRepo/'; // Définir le répertoire de téléchargement
        $imagePath = null; // Initialiser le chemin de l'image

        // Gérer le téléversement de l'image
        if (isset($_FILES['article_image']) && $_FILES['article_image']['error'] === UPLOAD_ERR_OK) {
            $imageName = time() . '-' . basename($_FILES['article_image']['name']); // Générer un nom unique pour l'image
            $imageFullPath = $uploadDir . $imageName; // Chemin complet du fichier

            // Déplacer le fichier téléchargé vers le répertoire de destination
            if (move_uploaded_file($_FILES['article_image']['tmp_name'], $imageFullPath)) {
                $imagePath = $imageFullPath; // Enregistrer le chemin de l'image
            } else {
                throw new Exception("Erreur lors du téléversement de l'image.");
            }
        }

        // Commencer la transaction
        $pdo->beginTransaction();

        // Préparer et exécuter la requête SQL pour insérer l'article
        $sqlArticle = "INSERT INTO Article (titre, datePublication, srcImage, published) VALUES (?, NOW(), ?, 1)";
        $stmtArticle = $pdo->prepare($sqlArticle);
        $stmtArticle->execute([$articleTitle, $imagePath]);

        // Récupérer l'ID de l'article inséré
        $articleId = $pdo->lastInsertId();

        // Insérer les sections associées à l'article, si elles existent
        if (!empty($sections)) {
            $sqlSection = "INSERT INTO Section (idArticle, titre, texte, ordre) VALUES (?, ?, ?, ?)";
            $stmtSection = $pdo->prepare($sqlSection);

            foreach ($sections as $index => $section) {
                $stmtSection->execute([$articleId, $section['title'], $section['content'], $index + 1]);
            }
        }

        // Valider la transaction
        $pdo->commit();

        // Réinitialiser les variables de session concernées
        unset($_SESSION['sections']);

        // Redirection vers une page de confirmation ou d'affichage de l'article
        header('Location: ./article_saved.php');
        exit;
    } else {
        throw new Exception("Les données de l'article sont manquantes.");
    }
} catch (Exception $e) {
    // En cas d'erreur, annuler la transaction
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    // Afficher le message d'erreur
    echo "Erreur lors de l'enregistrement : " . $e->getMessage();
}
?>