<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db.php'; // Assurez-vous que le chemin vers votre fichier de connexion est correct

$idArticle = isset($_GET['id']) ? $_GET['id'] : null;

if ($idArticle) {
    $stmt = $pdo->prepare("SELECT * FROM Article WHERE idArticle = ?");
    $stmt->execute([$idArticle]);
    $article = $stmt->fetch();

    $stmt = $pdo->prepare("SELECT * FROM Section WHERE idArticle = ? ORDER BY ordre ASC");
    $stmt->execute([$idArticle]);
    $sections = $stmt->fetchAll();

    $stmtAutres = $pdo->prepare("SELECT idArticle, titre, srcImage FROM Article WHERE idArticle != ? ORDER BY datePublication DESC");
    $stmtAutres->execute([$idArticle]);
    $autresArticles = $stmtAutres->fetchAll();
} else {
    echo "Aucun ID d'article spécifié.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" content="user-scalable=no">
    <title>
        <?= htmlspecialchars($article['titre']) ?>
    </title>
    <link rel="stylesheet" href="styles/footer.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .main-content {
            flex: 1;
            max-width: 900px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        .sidebar {
            width: 300px;
            margin: 10px;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .sidebar-article {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .sidebar-article img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            border-radius: 5px;
            object-fit: cover;
        }

        .sidebar-article a {
            display: flex;
            align-items: center;
            color: #333;
            text-decoration: none;
        }

        img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        h1,
        h2 {
            color: #333;
        }

        .date {
            font-style: italic;
            color: #888;
            margin-bottom: 20px;
        }

        .section {
            margin: 40px 0;
        }

        .content{
            padding: 20px;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .sidebar {
                width: auto;
                margin: 10px 0;
            }
        }
    </style>
    <link rel="stylesheet" href="styles/nav.css">
    <link rel="stylesheet" href="styles/devis.css">
</head>

<body>
    <?php include 'components/nav.php' ?>
    <div class="content">
        <div class="main-content">
            <h1>
                <?= htmlspecialchars($article['titre']) ?>
            </h1>
            <div class="contImg">
                <?php if ($article['srcImage']): ?>
                    <img src="<?= htmlspecialchars($article['srcImage']) ?>" alt="Image de l'article">
                <?php endif; ?>
            </div>
            <p class="date">Date de publication:
                <?= htmlspecialchars($article['datePublication']) ?>
            </p>
            <?php foreach ($sections as $section): ?>
                <div class="section">
                    <h2>
                        <?= htmlspecialchars($section['titre']) ?>
                    </h2>
                    <p>
                        <?= nl2br(htmlspecialchars($section['texte'])) ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="sidebar">
            <h3>Autres articles</h3>
            <?php foreach ($autresArticles as $autre): ?>
                <div class="sidebar-article">
                    <a href="?id=<?= $autre['idArticle'] ?>">
                        <img src="<?= htmlspecialchars($autre['srcImage']) ?>" alt="Miniature de l'article">
                        <?= htmlspecialchars($autre['titre']) ?>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include 'components/devis.php' ?>
    <?php include 'components/footer.php' ?>

    <script src="script/nav.js"></script>
</body>

</html>