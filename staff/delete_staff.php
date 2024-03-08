<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Suppression Personnel</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            padding: 20px;
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .message {
            margin: 20px 0;
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            background-color: #ddffdd;
            color: #339933;
        }

        .error {
            background-color: #ffdddd;
            color: #cc3333;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            text-decoration: none;
        }

        a:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        // Vérifie si l'ID du personnel est fourni via la méthode GET
        if (isset($_GET['id'])) {
            $idPersonel = $_GET['id'];

            // Connexion à la base de données
            include '../db.php';

            // Récupérer le chemin de l'image avant la suppression
            $sqlImage = "SELECT photo FROM Personnel WHERE idPersonel = :idPersonel";
            $stmtImage = $pdo->prepare($sqlImage);
            $stmtImage->bindParam(':idPersonel', $idPersonel, PDO::PARAM_INT);
            $stmtImage->execute();
            $photoPath = $stmtImage->fetchColumn();

            // Suppression du fichier image si le chemin est récupéré
            if ($photoPath && file_exists("../" . $photoPath)) {
                unlink("../" . $photoPath);
            }

            try {
                // Prépare et exécute la requête de suppression du personnel
                $sql = "DELETE FROM Personnel WHERE idPersonel = :idPersonel";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':idPersonel', $idPersonel, PDO::PARAM_INT);
                $stmt->execute();

                // Message de succès
                echo "<div class='message success'>Le personnel a été supprimés avec succès.</div>";
                // Redirection optionnelle: header('Location: index.php');
            } catch (PDOException $e) {
                // Message d'erreur
                echo "<div class='message error'>Erreur lors de la suppression du personnel : " . $e->getMessage() . "</div>";
            }
        } else {
            echo "<div class='message error'>Identifiant du personnel non spécifié.</div>";
        }
        ?>

        <a href="consult_staff.php">Consulter les employés</a>
    </div>
</body>

</html>