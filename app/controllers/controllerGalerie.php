<?php
require_once '../../config/connexionBDD.php';
require_once '../ORMs/ORMPhoto.php';
require_once '../ORMs/ORMUtilisateur.php';
require_once '../ORMs/ORMVille.php';
require_once '../ORMs/ORMPays.php';

function afficherPhotos($db, $choix)
{
  $listePhotos ="";
  $ormPhoto = new ORMPhoto($db);
  if ($choix == "") { $listePhotos = $ormPhoto->getAllPhotos(); }
  elseif ($choix == "Utilisateur") { $listePhotos = $ormPhoto->getAllPhotosUtilisateur("joh"); }
  elseif ($choix == "Categorie") { $listePhotos = $ormPhoto->getAllPhotosCategorie("Paysage"); }
  elseif ($choix == "Pays") { $listePhotos = $ormPhoto->getAllPhotosPays("France"); }
  elseif ($choix =="Ville") { $listePhotos = $ormPhoto->getAllPhotosVille("Cannes"); }

  foreach($listePhotos as $photo)
  {
    $idPhoto = $photo->getIdPhoto();
    $texte = $photo->getTitre() . ", " . $ormPhoto->getVille($idPhoto). ", " . $ormPhoto->getPays($idPhoto) . "<br/>Description: " . $photo->getDescription() . "<br/>Postée par " . $ormPhoto->getUtilisateur($idPhoto) .".";
    echo "<div class=\"media all people\">
      <a href=\"" . $photo->getUrlFull() . "\"><img src=\"" .$photo->getUrlThumb() . "\" alt=\"\" title=\"" . $texte . "\" /></a>
    </div>";
  }
}
// echo "<a href=\"/public/templated/images/fulls/05.jpg\"><img src=\"/public/templated/images/thumbs/05.jpg\" alt=\"\" title=\"This right here is a caption.\" /></a>";
//afficherPhotos($bdd);
