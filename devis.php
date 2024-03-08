<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$titrePrestation = isset($_GET['prestation']) ? urldecode($_GET['prestation']) : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecte des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $codePostal = $_POST['code_postal'];
    $telephone = $_POST['telephone'];

    // L'adresse email de destination
    $to = 'evilavy250704@gmail.com';

    // Le sujet de l'email
    $subject = 'Demande de devis';

    // Contenu de l'email
    $message = "Nom: " . $nom . "\n";
    $message .= "Prénom: " . $prenom . "\n";
    $message .= "Code Postal: " . $codePostal . "\n";
    $message .= "Téléphone: " . $telephone . "\n";

    // Ajoute uniquement les projets sélectionnés au message
    if ($_POST['facade'] == '1') {
        $message .= "Façade\n";
    }
    if ($_POST['ventilation'] == '1') {
        $message .= "Ventilation\n";
    }
    if ($_POST['pompe_chaleur'] == '1') {
        $message .= "Pompe à chaleur\n";
    }
    if ($_POST['isolation'] == '1') {
        $message .= "Isolation\n";
    }
    if ($_POST['autre'] == '1') {
        $message .= "Autre projet\n";
    }

    echo '<script>console.log(' . json_encode($message) . ');</script>';

    // En-têtes de l'email
    $headers = "From: webmaster@example.com";

    // Envoi de l'email
    if (mail($to, $subject, $message, $headers)) {
        echo "Mail sent successfully!";
    } else {
        echo "Mail not sent!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0,user-scalable=0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/nav.css">
    <link rel="stylesheet" href="styles/footer.css">
    <title>Document</title>
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
            background-color: #f1f1f1;
            overflow-x: hidden !important;
            max-width: 100vw;
        }

        h1 {
            color: #13A106;
            font-size: 1.5em;
        }

        .contDevis {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-top: 20px;
            flex-direction: column;
        }

        .contForm {
            display: flex;
            justify-content: center;
            align-items: center;
            width: calc(650px + 560px - 200px);
            height: 600px;
            min-height: 650px;
            max-width: 100vw;
            overflow-x: hidden;
        }

        .form {
            height: 560px;
            width: 560px;
            background-color: #fff;
            margin-left: -200px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
            position: relative;
            height: 100%;
            width: 100%;
            padding: 20px;
        }

        .contForm img {
            width: 650px;
            height: 650px;
            object-fit: cover;
        }

        .two {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-direction: row;
        }

        .two input {
            width: 49%;
        }

        input,
        select {
            width: 100%;
            border-radius: 10px;
            border: 0.5px solid gray;
            padding: 7px 20px;
        }

        #submit {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background-color: #13A106;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 100px;
        }

        #projects {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .project-item {
            cursor: pointer;
            padding: 5px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            background-color: #d4d4d4;
            color: gray;
        }

        .project-item.selected {
            background-color: #4CAF50;
            color: white;
        }

        .project-icon {
            margin-right: 8px;
        }

        .checked {
            color: green;
        }

        #submit:disabled {
            background-color: #999;
            cursor: not-allowed;
        }

        button#call-us {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            background-color: #13A106;
            border: none;
            border-radius: 100%;
            padding: 10px;
            height: 70px;
            width: 70px;
            animation: pulse 2s infinite;
        }

        button#call-us img {
            height: 20px;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(0, 255, 42, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(0, 255, 51, 0);
            }

            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(0, 255, 60, 0);
            }
        }

        @media (max-width: 1100px) {
            .contDevis {
                margin-top: 100px;
            }

            .contForm {
                display: flex;
                justify-content: center;
                align-items: center;
                width: calc(550px + 460px - 200px);
                height: 600px;
            }

            .form {
                height: 460px;
                width: 460px;
                background-color: #fff;
                margin-left: -200px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }


            .contForm img {
                width: 550px;
                height: 550px;
                object-fit: cover;
            }

            .contDevis {
                height: 70vh;
            }
        }

        @media (max-width: 865px) {
            .contForm {
                display: flex;
                justify-content: center;
                align-items: center;
                width: calc(550px + 460px - 200px);
                height: 600px;
            }

            .form {
                height: 460px;
                width: 460px;
                background-color: #fff;
                margin-left: -300px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }


            .contForm img {
                width: 550px;
                height: 550px;
                object-fit: cover;
            }

            button#call-us img {
                height: 15px;
            }

            button#call-us {
                top: 19px;
                right: 20px;
                height: 50px;
                width: 50px;
            }
        }

        @media (max-width: 760px) {
            .form {
                margin-left: -505px;
                backdrop-filter: blur(2px) saturate(200%);
                -webkit-backdrop-filter: blur(2px) saturate(200%);
                background-color: rgba(255, 255, 255, 0.84);
                border: 1px solid rgba(209, 213, 219, 0.3);
            }

            .contDevis {
                margin-right: 45px;
            }
        }

        @media (max-width: 600px) {
            h1 {
                text-align: center;
            }

            .contForm {
                display: flex;
                justify-content: center;
                align-items: center;
                width: calc(490px + 400px - 200px);
                height: 600px;
            }

            .form {
                height: 450px;
                width: 400px;
                margin-left: -445px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }


            .contForm img {
                width: 490px;
                height: 490px;
                object-fit: cover;
            }

            footer {
                margin-top: 150px;
            }
        }

        @media (max-width: 550px) {
            .contDevis {
                margin-right: 5vw;
            }

            .contForm {
                display: flex;
                justify-content: center;
                align-items: center;
                width: calc(90vw + 80vw - 200px);
                height: 600px;
            }

            .form {
                height: 500px;
                width: 80vw;
                margin-left: -85vw;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }


            .contForm img {
                width: 90vw;
                height: 550px;
                object-fit: cover;
            }

            .two {
                flex-direction: column;
                gap: 10px;
            }

            .two input {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .form {
                height: 550px;
                width: 80vw;
                margin-left: -85vw;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }


            .contForm img {
                width: 90vw;
                height: 600px;
                object-fit: cover;
            }
        }
    </style>
</head>

<body>
    <?php include 'components/nav.php' ?>
    <div class="contDevis">
        <div class="contForm">
            <img src="assets/defaultArticle.webp" alt="">
            <div class="form">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <h1>Commençons maintenant !</h1>
                    <div class="two">
                        <input type="text" name="nom" placeholder="Nom" required>
                        <input type="text" name="prenom" placeholder="Prénom" required>
                    </div>
                    <div class="two">
                        <input type="number" name="telephone" placeholder="Téléphone" required>
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <select id="departement" name="code_postal" required>
                        <option value="">Sélectionnez votre département</option>
                        <!-- Les options seront ajoutées ici par JavaScript -->
                    </select>
                    <p>Votre projet</p>
                    <input type="hidden" name="facade" id="projet_facade" value="0">
                    <input type="hidden" name="ventilation" id="projet_ventilation" value="0">
                    <input type="hidden" name="pompe_chaleur" id="projet_pompe_chaleur" value="0">
                    <input type="hidden" name="isolation" id="projet_isolation" value="0">
                    <input type="hidden" name="autre" id="projet_autre" value="0">
                    <div id="projects">
                        <div class="project-item" data-project="facade" onclick="toggleCheck(this)">
                            <span class="project-icon fas fa-plus"></span>Façade
                        </div>
                        <div class="project-item" data-project="ventilation" onclick="toggleCheck(this)">
                            <span class="project-icon fas fa-plus"></span>Ventilation
                        </div>
                        <div class="project-item" data-project="pompe_chaleur" onclick="toggleCheck(this)">
                            <span class="project-icon fas fa-plus"></span>Pompe à chaleur
                        </div>
                        <div class="project-item" data-project="isolation" onclick="toggleCheck(this)">
                            <span class="project-icon fas fa-plus"></span>Isolation
                        </div>
                        <div class="project-item" data-project="autre" onclick="toggleCheck(this)">
                            <span class="project-icon fas fa-plus"></span>Autre
                        </div>
                    </div>
                    <button id="submit" type="submit" disabled>ENVOYER MA DEMANDE DE DEVIS</button>
                </form>
            </div>
        </div>
    </div>
    <a href="tel:+0423054301">
        <button id="call-us"><img src="assets/Phone-call.png" alt="Call Us"></button>
    </a>
    <div class="overlayMenu"></div>
    <script src="script/nav.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var inputs = document.querySelectorAll('input[type=text], input[type=email], input[type=tel]');
            var projectItems = document.querySelectorAll('.project-item');

            inputs.forEach(function (input) {
                input.addEventListener('input', checkFormStatus);
            });

            projectItems.forEach(function (item) {
                item.addEventListener('click', checkFormStatus);
            });
        });

        function checkFormStatus() {
            var allFilled = true;
            var projectSelected = false;
            var inputs = document.querySelectorAll('input[type=text], input[type=email], input[type=tel]');
            var projectItems = document.querySelectorAll('.project-item');

            inputs.forEach(function (input) {
                if (input.value === '') {
                    allFilled = false;
                }
            });

            projectItems.forEach(function (item) {
                if (item.classList.contains('selected')) {
                    projectSelected = true;
                }
            });

            if (allFilled && projectSelected) {
                document.getElementById('submit').disabled = false;
            } else {
                document.getElementById('submit').disabled = true;
            }
        }

        function toggleCheck(element) {
            var icon = element.querySelector('.project-icon');
            var isPlus = icon.classList.contains('fa-plus');
            var projectId = element.getAttribute('data-project');

            icon.classList.toggle('fa-plus', !isPlus);
            icon.classList.toggle('fa-check', isPlus);

            element.classList.toggle('selected', isPlus);

            document.getElementById('projet_' + projectId).value = isPlus ? '1' : '0';
            checkFormStatus();
        }

        document.addEventListener('DOMContentLoaded', function () {
            const selectDepartement = document.getElementById('departement');

            fetch('https://geo.api.gouv.fr/departements')
                .then(response => response.json())
                .then(data => {
                    data.forEach(departement => {
                        const option = document.createElement('option');
                        option.value = departement.code;
                        option.textContent = `${departement.code} - ${departement.nom}`;
                        selectDepartement.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur lors du chargement des départements:', error));
        });
    </script>
    <?php include 'components/footer.php' ?>

</body>

</html>