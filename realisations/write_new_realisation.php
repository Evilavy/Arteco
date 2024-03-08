<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter une prestation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
        }

        form {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 10px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <a href="../admin.html" style="position: absolute; top: 20px; left: 20px;"><img style="height: 40px;" src="../assets/Menu.png" alt=""></a>
    <form action="save_realisation.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre" required>
        </div>
        <div>
            <label for="datePublication">Date de publication :</label>
            <input type="date" id="datePublication" name="datePublication" required>
        </div>
        <div>
            <label for="situation">Situation :</label>
            <textarea id="situation" name="situation"></textarea>
        </div>
        <div>
            <label for="probleme">Problème :</label>
            <textarea id="probleme" name="probleme"></textarea>
        </div>
        <div>
            <label for="solution">Solution :</label>
            <textarea id="solution" name="solution"></textarea>
        </div>
        <div>
            <label for="srcImgAvant">Image avant :</label>
            <input type="file" id="srcImgAvant" name="srcImgAvant" required>
        </div>
        <div>
            <label for="srcImgApres">Image après :</label>
            <input type="file" id="srcImgApres" name="srcImgApres" required>
        </div>
        <button type="submit">Ajouter la prestation</button>
    </form>
</body>

</html>