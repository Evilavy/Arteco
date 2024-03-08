<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter une Prestation</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            /* Pour s'assurer que le padding ne déborde pas de la largeur définie */
        }

        textarea {
            resize: vertical;
            /* Permet à l'utilisateur de redimensionner verticalement le textarea */
        }

        button {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #003d82;
        }
    </style>
</head>

<body>
    <a href="../admin.html" style="position: absolute; top: 20px; left: 20px;"><img style="height: 40px;"
            src="../assets/Menu.png" alt="Menu"></a>
    <div class="container">
        <h1>Ajouter une nouvelle prestation</h1>
        <form action="save_prestation.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titre">Titre :</label>
                <input type="text" name="titre" id="titre" required>
            </div>

            <div class="form-group">
                <label for="description">Description :</label>
                <textarea name="description" id="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="photo">Photo :</label>
                <input type="file" name="photo" id="photo" required>
            </div>

            <button type="submit">Ajouter la prestation</button>
        </form>
    </div>
</body>

</html>