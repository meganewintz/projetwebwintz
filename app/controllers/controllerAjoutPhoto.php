<?php
require_once '../../config/connexionBDD.php';
require_once '../ORMs/ORMPhoto.php';
require_once '../ORMs/ORMUtilisateur.php';
require_once '../ORMs/ORMVille.php';
require_once '../ORMs/ORMPays.php';

/**
 * Met à jour la BDD en ajoutant les données envoyées par l'utilisateur
 *
 * @param PDO $db
 * @param string $urlFull
 * @param string $urlThumb
 */
function majBdd($db, $urlFull, $urlThumb)
{
    // on créée les ORMs dont on aura besoin.
    $ormPhoto = new ORMPhoto($db);
    $ormUtilisateur = new ORMUtilisateur($db);
    $ormVille = new ORMVille($db);
    $ormPays = new ORMPays($db);


    // On ajoute la ville entrée par l'utilisateur dans la BDD si elle n'est pas déjà présente.
    $villeChoisie = ucfirst($_POST['ville']); // Pour être sure que la ville aura une majuscule
    $listeVilles = $ormVille->getAllVilles();
    if (!in_array($villeChoisie, $listeVilles))
    {
      $ormVille->insertVille($villeChoisie, $_POST['pays']);
    }

    // On ajoute l'utilisateur à la base de données s'il n'est pas déjà présent.
    $listeUtilisateurs = $ormUtilisateur->getAllUtilisateurs();
    if (!in_array($_POST['pseudo'], $listeUtilisateurs))
    {
      $ormUtilisateur->insertUtilisateur($_POST['pseudo'], $_POST['mdp']);
    }

    // Ajout de la photo dans la base de données
    $ormPhoto->insertPhoto($_POST['titre'], $urlFull, $urlThumb, $_POST['pseudo'], $_POST['categorie'], $_POST['ville'], $_POST['description'] );


}

/**
 * Verification des données entrées par l'utilisateur +
 * enregistrement des photos (en full et thumb).
 * Retournne un tableau contenant l'url vers les 2 photos
 *
 * @param array $donneesTexte
 * @param array $donneesPhoto
 * @return array
 */
function verifAjoutPhoto($donneesTexte, $donneesPhoto) {
  // Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
  if (isset($donneesPhoto['file']) AND $donneesPhoto['file']['error'] == 0)
  { //if0
    $extensionsAutorisees = array('jpg', 'jpeg', 'png');
    $pseudo = $donneesTexte['pseudo'];
    $description = $donneesTexte['description'];
      if ($donneesPhoto['file']['size'] <= 2097152)
      { //if1
        $file = $donneesPhoto['file']['name'];
        $infosfichier = pathinfo($donneesPhoto['file']['name']);
        $extension = $infosfichier['extension'];
        if (in_array($extension, $extensionsAutorisees))
        { //if2
          //$photoUpload = imagecreatefromjpeg($donneesPhoto['file']['tmp_name']);
          $nomPhoto = uniqid();
          $photoFull = '../../public/img/fulls/' . $nomPhoto . '.' . $extension;
          $photoThumb = '../../public/img/thumbs/' . $nomPhoto . '.' . $extension;
          rognerImage($donneesPhoto['file']['tmp_name'], $extension, $photoThumb, 450, 450);
          move_uploaded_file($donneesPhoto['file']['tmp_name'], $photoFull);
        } //if2
        else { echo 'L\'extension choisie pour l\'image est incorrecte'; }
      } //if1
      else { echo 'L\'image est trop lourde'; }
    } //if0
    else { echo 'Erreur lors de l\'upload image'; }
    return array($photoFull, $photoThumb);
}

 //------------------------------------------------------------------------------------------
 //------------------------------------------------------------------------------------------

/**
 * Redimensionne une photo à la largeur ou hauteur voulue
 * puis la rogne pour formé un carré
 * puis l'enregistre dans le chemin donnée
 * Format accepté : jpg, jpeg, png.
 *
 * @param string $imageDepart [le chemin vers l'image]
 * @param string $extension
 * @param string $chemin [le chemin où l'on veut enregistrer la photo (sans l'extension)]
 * @param int $largeurFinale
 * @param int hauteurFinale
 */
function rognerImage($imageDepart, $extension, $chemin, $largeurFinale, $hauteurFinale)
{
    $decalX = 0;
    $decalY = 0;
    $dimensionOriginale = getimagesize($imageDepart);

    if ($extension ==  'jpg' || $extension ==  'jpeg' || $extension ==  'png')
    {
      // on créée une nouvelle image en fonction de l'extension de l'image de départ
      if ($extension == 'jpg' || $extension == 'jpeg')
        { $imgDepart = imagecreatefromjpeg($imageDepart); }
      elseif ($extension == "png")
        { $imgDepart = imagecreatefrompng($imageDepart); }

      // Calcul de la hauteur et la largeur de l'image intermédiaire
      // Si la largeur => hauteur, on se base sur la hauteur
      if ($dimensionOriginale[0] >= $dimensionOriginale[1])
      {
        $hauteurImageInterm = $hauteurFinale;
        $largeurImageInterm = (int)( ($dimensionOriginale[0] * (($hauteurFinale)/$dimensionOriginale[1])) );
        // Si pas égaux, on calcule le décalage à faire pour centrer l'image lors du rognage.
        if ($largeurImageInterm != $largeurFinale) {
          $decalX = (int)($largeurImageInterm - $largeurFinale)/2;
        }
      } // Sinon (largeur < hauteur) on se base sur la largeur
      else
      {
        $hauteurImageInterm = (int)( ($dimensionOriginale[1] * (($largeurFinale)/$dimensionOriginale[0])) );
        $largeurImageInterm = $largeurFinale;
        // Si pas égaux, on calcule le décalage à faire pour centrer l'image lors du rognage.
        if ($hauteurImageInterm != $hauteurFinale) {
          $decalY = (int)($hauteurImageInterm - $hauteurFinale)/2;
        }
      }
      $imageInterm = imagecreatetruecolor($largeurImageInterm , $hauteurImageInterm) or die ("Erreur lors création image interm");

      // Création de l'image intermediaire proportionnelle à l'image originale.
      imagecopyresampled($imageInterm , $imgDepart   , 0, 0, 0, 0, $largeurImageInterm, $hauteurImageInterm, $dimensionOriginale[0],$dimensionOriginale[1]);

      // Création de l'image avec la bonne largeur ET hauteur.
      $imageFinale = imagecreatetruecolor($largeurFinale , $hauteurFinale) or die ("Erreur création Finale image");
      imagecopy($imageFinale , $imageInterm, 0, 0, $decalX, $decalY, $largeurImageInterm, $hauteurImageInterm);
      // On crée l'image finale en fonction de l'extension de départ
      if ($extension == 'jpg' || $extension == 'jpeg')
       { imagejpeg($imageFinale , $chemin, 100); }
      elseif ($extension == "png")
       { imagepng($imageFinale , $chemin, 9); }
      }
      else { echo 'L\'extension n\'est pas bonne :' . $extension . "<br/>"; }
} //func

$listePhotos = verifAjoutPhoto($_POST, $_FILES);
majBdd($bdd, $listePhotos[0], $listePhotos[1]);

?>
