<!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />

    <!-- CSS stylesheets -->

    <title>Accueuil</title>
  </head>

  <!-- Header -->
  <header id="header">
    <div class="inner">
      <a href="index.php" class="logo"><strong>MEGapp</strong> by Polytech'Montpellier</a>
      <nav>
        <a href="index.php">Accueil</a>
        <a href="index.php?controleur=contact">À propos</a>
        <a href="">Mes photos</a>
        <a href="">Explorer</a>
        <a href="">Galerie</a>
        <a href="">Mon compte</a>
        <a href="">Déconnexion</a>
        <a href="">Connexion</a>
      </nav>
      <a><span class="fa fa-bars"></span></a>
    </div>
  </header>

  <!-- Contenu -->
  <body>
    <div>
      <?= $contenu ?>
    </div>
  </body>

  <!-- Footer -->
  <footer id="footer">
    <div>
      <header>
        <h3>Bienvenue sur votre site d'exploration interactive</h3>
			</header>
      <div class="copyright">
        &copy; 2017 - Mégane Wintz pour Polytech Montpellier
        <a href="">About Me</a>
        <a href="">Contact</a>
        <br>Design: <a href="https://templated.co">TEMPLATED</a>. Images: <a href="https://unsplash.com">Unsplash</a>.
      </div>
    </div>
  </footer>

  <!-- Import Javascript (AngularJS/JQuery/Bootstrap) -->


</html>
