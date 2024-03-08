<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Connexion à la base de données
include '../db.php';
// Requête pour récupérer toutes les prestations
$sql = "SELECT * FROM Realisations ORDER BY datePublication DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$prestations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Consultation des Réalisations</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');

        * {
            text-decoration: none;
            box-sizing: border-box;
            font-family: 'Ubuntu';
        }

        body {
            padding: 50px;
        }

        .prestation-container {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .prestation-img {
            width: 100px;
            height: auto;
        }

        .prestation-container a {
            background-color: #e74c3c;
            color: #fff;
            padding: 5px 10px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <a href="../admin.html" style="position: absolute; top: 20px; left: 20px;"><img style="height: 40px;"
            src="../assets/Menu.png" alt=""></a>
    <h1>Consultation des Réalisations</h1>
    <?php foreach ($prestations as $prestation): ?>
        <div class="prestation-container">
            <h2>
                <?= htmlspecialchars($prestation['titre']) ?>
            </h2>
            <p><strong>Date de publication :</strong>
                <?= htmlspecialchars($prestation['datePublication']) ?>
            </p>
            <p><strong>Situation :</strong>
                <?= htmlspecialchars($prestation['situation']) ?>
            </p>
            <p><strong>Problème :</strong>
                <?= htmlspecialchars($prestation['probleme']) ?>
            </p>
            <p><strong>Solution :</strong>
                <?= htmlspecialchars($prestation['solution']) ?>
            </p>
            <div style="margin-bottom: 20px">
                <img src="../<?= htmlspecialchars($prestation['srcImgAvant']) ?>" alt="Image Avant" class="prestation-img">
                <img src="../<?= htmlspecialchars($prestation['srcImgApres']) ?>" alt="Image Après" class="prestation-img">
            </div>
            <a href="delete_realisation.php?id=<?= $prestation['idRealisation'] ?>"
                onclick="return confirmDelete();">Supprimer</a>
        </div>
    <?php endforeach; ?>

    <script>
        function confirmDelete() {
            return confirm('Êtes-vous sûr de vouloir supprimer cette réalisation ?');
        }
    </script>

</body>

</html>