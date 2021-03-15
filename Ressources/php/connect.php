<?php 

// Si la session n'existe pas
if (!isset($_SESSION)) 
{
  $_SESSION['user'] = [
    "username" => "",
    "role" => ""
  ];
}

$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
$submit = filter_input(INPUT_POST, "btnSubmit");

$table = rechercheUtilisateurParNom($username);
$errorMessage = "Rien à signaler !";

// Appuie sur btn Connection
if ($submit == "Se connecter")
{
  if ($username != null && $username != "" && $password != null && $password != "") {
    // Test, si utilisateur existe
    if ($table == null) {
      $errorMessage = "Cet utilisateur n'existe pas !";
    }
    else 
    {
      foreach ($table as $key) 
      {  
        // Vérification mot de passe
        if (password_verify($password, $key['Mdp']))
        {
          // accepté
          $_SESSION['user']['username'] = $key['Nom'];
          $_SESSION['user']['role'] = $key['Role'];
          $errorMessage = "connection reussie";
          // redirection vers la page body
          $_SESSION["body"] = "body.inc.php";
        }
        else {
          // non autorisé, mauvais mot de passe
          $errorMessage = "Mot de passe incorrect !";
        }
      }
    }
  }
  else {
    $errorMessage = "Veuillez remplir les champs svp !";
  }
}

// Appuie sur btn Inscription
if ($submit == "S'inscrire")
{
    // redirection vers la page inscription
    header("Location:index.php?body=inscription.php");
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
        <h2 class="w3-text-grey w3-padding-16">Bienvenue sur notre site</h2>
        <div class="w3-container">
          <label>Username</label>
          <input type="text" name="username" value="<?= $username ?>">
        </div>
        <div class="w3-container">
          <label>Password</label>
          <input type="password" name="password" value="<?= $password ?>">
        </div>
        <div class="w3-container">
            <input type="submit" name="btnSubmit" value="Se connecter">
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
