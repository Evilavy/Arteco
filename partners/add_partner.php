<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un Partenaire</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            /* ensures padding doesn't affect overall width */
        }

        input[type="submit"] {
            background-color: #28a745;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        a img {
            transition: transform 0.3s ease;
        }

        a:hover img {
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <a href="../admin.html" style="position: absolute; top: 20px; left: 20px;"><img style="height: 40px;"
            src="../assets/Menu.png" alt="Menu"></a>
    <form action="save_partner.php" method="post" enctype="multipart/form-data">
        <label for="nom">Nom du Partenaire:</label>
        <input type="text" id="nom" name="nom" required><br>

        <label for="nom">Description du Partenaire:</label>
        <input type="text" id="description" name="description" required><br>

        <label for="srcImg">Image du Partenaire:</label>
        <input type="file" id="srcImg" name="srcImg" required><br>

        <input type="submit" name="submit" value="Ajouter Partenaire">
    </form>
</body>

</html>