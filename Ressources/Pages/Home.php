<?php
$motRecherche = "";
if (!isset($_SESSION["offset"])) {
  $_SESSION["offset"] = 0;
}
if (isset($_POST["Avancer"])) {
  if (!$_SESSION["offset"] >= countNombreAvis()) {
    $_SESSION["offset"] += 5;
  }
}
if (isset($_POST["Reculer"])) {
  if ($_SESSION["offset"] - 5 < 0) {
    $_SESSION["offset"] = 0;
  } else {
    $_SESSION["offset"] -= 5;
  }
}
if (isset($_POST["Search"])) {
  $motRecherche = filter_input(INPUT_POST, "Content", FILTER_SANITIZE_STRING);  
}
$avis = rechercherAvis($_SESSION["offset"], $motRecherche);
?>

<body class="w3-light-grey">
  <!-- Page Container -->
  <div class="w3-content w3-margin-top" style="max-width:1400px;">
    <?= afficherToutAvis($avis); ?>
    <form action="" method="post">
      <input type="submit" name="Reculer" value="<" />
      <input type="submit" name="Avancer" value=">" class="droite" />
    </form>
    <!-- End Page Container -->
  </div>