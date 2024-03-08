<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db.php'; // Connexion à la base de données

// Vérification et récupération de l'ID de la réalisation
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $realisationId = $_GET['id'];
    $sql = "SELECT * FROM Realisations WHERE idRealisation = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $realisationId]);
    $realisation = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si la réalisation n'existe pas, redirection ou message d'erreur
    if (!$realisation) {
        echo "La réalisation demandée n'existe pas.";
        exit; // Arrête l'exécution du script
    }
} else {
    echo "Aucun identifiant de réalisation fourni.";
    exit; // Arrête l'exécution du script
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" content="user-scalable=no">
    <title>
        <?= htmlspecialchars($realisation['titre']) ?>
    </title>
    <link rel="stylesheet" href="styles/footer.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            text-decoration: none;
            box-sizing: border-box;
            font-family: 'Ubuntu';
        }

        body {
            background-color: #F3F3F3;
        }

        h2 {
            color: #F3F3F3;
            font-family: Ubuntu;
            font-size: 35px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            background: linear-gradient(90deg, #000 -30.03%, #13A106 40.79%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-top: 100px;
        }

        section#head {
            margin: 20px auto;
            width: 80%;
            border-radius: 10px;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
            position: relative;
            margin-top: 100px;
        }

        section#head .overlay {
            position: absolute;
            background: linear-gradient(180deg, #13a106c4 0%, #0c6504c2 100%);
            width: 100%;
            height: 100%;
            border-radius: 10px;
        }

        section#head h1 {
            font-weight: 300;
            z-index: 100;
            text-align: center;
        }

        .content-container {
            margin: 20px auto;
            padding: 20px;
            width: 80%;
            background-color: white;
            border-radius: 10px;
        }

        .image-container {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .image-container img {
            max-width: 45%;
            height: auto;
        }

        section {
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .imgContainer {
            height: 200px;
            width: 350px;
            background-size: cover;
            background-repeat: no-repeat;
            transition: .5s;
        }

        .imgContainer:hover {
            scale: 1.02;
            cursor: pointer;
        }

        h3 {
            color: #fff;
            background-color: #13a106c4;
            width: fit-content;
            font-weight: 100;
            font-size: 15px;
            padding: 5px;
            border-radius: 0 5px 5px 5px;
        }

        hr {
            margin: 30px 0;
        }

        p#date {
            margin: 10px 0;
        }

        @media (max-width: 990px) {
            .imgContainer {
                height: 150px;
                width: 300px;
            }
        }

        @media (max-width: 830px) {
            .image-container {
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 20px;
            }
        }

        @media (max-width: 425px) {
            .imgContainer {
                height: 100px;
                width: 250px;
            }
        }
    </style>
    <link rel="stylesheet" href="styles/nav.css">
    <link rel="stylesheet" href="styles/devis.css">
    <link rel="stylesheet" href="styles/partners.css">
</head>

<body>
    <?php include 'components/nav.php' ?>
    <section id="head" style="background-image: url('<?= htmlspecialchars($realisation['srcImgApres']) ?>')">
        <div class="overlay"></div>
        <h1>
            <?= htmlspecialchars($realisation['titre']) ?>
        </h1>
    </section>
    <div class="content-container">
        <p id="date"><strong>Date de publication :</strong>
            <?= htmlspecialchars($realisation['datePublication']) ?>
        </p>

        <section>
            <h2>Situation</h2>
            <p>
                <?= htmlspecialchars($realisation['situation']) ?>
            </p>
        </section>
        <hr>
        <section>
            <h2>Problème</h2>
            <p>
                <?= htmlspecialchars($realisation['probleme']) ?>
            </p>
        </section>
        <hr>
        <section>
            <h2>Solution</h2>
            <p>
                <?= htmlspecialchars($realisation['solution']) ?>
            </p>
        </section>

        <div class="image-container">
            <div class="imgContainer"
                style="background-image: url('<?= htmlspecialchars($realisation['srcImgAvant']) ?>')"
                onclick="window.location='<?= htmlspecialchars($realisation['srcImgAvant']) ?>'">
                <h3>Avant</h3>
            </div>
            <div class="imgContainer" onclick="window.location='<?= htmlspecialchars($realisation['srcImgApres']) ?>'"
                style="background-image: url('<?= htmlspecialchars($realisation['srcImgApres']) ?>')">
                <h3>Après</h3>
            </div>
        </div>
    </div>
    <?php include 'components/devis.php' ?>
    <?php include 'components/footer.php' ?>
    <script>
    </script>
    <script src="script/nav.js"></script>
</body>

</html>