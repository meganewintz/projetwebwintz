function choixAffichage() {
	i = document.choixCategorie.listeCategorie.selectedIndex;
	if (i == 0) return;
	url = document.choixCategorie.listeCategorie.options[i].value;
	parent.location.href = url;
}

function afficherParUtilisateurs()
{
  document.getElementById("content").innerHTML ='<?php afficherPhotos($bdd, \"Utilisateur\"); ?>';
   //"<?php afficherPhotos($bdd, \"Utilisateur\"); ?>"
}
