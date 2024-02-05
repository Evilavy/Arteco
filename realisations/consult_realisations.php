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
        .prestation-container {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .prestation-img {
            width: 100px;
            /* ou autre dimension selon vos besoins */
            height: auto;
        }
    </style>
</head>

<body>
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
            <div>
                <img src="<?= htmlspecialchars($prestation['srcImgAvant']) ?>" alt="Image Avant" class="prestation-img">
                <img src="<?= htmlspecialchars($prestation['srcImgApres']) ?>" alt="Image Après" class="prestation-img">
            </div>
        </div>
    <?php endforeach; ?>
</body>

</html>