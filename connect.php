<?php 

session_start();

// Si la session n'existe pas
if (!isset($_SESSION)) 
{
  $_SESSION['user'] = [
    "username" => "",
    "role" => ""
  ];  
}

require_once "Ressources/php/function.php";

$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
$submit = filter_input(INPUT_POST, "btnSubmit");

$table = rechercheUtilisateurParNom($username);

// Appuie sur btn Connection
if ($submit == "Se connecter")
{
  // Test, si utilisateur existe
  foreach ($table as $key) 
  {
    if ($username == $key['Nom'])
    {
      // Vérification mot de passe
      if (password_verify($password, $key['Mdp']))
      {
        // accepté
        $_SESSION['user']['username'] = $key['Nom'];
        $_SESSION['user']['role'] = $key['Role'];
        echo "connection reussie";
        /*
        header("location: inscription.php");
        exit();
        */
      }
      else {
        // non autorisé, mauvais mot de passe
        $errorMessage = "Mot de passe incorrect !";
      }
    }
    else {
      // L'utilisateur n'existe pas
      $errorMessage = "Cet utilisateur n'existe pas , voulez vous vous inscrire ?";
    }
  }
}

// Appuie sur btn Inscription
elseif ($submit == "S'inscrire'") 
{
    # nouveau compte
    header("location: inscription.php");
    exit();
}

?>
<!DOCTYPE html>
<html>
<title>Menu</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<link rel="stylesheet" href="Ressources/css/style.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
</style>
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
      </form>

    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>

<?php include_once("Ressources/php/footer.inc.php")?>

</body>
</html>     