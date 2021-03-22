<?php
<<<<<<< HEAD
session_start();  
require_once "Ressources/php/function.php";

=======

require_once "Ressources/php/function.php";

if (!isset($_SESSION["body"])) {
  $_SESSION["body"] = [];
}
>>>>>>> parent of 22e0fd3 (Page index a ne plus changer)

if (!$_SESSION["body"]) {
  $_SESSION["body"] = "Ressources/php/body.php";
} else {
  $body = filter_input(INPUT_GET, "body", FILTER_SANITIZE_STRING);
  if ($body) {
    $_SESSION["body"] = "Ressources/php/" . $body;
  }
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
<link href="Ressources/css/style.css" rel="stylesheet">
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<?php include_once("Ressources/php/navbar.inc.php") ?>
<<<<<<< HEAD

<?php include_once($_SESSION["body"]) ?>


=======
<?php include_once("Ressources/Pages/avis.php"); ?>
>>>>>>> parent of 22e0fd3 (Page index a ne plus changer)
<?php include_once("Ressources/php/footer.inc.php") ?>

</html>