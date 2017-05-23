<?php


// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['file']) AND $_FILES['file']['error'] == 0)
{
    // Testons si le fichier n'est pas trop gros
    if ($_FILES['file']['size'] <= 2000000)
    {
      // Testons si l'extension est autorisée
      $infosfichier = pathinfo($_FILES['file']['name']);
      $extension_upload = $infosfichier['extension'];
      $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
      if (in_array($extension_upload, $extensions_autorisees))
      {
        // On peut valider le fichier et le stocker définitivement
        $chemin = '../../public/img/fulls/01.' . $infosfichier['extension'];
        echo " photo recu : " . $_FILES['file']['tmp_name'] . "<br/>";
        if(move_uploaded_file($_FILES['file']['tmp_name'], $chemin));
        {
          echo "L'envoi a bien été effectué !";
        }
        else { echo "erreur lors de l'enregistrement";}
      }
      else
      {
        $erreur = "Mauvaise extension. Autorisée : jpg, jpeg, gif, png.";
      }
    }
    else
    {
      $erreur = "Le fichier est trop gros";
    }

}
else
{
  echo $_FILES['file']['error'];
  $erreur = "Erreur lors du transfert";
}

if (count($erreur) > 0) {
	//Il y a des erreurs, on les affiche
	echo "<h1>Saisie invalide !</h1>";
	echo $erreur;
} else {
	//Pas d'erreur, on notifie
	echo "<h1>Votre formulaire semble correct</h1>";
  echo $_POST['pseudo'];
}


?>
