<?php
require_once '../../config/connexionBDD.php';
require_once "header.php";
require_once "../controllers/controllerGalerie.php";
?>
<!-- CSS stylesheets -->
<link rel="stylesheet" href="/public/css/galerie.css" />

<!-- Header -->
    <header id="header">
      <div>Snapshot <span>by TEMPLATED</span></div>
    </header>

  <!-- Gallery -->
    <section id="galleries">

      <!-- Photo Galleries -->
        <div class="gallery">

          <!-- Filters -->
            <header>
              <h1>Gallery</h1>
              <ul class="tabs">
                <li><a href="#" data-tag="all" class="button active">All</a></li>
                <!-- <li> -->
                  <!-- <FORM NAME="choixCategorie">
                    <SELECT NAME="listeCategorie" onChange="affichageParCategorie()">
                      <OPTION VALUE="">Catégorie
                      <OPTION VALUE="../../copains.html">Les copains
                      <OPTION VALUE="../../plongee/index.html">La plongée
                      <OPTION VALUE="http://www.google.com">Recherche
                      </SELECT>
                    </FORM></li> -->
                <li><a href="#" id ="utilisateur" onClick="afficherParUtilisateurs()" class="button">Utilisateur</a></li>
                <li><a href="#" id="categorie" onClick="afficherParCategories()" class="button">Catégorie</a></li>
                <li><a href="#" id="ville" onClick="afficherParVilles()" class="button">Ville</a></li>
                <li><a href="#" id="pays" onClick="afficherPays()" class="button">Pays</a></li>
              </ul>
            </header>

            <div class="content" id="content">
              <?php afficherPhotos($bdd, ""); ?>
            </div>
        </div>
        <script src="../js/galerie.js"></script>
<?php require_once "footer.php"; ?>
