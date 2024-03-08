<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include '../db.php';

// Requête pour récupérer toutes les prestations
$sql = "SELECT * FROM Prestation ORDER BY idPrestation DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$prestations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Consultation des Prestations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
        }

        .prestation-container {
            border-bottom: 1px solid #eee;
            padding: 20px;
            text-align: center;
        }

        .prestation-container img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
        }

        .prestation-container h2 {
            color: #444;
            margin: 0 0 10px 0;
        }

        .prestation-container p {
            color: #666;
        }

        .prestation-container a#edit {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }

        .prestation-container a#delete {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: #e74c3c;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }

        .prestation-container a:hover {
            background-color: #003d82;
        }
    </style>
</head>

<body>
    <a href="../admin.html" style="position: absolute; top: 20px; left: 20px;"><img style="height: 40px;"
            src="../assets/Menu.png" alt=""></a>
    <div class="container">
        <h1>Liste des Prestations</h1>
        <?php foreach ($prestations as $prestation): ?>
            <div class="prestation-container">
                <img src="../<?= htmlspecialchars($prestation['srcImage']) ?>" alt="Image de la prestation">
                <h2>
                    <?= htmlspecialchars($prestation['titre']) ?>
                </h2>
                <p>
                    <?= nl2br(htmlspecialchars($prestation['description'])) ?>
                </p>
                <a href="edit_prestation.php?id=<?= $prestation['idPrestation'] ?>" id="edit">Modifier</a>
                <a href="delete_prestation.php?id=<?= $prestation['idPrestation'] ?>"
                    onclick="return confirm('Confirmez-vous la suppression de cette prestation ?');"
                    id="delete">Supprimer</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>