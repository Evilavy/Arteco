<?php
// Connexion à la base de données
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $datePublication = $_POST['datePublication'];
    $situation = $_POST['situation'];
    $probleme = $_POST['probleme'];
    $solution = $_POST['solution'];

    // Traitement de l'image avant
    $imgAvantName = $_FILES['srcImgAvant']['name'];
    $imgAvantTmpName = $_FILES['srcImgAvant']['tmp_name'];
    $imgAvantFolder = '../realisationRepo/avant/' . $imgAvantName;

    // Traitement de l'image après
    $imgApresName = $_FILES['srcImgApres']['name'];
    $imgApresTmpName = $_FILES['srcImgApres']['tmp_name'];
    $imgApresFolder = '../realisationRepo/apres/' . $imgApresName;

    // Téléversement des images
    move_uploaded_file($imgAvantTmpName, $imgAvantFolder);
    move_uploaded_file($imgApresTmpName, $imgApresFolder);

    // Préparation de la requête d'insertion
    $sql = "INSERT INTO Realisations (titre, datePublication, situation, probleme, solution, srcImgAvant, srcImgApres) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titre, $datePublication, $situation, $probleme, $solution, $imgAvantFolder, $imgApresFolder]);

    echo "Réalisation ajoutée avec succès.";
}
?>