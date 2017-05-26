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
              <h1>Galerie photos</h1>

              s
              <form name="choixAffichage" method="post" action='galerie.php'>
                  <a href="#" data-tag="all" class="button active">Tout afficher</a>
                  <select name="categorie">
                    <option value="">Affichage par categorie</option>
                    <?php $ormCategorie = new ORMCategorie($bdd);
                    $listeCategories = $ormCategorie->getAllCategories();
                    foreach ($listeCategories as $categorie) {
                        echo "<option value=\"" . $categorie . "\">" . $categorie . "</option>";
                    }
                    ?>
                  </select>
                  <select name="utilisateur">
                    <option value="">Affichage par utilisateur</option>
                    <?php $ormUtilisateur = new ORMUtilisateur($bdd);
                    $listeUtilisateurs = $ormUtilisateur->getAllUtilisateurs();
                    foreach ($listeUtilisateurs as $utilisateur) {
                        echo "<option value=\"" . $utilisateur . "\">" . $utilisateur . "</option>";
                    }
                    ?>
                  </select>
                  <select name="ville">
                    <option value="">Affichage par ville</option>
                    <?php $ormVille = new ORMVille($bdd);
                    $listeVilles = $ormVille->getAllVilles();
                    foreach ($listeVilles as $ville) {
                        echo "<option value=\"" . $ville . "\">" . $ville . "</option>";
                    }
                    ?>
                  </select>
                  <select name="pays">
                    <option value="">Affichage par pays</option>
                    <?php $ormPays = new ORMPays($bdd);
                    $listePays = $ormPays->getAllPays();
                    foreach ($listePays as $pays) {
                        echo "<option value=\"" . $pays . "\">" . $pays . "</option>";
                    }
                    ?>
                  </select>
                  <input type="submit" name="valider" value="OK"/><br/>
              </form>
            </header>

            <div class="content" id="content">
              <?php
              //Gérer chaque choix :
              if (!($_POST['categorie'] == ""))
              {
                afficherPhotosCategorie($bdd, $choix);
              }
              elseif (!($_POST['utilisateur'] == ""))
              {
                afficherPhotosUtilisateur($bdd, $choix);
              }
              elseif (!($_POST['ville'] == ""))
              {
                afficherPhotosVille($bdd, $choix);
              }
              elseif (!($_POST['pays'] == ""))
              {
                afficherPhotosPays($bdd, $choix);
              }
              else {
                afficherPhotos($bdd);
              }
              ?>
            </div>
        </div>
        <script src="../js/galerie.js"></script>
<?php require_once "footer.php"; ?>
