<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            color: #333;
        }

        .actions {
            margin-top: 25px;
        }

        .button {
            display: inline-block;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            cursor: pointer;
            color: #fff;
            background-color: #cc0000;
        }

        .confirm {
            background-color: #ff4444;
        }

        .confirm:hover {
            background-color: #cc0000;
        }

        .cancel {
            background-color: #cccccc;
        }

        .cancel:hover {
            background-color: #999999;
        }
    </style>
    <title>Suppression d'article</title>
</head>

<body>
    <div class="container">
        <?php
        // Assurez-vous que ce chemin est correct
        require '../db.php';

        // Vérifier si un ID d'article a été spécifié
        if (!isset($_GET['id'])) {
            echo "<p>Aucun article spécifié pour la suppression.</p>";
        } else {
            $articleId = $_GET['id'];

            // Vérification de la confirmation de la suppression
            if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
                try {
                    $pdo->beginTransaction();

                    // Récupérez le chemin de l'image avant la suppression
                    $sqlGetImagePath = "SELECT srcImage FROM Article WHERE idArticle = ?";
                    $stmtGetImagePath = $pdo->prepare($sqlGetImagePath);
                    $stmtGetImagePath->execute([$articleId]);
                    $imagePath = $stmtGetImagePath->fetchColumn();

                    // Supprimez les sections associées à l'article
                    $sqlDeleteSections = "DELETE FROM Section WHERE idArticle = ?";
                    $stmtDeleteSections = $pdo->prepare($sqlDeleteSections);
                    $stmtDeleteSections->execute([$articleId]);

                    // Supprimez l'article de la base de données
                    $sqlDeleteArticle = "DELETE FROM Article WHERE idArticle = ?";
                    $stmtDeleteArticle = $pdo->prepare($sqlDeleteArticle);
                    $stmtDeleteArticle->execute([$articleId]);

                    // Supprimez le fichier image du serveur si le chemin existe
                    if ($imagePath && file_exists($imagePath)) {
                        unlink($imagePath);
                    }

                    $pdo->commit();

                    echo "<p>L'article, ses sections et l'image ont été supprimés avec succès.</p>";
                    echo "<a href='consult_articles.php' class='button'>Retourner aux articles</a>";
                } catch (Exception $e) {
                    $pdo->rollBack();
                    echo "<p>Une erreur s'est produite lors de la suppression de l'article, de ses sections et de l'image : " . $e->getMessage() . "</p>";
                }
            } else {
                echo "<h2>Confirmation de suppression</h2>";
                echo "<p>Êtes-vous sûr de vouloir supprimer cet article, toutes ses sections associées et l'image ?</p>";
                echo "<a href='delete_article.php?id=" . $articleId . "&confirm=yes' class='button confirm'>Oui, supprimer</a> ";
                echo "<a href='consult_articles.php' class='button cancel'>Annuler</a>";
            }
        }
        ?>

    </div>
</body>

</html>