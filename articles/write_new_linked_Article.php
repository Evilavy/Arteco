<?php
// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les données du formulaire
    $titre = $_POST['titre'];
    $datePublication = $_POST['datePublication'];
    $lien = $_POST['lien'];

    // Inclure le fichier de connexion à la base de données
    include '../db.php'; // Assurez-vous que le chemin est correct

    // Préparez la requête SQL pour insérer l'article
    $stmt = $pdo->prepare("INSERT INTO Article (titre, datePublication, published, isLien, lien) VALUES (?, ?, 1, 1, ?)");
    $stmt->bindParam(1, $titre);
    $stmt->bindParam(2, $datePublication);
    $stmt->bindParam(3, $lien);

    // Exécutez la requête et vérifiez si elle a réussi
    if ($stmt->execute()) {
        echo "Article ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'article : " . $stmt->errorInfo()[2]; // Utiliser errorInfo pour PDO
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un Article Lien</title>
</head>

<body>
    <form action="write_new_linked_Article.php" method="post">
        <label for="titre">Titre de l'article:</label><br>
        <input type="text" id="titre" name="titre" required><br><br>

        <label for="datePublication">Date de publication:</label><br>
        <input type="datetime-local" id="datePublication" name="datePublication" required><br><br>

        <label for="lien">Lien de l'article:</label><br>
        <input type="url" id="lien" name="lien" required><br><br>

        <input type="submit" value="Ajouter l'article">
    </form>
</body>

</html>