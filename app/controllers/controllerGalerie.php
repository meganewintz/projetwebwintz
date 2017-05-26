<?php
require_once '../../config/connexionBDD.php';
require_once '../ORMs/ORMPhoto.php';
require_once '../ORMs/ORMUtilisateur.php';
require_once '../ORMs/ORMVille.php';
require_once '../ORMs/ORMPays.php';
require_once '../ORMs/ORMCategorie.php';



/**
 * Affichage des images selon la catégorie choisie
 *
 * @param PDO $db
 * @param string $choixCategorie
 * @return void
 */
function afficherPhotosCategorie($db, $choixCategorie)
{
  $ormPhoto = new ORMPhoto($db);
  $listePhotos = $ormPhoto->getAllPhotosCategorie($choixCategorie);
  if ( !empty($listePhotos) )
  {
    foreach($listePhotos as $photo)
    {
      $idPhoto = $photo->getIdPhoto();
      $texte = $photo->getTitre() . ", " . $ormPhoto->getVille($idPhoto). ", " . $ormPhoto->getPays($idPhoto) . "<br/>Description: " . $photo->getDescription() . "<br/>Postée par " . $ormPhoto->getUtilisateur($idPhoto) .".";
      echo "<div class=\"media all people\">
        <a href=\"" . $photo->getUrlFull() . "\"><img src=\"" .$photo->getUrlThumb() . "\" alt=\"\" title=\"" . $texte . "\" /></a>
      </div>";
    }
  }
  else
  {
    echo "Il n'y a pas encore de photos dans cette catégorie.";
  }
}

/**
 * Affichage des images pour l'utilisateur choisi
 *
 * @param PDO $db
 * @param string $choixUtilisateur
 * @return void
 */
function afficherPhotosUtilisateur($db, $choixUtilisateur)
{
  $ormPhoto = new ORMPhoto($db);
  $listePhotos = $ormPhoto->getAllPhotosUtilisateur($choixUtilisateur);
  foreach($listePhotos as $photo)
  {
    $idPhoto = $photo->getIdPhoto();
    $texte = $photo->getTitre() . ", " . $ormPhoto->getVille($idPhoto). ", " . $ormPhoto->getPays($idPhoto) . "<br/>Description: " . $photo->getDescription() . "<br/>Postée par " . $ormPhoto->getUtilisateur($idPhoto) .".";
    echo "<div class=\"media all people\">
      <a href=\"" . $photo->getUrlFull() . "\"><img src=\"" .$photo->getUrlThumb() . "\" alt=\"\" title=\"" . $texte . "\" /></a>
    </div>";
  }
}

/**
 * Affichage des images pour la ville choisie
 *
 * @param PDO $db
 * @param string $choixVille
 * @return void
 */
function afficherPhotosVille($db, $choixVille)
{
  $ormPhoto = new ORMPhoto($db);
  $listePhotos = $ormPhoto->getAllPhotosVille($choixVille);
  foreach($listePhotos as $photo)
  {
    $idPhoto = $photo->getIdPhoto();
    $texte = $photo->getTitre() . ", " . $ormPhoto->getVille($idPhoto). ", " . $ormPhoto->getPays($idPhoto) . "<br/>Description: " . $photo->getDescription() . "<br/>Postée par " . $ormPhoto->getUtilisateur($idPhoto) .".";
    echo "<div class=\"media all people\">
      <a href=\"" . $photo->getUrlFull() . "\"><img src=\"" .$photo->getUrlThumb() . "\" alt=\"\" title=\"" . $texte . "\" /></a>
    </div>";
  }
}

/**
 * Affichage des images selon la catégorie choisie
 *
 * @param PDO $db
 * @param string $choixPays
 * @return void
 */
function afficherPhotosPays($db, $choixPays)
{
  $ormPhoto = new ORMPhoto($db);
  $listePhotos = $ormPhoto->getAllPhotosPays($choixPays);
  if ( !empty($listePhotos) )
  {
    foreach($listePhotos as $photo)
    {
      $idPhoto = $photo->getIdPhoto();
      $texte = $photo->getTitre() . ", " . $ormPhoto->getVille($idPhoto). ", " . $ormPhoto->getPays($idPhoto) . "<br/>Description: " . $photo->getDescription() . "<br/>Postée par " . $ormPhoto->getUtilisateur($idPhoto) .".";
      echo "<div class=\"media all people\">
        <a href=\"" . $photo->getUrlFull() . "\"><img src=\"" .$photo->getUrlThumb() . "\" alt=\"\" title=\"" . $texte . "\" /></a>
      </div>";
    }
  }
  else
  {
    echo "Il n'y a pas encore de photos pour ce pays.";
  }
}

/**
 * Affichage toutes les photos de notre base de données
 *
 * @param PDO $db
 * @return void
 */
function afficherPhotos($db)
{
  $ormPhoto = new ORMPhoto($db);
  $listePhotos = $ormPhoto->getAllPhotos();
  foreach($listePhotos as $photo)
  {
    $idPhoto = $photo->getIdPhoto();
    $texte = $photo->getTitre() . ", " . $ormPhoto->getVille($idPhoto). ", " . $ormPhoto->getPays($idPhoto) . "<br/>Description: " . $photo->getDescription() . "<br/>Postée par " . $ormPhoto->getUtilisateur($idPhoto) .".";
    echo "<div class=\"media all people\">
      <a href=\"" . $photo->getUrlFull() . "\"><img src=\"" .$photo->getUrlThumb() . "\" alt=\"\" title=\"" . $texte . "\" /></a>
    </div>";
  }
}

if(!($_POST['categorie'] == ""))
{
    $choix=$_POST['categorie'];
}
elseif(!($_POST['utilisateur'] == ""))
{
    $choix=$_POST['utilisateur'];
}
elseif(!($_POST['ville'] == ""))
{
    $choix=$_POST['ville'];
}
if(!($_POST['pays'] == ""))
{
    $choix=$_POST['pays'];
}
