<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un membre du personnel</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1 {
            color: #444;
            text-align: center;
        }

        form {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        div {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            /* Ajuste la boîte pour inclure le padding et border */
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #449d44;
        }
    </style>
</head>

<body>
    <a href="../admin.html" style="position: absolute; top: 20px; left: 20px;"><img style="height: 40px;" src="../assets/Menu.png" alt=""></a>
    <h1>Ajouter un nouveau membre du personnel</h1>
    <form action="save_staff.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="nomComplet">Nom Complet :</label>
            <input type="text" id="nomComplet" name="nomComplet" required>
        </div>
        <div>
            <label for="description">Description :</label>
            <textarea id="description" name="description" rows="5" cols="33" required></textarea>
        </div>
        <div>
            <label for="photo">Photo :</label>
            <input type="file" id="photo" name="photo" required>
        </div>
        <button type="submit">Ajouter</button>
    </form>
</body>

</html>