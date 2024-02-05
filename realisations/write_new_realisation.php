<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter une prestation</title>
</head>

<body>
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