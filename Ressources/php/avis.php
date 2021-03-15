<?php



?>

<body class="w3-light-grey">

  <!-- Page Container -->
  <div class="w3-content w3-margin-top" style="max-width:1400px;">

    <!-- The Grid -->
    <div class="w3-row-padding">
      <!-- Right Column -->
      <div class="main">

        <div class="w3-container w3-card w3-white w3-margin-bottom">
          <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>Work Experience</h2>
          <div class="w3-container">
            <img src="" alt="">
          </div>
        
            <div>
            <?php

            function LireAvis($tableAvis)
            {
                $text = "";
                foreach ($tableAvis as $key) 
                {
                    $text .= "<div>";
                    $text .= "<h2>" . $key["titre"] ."</h2>";
                    $text .= "<p>" . $key["commentaire"] ."</p>";
                    $text .= "</div>";
                }
                return $text;
            }

            ?>
            </div>


        <!-- End Right Column -->
      </div>

      <!-- End Grid -->
    </div>

    <!-- End Page Container -->
  </div>


</body>
