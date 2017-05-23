<?php
require_once '../../config/connexionBDD.php';
require_once 'ORM.php';
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

class ORMCategorie extends ORM
{
  /**
   * @var PDO $bdd
   */
  public static $bdd; //instance de PDO

  /**
   * Constructeur
   *
   * @param PDO $bdd
   */
  public function __construct(PDO $bdd)
  {
    $this->$bdd = $bdd;
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
    // $sql = 'INSERT INTO categorie (nomcategorie) VALUES (:nomcategorie)';
    // $params = [
    //   'nomcategorie' => $nom
    // ];
    // $typeArray = [
    //   'nomcategorie' => PDO::PARAM_STR,
    // ];
    // try {
    //     $this->executerRequete($sql, $params, $typeArray);
    //     return true;
    // }
    // catch (Exception $e) {
    //     return false;
    // }
  }
}
// $sql = "INSERT INTO categorie(idcategorie, nomcategorie) VALUES ("", 'Animaux')";
// $bdd->exec($sql);

try {
    $sql = "INSERT INTO categorie (idcategorie, nomcategorie)
    VALUES (DEFAULT, 'Animaux')";
    // use exec() because no results are returned
    $bdd->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
