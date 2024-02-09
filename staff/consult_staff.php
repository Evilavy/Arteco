<?php
// Connexion à la base de données
include '../db.php';

// Requête pour récupérer tous les membres du personnel
$sql = "SELECT * FROM Personnel ORDER BY idPersonel DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$personnels = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Consultation du Personnel</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 50px;
        }

        .personnel-container {
            display: flex;
            align-items: center;
            background-color: #fff;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .personnel-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .personnel-container img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-right: 20px;
            object-fit: cover;
            border: 3px solid #eee;
        }

        .personnel-info {
            flex: 1;
        }

        .personnel-info h2 {
            margin: 0;
            color: green;
        }

        .personnel-info p {
            margin-top: 10px;
            line-height: 1.6;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Consultation du Personnel</h1>
        <?php foreach ($personnels as $personnel): ?>
            <div class="personnel-container">
                <img src="<?= htmlspecialchars($personnel['photo']) ?>"
                    alt="Photo de <?= htmlspecialchars($personnel['nomComplet']) ?>">
                <div class="personnel-info">
                    <h2>
                        <?= htmlspecialchars($personnel['nomComplet']) ?>
                    </h2>
                    <p>
                        <?= nl2br(htmlspecialchars($personnel['description'])) ?>
                    </p>
                </div>
                <!-- Ajout du lien de modification -->
                <a href="edit_staff.php?id=<?= $personnel['idPersonel'] ?>"
                    style="margin-left: auto; padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Modifier</a>
                <a href="delete_staff.php?id=<?= $personnel['idPersonel'] ?>"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre du personnel ?');">Supprimer</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>