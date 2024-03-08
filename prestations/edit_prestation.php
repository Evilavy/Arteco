<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>
        <?= $idPrestation ? "Modifier" : "Ajouter" ?> une Prestation
    </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        form {
            max-width: 500px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            /* ensures padding doesn't affect overall width */
        }

        button {
            background-color: #4CAF50;
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

        textarea{
            height: 100px;
        }
    </style>
</head>

<body>
    <a href="../admin.html" style="position: absolute; top: 20px; left: 20px;"><img style="height: 40px;"
            src="../assets/Menu.png" alt="Menu"></a>
    <form action="save_prestation.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idPrestation" value="<?= $prestation['idPrestation'] ?? '' ?>">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" value="<?= $prestation['titre'] ?? '' ?>" required>

        <label for="description">Description :</label>
        <textarea name="description" id="description" required><?= $prestation['description'] ?? '' ?></textarea>

        <label for="photo">Photo :</label>
        <input type="file" name="photo" id="photo">

        <button type="submit">
            <?= $idPrestation ? "Modifier" : "Ajouter" ?>
        </button>
    </form>
</body>

</html>