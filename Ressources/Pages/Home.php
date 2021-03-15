<?php
$avis = rechercherAvis();
?>

<body class="w3-light-grey">

  <!-- Page Container -->
  <div class="w3-content w3-margin-top" style="max-width:1400px;">
    <?= afficherToutAvis($avis); ?>
    <!-- End Page Container -->
  </div>


</body>