<header calss="menu">
  <nav class="navbar navbar-expand-lg navbar-light bg-light" aria-current="true">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php?body=body.php">Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <?php
            // si $_SESSION n'éxiste pas, alors on linitialise
            if (!isset($_SESSION["connected"])) {
              $_SESSION["connected"] = [];
            }
            if (!$_SESSION["connected"]) {
            ?> <a class="nav-link " aria-current="page" href="index.php?body=connect.php">Connexion</a>
            <?php } else {
            ?>
              <a class=" nav-link " aria-current=" page" href="index.php?body=disconnect.php">Deconnexion</a>
            <?php } ?>
          </li>

          <?php
          if ($_SESSION["connected"]) {
          ?>
            <li class="nav-item">
              <a class="nav-link " href="ajouter.php">Ajouter</a>
            </li>
          <?php } ?>
        </ul>
        <?php
        if (basename($_SERVER['PHP_SELF']) == "index.php") {
        ?>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        <?php } ?>
      </div>
    </div>
  </nav>
</header>