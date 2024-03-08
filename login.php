<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require 'db.php';

  // Données du formulaire de connexion
  $username = $_POST['username'];
  $plainPassword = $_POST['password'];

  // Requête SQL pour obtenir l'utilisateur par nom d'utilisateur
  $sql = "SELECT * FROM adminAccount WHERE username = ?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$username]);
  $user = $stmt->fetch();

  // Vérification si l'utilisateur existe et si le mot de passe est correct
  if ($user && password_verify($plainPassword, $user['password'])) {
    // Connexion réussie
    // Mettre en place la session ou les cookies selon vos besoins
    session_start();
    $_SESSION['user'] = $user; // Stocke les informations de l'utilisateur dans la session
    // Redirection vers le panneau d'administration ou une autre page
    header('Location: admin.html');
    exit;
  } else {
    // Échec de la connexion
    $error = 'Nom d\'utilisateur ou mot de passe incorrect';
  }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #e9ecef;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    form {
      background-color: #ffffff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      width: 300px;
    }

    h2 {
      color: #333;
      margin-bottom: 20px;
      text-align: center;
      font-size: 24px;
    }

    label {
      color: #495057;
      margin-bottom: 5px;
      display: block;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ced4da;
      border-radius: 5px;
      box-sizing: border-box;
      font-size: 16px;
    }

    button {
      width: 100%;
      padding: 10px 0;
      border: none;
      border-radius: 5px;
      background-color: #28a745;
      color: #fff;
      cursor: pointer;
      font-size: 18px;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #218838;
    }

    .error {
      background-color: #f8d7da;
      color: #721c24;
      padding: 10px;
      margin-bottom: 20px;
      border-radius: 5px;
      border: 1px solid #f5c6cb;
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
      visibility: hidden;
      height: 0;
      overflow: hidden;
    }

    .error.active {
      opacity: 1;
      visibility: visible;
      height: auto;
    }
  </style>
</head>

<body>
  <form action="login.php" method="post">
    <h2>Connexion</h2>
    <div class="error <?= isset($error) ? 'active' : '' ?>">
      <?= isset($error) ? htmlspecialchars($error) : '' ?>
    </div>
    <label for="username">Nom d'utilisateur</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Connexion</button>
  </form>

  <script>
    // Script pour la gestion de l'affichage de l'erreur
    const errorDiv = document.querySelector('.error');
    if (errorDiv.innerHTML.trim() !== '') {
      errorDiv.classList.add('active');
    }
  </script>
</body>

</html>