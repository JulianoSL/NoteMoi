<?php

session_start();

include_once "function.php";

$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
$confirmedPassword = filter_input(INPUT_POST, "confirmedPassword", FILTER_SANITIZE_STRING);
$submit = filter_input(INPUT_POST, "btnSubmit");

$errorMessage = "Rien a signaler";

if ($submit == "S'inscrire") {
  # nouveau compte
  if (
    $username != "" && $username != null
    && $password != "" && $password != null
    && $confirmedPassword != "" && $confirmedPassword != null
  ) {
    $errorMessage = "";
    if ($password == $confirmedPassword) {
      // Ajouter nouvel utilisateur 
      AjouterUtilisateur($username, password_hash($password, PASSWORD_DEFAULT));
      $_SESSION['user']['username'] = $username;
      $_SESSION['user']['role'] = "user";
      $_SESSION["connected"] = true;
      header("Location:index.php?body=Home.php");
    } else {
      $errorMessage = "Vous n'avez pas réécrit le même mot de passe";
    }
  } else {
    $errorMessage = "Veuillez remplir les champs !";
  }
}

?>

<body class="w3-light-grey">

  <!-- Page Container -->
  <div class="w3-content w3-margin-top" style="max-width:1400px;">

    <!-- The Grid -->
    <div class="w3-row-padding">

      <!-- Right Column -->
      <div class="main">
        <form method="POST" action="#">
          <div class="w3-container w3-card w3-white w3-margin-bottom">
            <h2 class="w3-text-grey w3-padding-16">Inscription</h2>
            <div class="w3-container">
              <label>Username</label>
              <input type="text" name="username" value="<?= $username ?>">
            </div>
            <div class="w3-container">
              <label>Entrez votre password</label>
              <input type="password" name="password" value="<?= $password ?>">
            </div>
            <div class="w3-container">
              <label>Réécrivez le mot de passe</label>
              <input type="password" name="confirmedPassword" value="<?= $confirmedPassword ?>">
            </div>
            <div class="w3-container">             
              <input type="submit" name="btnSubmit" value="S'inscrire">
            </div>
          </div>
          <div class="w3-container">
            <p><?= $errorMessage ?></p>
          </div>
        </form>

        <!-- End Right Column -->
      </div>

      <!-- End Grid -->
    </div>

    <!-- End Page Container -->
  </div>
</body>