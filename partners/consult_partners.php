<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion des Partenaires</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .partner-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            width: 100%;
            max-width: 1200px;
        }

        .partner {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.3s ease;
        }

        .partner:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .partner img {
            width: 80%;
            margin-top: 20px;
        }

        .partner-info {
            padding: 20px;
            text-align: center;
        }

        .partner-info p {
            margin: 10px 0;
        }

        .partner button {
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .partner button:hover {
            background-color: #c0392b;
        }
    </style>
</head>

<body>
<a href="../admin.html" style="position: absolute; top: 20px; left: 20px;"><img style="height: 40px;" src="../assets/Menu.png" alt=""></a>

    <div class="partner-container">
        <?php
        require '../db.php'; // Assurez-vous que ce chemin est correct
        
        if (isset($_POST['delete'])) {
            $idPartenaire = $_POST['idPartenaire'];
            $srcImg = $_POST['srcImg'];

            if (file_exists($srcImg)) {
                unlink($srcImg);
            }

            $sql = "DELETE FROM Partenaire WHERE idPartenaire = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$idPartenaire]);

            header('Location: partner_deleted.php');
        }

        $sql = "SELECT * FROM Partenaire";
        $stmt = $pdo->query($sql);
        $partenaires = $stmt->fetchAll();

        foreach ($partenaires as $partenaire) {
            echo "<div class='partner'>";
            echo "<img src='../" . htmlspecialchars($partenaire['srcImg']) . "' alt='Logo de " . htmlspecialchars($partenaire['nom']) . "'>";
            echo "<div class='partner-info'>";
            echo "<p>" . htmlspecialchars($partenaire['nom']) . "</p>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='idPartenaire' value='" . htmlspecialchars($partenaire['idPartenaire']) . "'>";
            echo "<input type='hidden' name='srcImg' value='../" . htmlspecialchars($partenaire['srcImg']) . "'>";
            echo "<button type='submit' name='delete'>Supprimer</button>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>

</body>

</html>