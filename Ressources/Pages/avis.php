<?php

$idAvis = filter_input(INPUT_GET, "idAvis", FILTER_VALIDATE_INT);
if($idAvis)
{
  $avis = returnAvis($idAvis);
  $utilisateur = returnNameUtilisateur($avis["IdUtilisateur"]);
  $produit = returnProduit($avis["idProduit"]);
}


  
?>

<body class="w3-light-grey">
  <!-- Page Container -->
  <div class="w3-content w3-margin-top" style="max-width:1400px;">

    <!-- The Grid -->
    <div class="w3-row-padding">

      <!-- Left Column -->
      <div class="w3-third">

        <div class="w3-white w3-text-grey w3-card-4">
          <div class="w3-display-container">
            <img src="Ressources/img/<?= $produit["Image"]?>" style="width:100%" alt="Avatar">
          </div>
          <div class="w3-container w3-card w3-white">
          <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i><?= $produit["Nom"]?></h2>
          <div class="w3-container">
            <h5 class="w3-opacity"><b>Marque</b></h5>
            <p><?= $produit["Marque"]?></p>
            <hr>
          </div>
          <div class="w3-container">
            <h5 class="w3-opacity"><b>Type produit</b></h5>
            <p><?= $produit["Type"]?></p>
            <hr>
          </div>
          <div class="w3-container">
            <h5 class="w3-opacity"><b>Prix (CHF)</b></h5>
            <p><?= $produit["Prix"]?>.-</p><br>
          </div>
        </div>
        </div><br>

        <!-- End Left Column -->
      </div>


      <!-- Right Column -->
      <div class="w3-twothird">
        <div class="w3-container w3-card w3-white w3-margin-bottom">
          <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-user fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i><?= $utilisateur["Nom"]?></h2>
          <div class="w3-container">
            <h5 class="w3-opacity"><b>Commentaire</b></h5>
            <p><?= $avis["Commentaire"]?></p>
            <hr>
          </div>
          <div class="w3-container">
            <h5 class="w3-opacity"><b>Note</b></h5>
            <p><?= $avis["Note"]?></p>
            <hr>
          </div>
        </div>

        <!-- End Right Column -->
      </div>

      <!-- End Grid -->
    </div>

    <!-- End Page Container -->
  </div>
</body>

