<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Article enregistré</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .links {
            margin-top: 25px;
        }

        .button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button-accent {
            background-color: #28a745;
        }

        .button:hover {
            background-color: #0056b3;
        }

        .button-accent:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <a href="../admin.html" style="position: absolute; top: 20px; left: 20px;"><img style="height: 40px;" src="../assets/Menu.png" alt=""></a>
    <div class="container">
        <h1>Votre article a été enregistré avec succès !</h1>
        <div class="links">
            <a href="./consult_articles.php" class="button">Consulter les articles</a>
            <a href="./write_new_article.php" class="button button-accent">Créer un nouvel article</a>
        </div>
    </div>
</body>

</html>