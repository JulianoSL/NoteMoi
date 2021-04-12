<?php
$TabProduits = selectAllProduct();
$nomProduit = filter_input(INPUT_GET, "nomProduit", FILTER_SANITIZE_STRING);

if ($nomProduit) {
  $produits = selectProductFromName($nomProduit);
  $prix = $produits["Prix"];
  $marque = $produits["Marque"];
  $type = $produits["Type"];
  $image = $produits["Image"];
  $nom = $produits["Nom"];
  $idProduit = $produits["idProduit"];
} else {
  $prix = $TabProduits[0]["Prix"];
  $marque = $TabProduits[0]["Marque"];
  $type = $TabProduits[0]["Type"];
  $image = $TabProduits[0]["Image"];
  $nom = $TabProduits[0]["Nom"];
  $idProduit = $TabProduits[0]["idProduit"];
}


if (isset($_POST["Ajouter"])) {
  $note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_STRING);
  $commentaire = filter_input(INPUT_POST, "commentaire", FILTER_SANITIZE_STRING);
  if ($note && $commentaire) {
    if (ajouterAvis($commentaire, $idProduit, $_SESSION["user"]["IdUtilisateur"], $note)) {
      //si l'ajout a bien marché , on redirige sur la page home
      header("Location:index.php?body=Home.php");
    }
  }
}
?>

<body class="w3-light-grey">
  <form action="" method="post">
    <!-- Page Container -->
    <div class="w3-content w3-margin-top" style="max-width:1400px;">

      <!-- The Grid -->
      <div class="w3-row-padding">

        <!-- Left Column -->
        <div class="w3-third">

          <div class="w3-white w3-text-grey w3-card-4">
            <div class="w3-display-container">
              <h2><?= $nom; ?></h2>
              <img src="Ressources/img/<?= $image; ?>" style="width:100%" alt="Avatar">
              <div class="w3-display-bottomleft w3-container w3-text-black">
                <select onchange="reloadPage(this.value)">
                  <?php
                  foreach ($TabProduits as $key => $value) {
                    $selected = "";
                    if (isset($produits)) {
                      if ($value["idProduit"] == $produits["idProduit"]) {
                        $selected = "selected";
                      }
                    }
                    echo '<option value="' . $value["Nom"] . '"' . $selected . '>' . $value["Nom"] . '</option>';
                  }

                  ?>
                </select>
              </div>
            </div>
            <div class="w3-container">
              <p><i class="fa fa-money fa-fw w3-margin-right w3-large w3-text-teal"></i><?= $prix; ?></p>
              <p><i class="fa fa-group fa-fw w3-margin-right w3-large w3-text-teal"></i><?= $marque; ?></p>
              <p><i class="fa fa-info fa-fw w3-margin-right w3-large w3-text-teal"></i><?= $type; ?></p>
              <hr>
              <input type="submit" name="Ajouter" value="Ajouter un avis" class="Ajouter" />
              <br>
              <br>
            </div>
          </div><br>

          <!-- End Left Column -->
        </div>

        <!-- Right Column -->
        <div class="w3-twothird">

          <div class="w3-container w3-card w3-white w3-margin-bottom">
            <h2 class="w3-text-grey w3-padding-16">Ajouter un avis</h2>
            <div class="w3-container">
              <form methode="POST">
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Ajouter un commentaire</label>
                  <textarea class="form-control areaAvis" id="exampleFormControlTextarea1" rows="3" name="commentaire"></textarea>
                </div>
                <br>
              </form>
            </div>
          </div>

          <div class="w3-container w3-card w3-white">
            <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Note :</h2>
            <input type="number" name="note" step=".5" min=1 max=6 required>
            <hr>
          </div>

          <!-- End Right Column -->
        </div>
        <!-- End Grid -->
      </div>

      <!-- End Page Container -->
    </div>
  </form>
</body>
<script>
  function reloadPage(nomProduit) {
    window.location.replace("index.php?body=addAvis.php&nomProduit=" + nomProduit + "");
  }
</script>