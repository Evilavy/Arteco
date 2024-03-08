<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Prestations</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }

        body::before {
            --line: hsla(0, 0%, 74%, 0.15);
            content: "";
            height: 100vh;
            width: 100vw;
            position: fixed;
            background: linear-gradient(90deg,
                    var(--line) 1px,
                    transparent 1px 5vmin) 0 -2.5vmin / 5vmin 5vmin,
                linear-gradient(var(--line) 1px, transparent 1px 5vmin) 0 -2.5vmin / 5vmin 5vmin;
            mask: linear-gradient(-15deg, transparent 30%, white);
            top: 0;
            z-index: -1;
            transform: translate3d(0, 0, -100vmin);
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            max-width: 600px;
        }

        .card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 16px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            padding: 20px;
            font-size: 1.5em;
            background-color: #4caf50;
            color: white;
        }

        .card-content {
            padding: 20px;
        }

        .card-content a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
    </style>
</head>

<body>
<a href="../admin.html" style="position: absolute; top: 20px; left: 20px;"><img style="height: 40px;" src="../assets/Menu.png" alt=""></a>

    <div class="container">
        <div class="card" onclick="window.location='add_partner.php'">
            <div class="card-header">Ajouter</div>
            <div class="card-content"><a href="add_partner.php">Ajouter un partenaire</a></div>
        </div>
        <div class="card" onclick="window.location='consult_partners.php'">
            <div class="card-header">Consulter</div>
            <div class="card-content"><a href="consult_partners.php">Consulter les partenaires</a></div>
        </div>
    </div>

</body>

</html>