<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="Contenu/css/bootstrap.min.css" />
  <link rel="stylesheet" href="Contenu/css/style.css" />
  <link rel="stylesheet" href="Contenu/css/form.css" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title><?= $titre ?></title>
</head>

<body>
  <div id="global">
    <header>
    <!-- Start Navbar -->
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <a href="index.php?page=accueil" class="navbar-brand">
            <h1>Sorbet'</h1>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php?page=accueil">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?page=friend">Amis</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?page=bet">Paris</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php?page=panier">Panier</a>
              </li>
            </ul>
            
            <form class="form-inline my-2 my-lg-0">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="index.php?page=connexion">Connexion</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php?page=register">Inscription</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php?action=deconnexion">Déconnexion</a>
                </li>
              </ul>
            </form>
          </div>
        </nav>
      </div>
      <!-- Fin navbar -->
    </header>

    <br>
    <!-- Start Content -->
    <div class="container">
      <?= $contenu ?>
    </div>
    <!-- End Content -->

    <!-- Start Footer -->
    <div class="container">
      <footer style="text-align: center">
        Sorbet Copyright - 2019
      </footer>
    </div>
    <!-- End Footer -->

  </div> <!-- #global -->
</body>

<script src="Content/js/jquery-1.11.1.min.js"></script>
<script src="Content/js/bootstrap.min.js"></script>

</html>