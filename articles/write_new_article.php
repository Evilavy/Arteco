<?php
session_start();

// Logique de suppression de la section
if (isset($_POST['delete_section'])) {
    $indexToDelete = $_POST['section_index'];
    if (isset($_SESSION['sections'][$indexToDelete])) {
        array_splice($_SESSION['sections'], $indexToDelete, 1);
    }
}

if (!isset($_SESSION['sections'])) {
    $_SESSION['sections'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_section'])) {
        $_SESSION['sections'][] = [
            'title' => $_POST['section_title'],
            'content' => $_POST['content']
        ];
    } elseif (isset($_POST['save_article'])) {
        $_SESSION['article_title'] = $_POST['article_title'];
        header('Location: save_article.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Édition de l'article</title>
</head>

<body>
    <a href="../admin.html" style="position: absolute; top: 20px; left: 20px;"><img style="height: 40px;"
            src="../assets/Menu.png" alt=""></a>
    <h1>Éditer l'article</h1>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            text-decoration: none;
            box-sizing: border-box;
            font-family: 'Ubuntu';
        }


        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1 {
            padding: 20px;
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin: 20px auto;
            width: 80%;
            max-width: 800px;
        }

        form#noStyle {
            background-color: transparent;
            padding: 0;
            border-radius: 0;
            box-shadow: none;
            margin: 0;
            width: 0;
            max-width: 0;
        }

        .contSections {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            margin: 20px auto;
            width: 80%;
            max-width: 800px;
            max-height: 300px;
            overflow-y: scroll;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .section {
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            flex-direction: column;
            position: relative;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button,
        input[type="submit"] {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"] {
            background-color: red !important;
        }

        button:hover {
            background-color: #555;
        }

        h2 {
            font-size: 1.2rem;
        }

        p {
            font-size: 1rem;
            line-height: 1.4;
            text-indent: 40px;
        }

        p#titleSection {
            color: #F3F3F3;
            text-align: center;
            font-family: Ubuntu;
            font-size: 30px;
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            background: linear-gradient(90deg, #000 -30.03%, #13A106 107.79%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-indent: 0px;
        }

        hr {
            margin-top: 20px;
            border: none;
            border-top: 1px solid #ccc;
        }

        .delete-button {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
            font-size: 14px;
            margin-top: 10px;
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .delete-button:hover {
            background-color: #c0392b;
        }

        .fa-times {
            margin-right: 5px;
        }

        form#buttons {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        form#buttons button {
            width: 200px;
            border-radius: 10px;
        }

        button {@
            background-color: green;
        }

        button.restart {
            background-color: #e74c3c;
        }

        button.submit {
            background-color: green;
        }

        form#delete{
            background-color: transparent;
            box-shadow: none;
            padding: 0;
            margin: 0;
            width: fit-content;
            border-radius: 0;
        }
    </style>

    <!-- Formulaire pour le titre de l'article -->
    <form method="post" action="save_article.php" enctype="multipart/form-data" id="save">
        <input type="text" name="article_title" placeholder="Titre de l'article"
            value="<?php echo isset($_SESSION['article_title']) ? htmlspecialchars($_SESSION['article_title']) : ''; ?>"
            required>
        <input type="file" name="article_image" accept="image/*">
    </form>

    <!-- Affichage des sections existantes -->
    <div class="contSections">
        <?php foreach ($_SESSION['sections'] as $index => $section): ?>
            <div class="section">
                <h3>Section
                    <?= $index + 1 ?>
                </h3>
                <p>
                    <?= htmlspecialchars($section['title']) ?>
                </p>
                <p>
                    <?= htmlspecialchars($section['content']) ?>
                </p>
                <form method="post" id="delete">
                    <input type="hidden" name="section_index" value="<?= $index ?>">
                    <button type="submit" name="delete_section">Supprimer</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Formulaire pour ajouter une nouvelle section -->
    <form method="post">
        <input type="text" name="section_title" placeholder="Titre de la section" required>
        <textarea name="content" placeholder="Corps de texte" required></textarea>
        <button type="submit" name="add_section">Ajouter une section</button>
    </form>

    <!-- Formulaire pour recommencer -->
    <form action="clear_session.php" method="post" id="buttons">
        <button class="restart" type="submit">Recommencer</button>
        <button class="submit" type="submit" form="save" name="save_article">Enregistrer l'article</button>
    </form>
</body>

</html>