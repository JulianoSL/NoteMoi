<?php 
$produits = selectAllProduct();



?>
<body class="w3-light-grey">
  <form action="">
    <!-- Page Container -->
    <div class="w3-content w3-margin-top" style="max-width:1400px;">

      <!-- The Grid -->
      <div class="w3-row-padding">

        <!-- Left Column -->
        <div class="w3-third">

          <div class="w3-white w3-text-grey w3-card-4">
            <div class="w3-display-container">
              <img src="Ressources/img/casque.jpg" style="width:100%" alt="Avatar">
              <div class="w3-display-bottomleft w3-container w3-text-black">
                <h2>Nom Produit</h2>
              </div>
            </div>
            <div class="w3-container">
              <p><i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-teal"></i>Prix</p>
              <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-teal"></i>Marque</p>
              <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-teal"></i>QQCH</p>
              <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-teal"></i>QQCH</p>
              <hr>
              <input type="submit" name="Ajouter" value="Ajouter un avis" class="Ajouter"/>
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
                  <textarea class="form-control areaAvis" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <br>
              </form>
            </div>
          </div>

          <div class="w3-container w3-card w3-white">
            <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Note :</h2>
            <input type="number" step=".5" min=1 max=6 required>
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