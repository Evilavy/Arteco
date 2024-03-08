<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db.php'; // Connexion à la base de données

// Récupération de toutes les réalisations
$sql = "SELECT idRealisation, titre, datePublication, srcImgApres, situation FROM Realisations ORDER BY datePublication DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$realisations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" content="user-scalable=no">
    <title>Liste des Réalisations</title>
    <link rel="stylesheet" href="styles/nav.css">
    <link rel="stylesheet" href="styles/footer.css">
    <link rel="stylesheet" href="styles/devis.css">
    <style>
        .container {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        h1 {
            color: #F3F3F3;
            font-family: Ubuntu;
            font-size: 2em;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            background: linear-gradient(90deg, #000 -10.03%, #13A106 90.79%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            width: 100%;
            margin-top: 100px;
        }

        .contCards {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 50px;
            flex-wrap: wrap;
        }

        .card {
            max-width: 18em;
            border-radius: 10px;
            border: 1px solid #dddddd;
        }

        .card .top {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px 15px 0 15px;
        }

        .card .top img {
            width: 100%;
            border-radius: 10px;
        }

        .card .middle {
            padding: 20px;
        }

        .card .middle h4 {
            margin: 0 0 0 0;
            min-height: 55.5px;
            font-size: 1em;
        }

        .card .middle p {
            margin: 20px 0;
            min-height: 100px;
            font-size: 14px;
        }

        .card .foot {
            border-top: 0.5px solid #000;
            padding: 15px 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card .foot a {
            color: #fff;
            background-color: #13A106;
            padding: 10px 20px;
            border-radius: 10px;
            transition: .5s;
        }

        .card .foot a:hover {
            background-color: #128108;
        }

        .realisation-date {
            color: #c4c4c4;
            font-size: 13px;
        }

        @media(max-width: 725px) {
            .card {
                max-width: 15em;
                border-radius: 10px;
                border: 1px solid #dddddd;
            }

            .card .middle p {
                min-height: 50px;
            }
        }
    </style>
</head>

<body>
    <?php include 'components/nav.php'; ?>
    <div class="container">
        <h1>Liste des Réalisations</h1>
        <div class="contCards">
            <?php foreach ($realisations as $realisation): ?>
                <div class="card">
                    <div class="top">
                        <img src="<?= htmlspecialchars($realisation['srcImgApres']) ?>" alt="Image de réalisation"
                            class="realisation-img">
                    </div>
                    <div class="middle">
                        <h4>
                            <?= htmlspecialchars($realisation['titre']) ?>
                        </h4>
                        <p>
                            <?= htmlspecialchars($realisation['situation']) ?>
                        </p>
                        <div class="realisation-date">
                            <?= htmlspecialchars($realisation['datePublication']) ?>
                        </div>
                    </div>
                    <div class="foot">
                        <a href="consulter-realisation.php?id=<?= $realisation['idRealisation'] ?>"
                            class="access-btn">Consulter</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="overlayMenu"></div>

    <?php include('components/devis.php') ?>
    <script src="script/nav.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const descriptions = document.querySelectorAll('.card .middle p');
            const resizeDescriptions = () => {
                descriptions.forEach(p => {
                    let originalText = p.getAttribute('data-original');
                    if (!originalText) {
                        originalText = p.textContent;
                        p.setAttribute('data-original', originalText);
                    }

                    if (window.innerWidth <= 725) {
                        p.textContent = originalText.substring(0, 100) + (originalText.length > 100 ? '...' : '');
                    } else {
                        p.textContent = originalText.substring(0, 200) + (originalText.length > 200 ? '...' : '');
                    }
                });
            };

            // Ajuster immédiatement et à chaque redimensionnement de la fenêtre
            resizeDescriptions();
            window.addEventListener('resize', resizeDescriptions);
        });
    </script>
    <?php include 'components/footer.php' ?>

</body>

</html>