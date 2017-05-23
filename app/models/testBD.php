<?php require_once '../../config/connexionBDD.php';
      require_once 'Categorie.php';
      require_once '../ORMs/ORMCategorie.php';


// $cate1 = new Categorie('Animaux');
//
// $nomCate1 = $cate1->getNomCategorie();
//
// echo $nomCate1;

// On admet que $db est un objet PDO.


$cate = new Categorie('Animaux',1);
$request = $bdd->query('SELECT idcategorie, nomcategorie FROM categorie');



while ($cate = $request->fetch(PDO::FETCH_ASSOC)) // Chaque entrée sera récupérée et placée dans un array.

{

  echo 'id : ' , $cate['idcategorie'] , ', nom : ' , $cate['nomcategorie'];
}

$ORMCategorie = new ORMCategorie($bdd);
$ORMCategorie->insertCategorie('Voyage');

?>

<?php
require_once "../../config/connexionBDD.php";
require_once "Categorie.php";
// On admet que $db est un objet PDO

$cate = new Categorie("Animaux");

echo $cate->getNomCategorie();
