<?php
require_once '../../config/connexionBDD.php';
require_once '../models/Categorie.php';

/* Modèle pour la table categorie
Structure de la table :
- idCategorie (int)
- nomCategorie (string)
*/

/**
 * Permet la gestion de la table categorie
 * de notre base de données
 *
 * @author Mégane Wintz
 */

class ORMCategorie
{
  /**
   * @var PDO $bdd
   */
  private $bdd; //instance de PDO

  /**
   * Constructeur
   *
   * @param PDO $db
   */
  public function __construct($db)
  {
    $this->bdd = $db;
  }


  /**
   * Insert une nouvelle catégorie à
   * notre base de données
   *
   * @param string $nom
   * @return void
   */
  public function insertCategorie($nom)
  {
    try {
      $sql = $this->bdd->prepare('INSERT INTO categorie(nomcategorie) VALUES(:nomcategorie)');
      $sql->bindValue(':nomcategorie', $nom, PDO::PARAM_STR);
      $sql->execute();
    }
    catch(PDOException $e) {
      echo $sql . "<br/>" . $e->getMessage();
    }
  }

  /**
   * Retourne l'id du nom de la categorie entrée en paramètre
   *
   * @param string $nom
   * @return int
   */
  public function getIdCategorie($nom)
  {
    $sql = $this->bdd->query("SELECT idCategorie FROM categorie WHERE nomcategorie = '$nom'") or die(print_r($this->bdd->errorInfo()));
    $donnees = $sql->fetch(PDO::FETCH_ASSOC);
    return $donnees['idcategorie'];
  }

  /**
   * Selectionne l'ensemble des catégories
   * et les places dans un tableau de Catégorie
   *
   * @return Categorie[]
   */
    public function getAllCategories()
    {
      $categories = [];
      $sql = $this->bdd->query('SELECT idcategorie, nomcategorie FROM categorie ORDER BY nomcategorie') or die(print_r($this->bdd->errorInfo()));
      $i = 0;
      while ($donnees = $sql->fetch(PDO::FETCH_ASSOC))
      {
        $categories[$i] = new Categorie($donnees['nomcategorie'], $donnees['idcategorie']);
        $i++;
      }
      return $categories;
    }

}

// $ormCategorie = new ORMCategorie($bdd);
// $listeCategories = $ormCategorie->getAllCategories();
// foreach ($listeCategories as $categorie) {
//     echo $categorie . "<br/>";
// }
