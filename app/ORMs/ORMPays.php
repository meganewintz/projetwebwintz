<?php
require_once '../../config/connexionBDD.php';
require_once '../models/Pays.php';

/* Modèle pour la table Pays
Structure de la table :
- idPays (int)
- nomPays (string)
*/

/**
 * Permet la gestion de la table Pays
 * de notre base de données
 *
 * @author Mégane Wintz
 */

class ORMPays
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
   * Insert un nouveau pays à
   * notre base de données
   *
   * @param string $nom
   * @return void
   */
  public function insertPays($nom)
  {
    try {
      $sql = $this->bdd->prepare('INSERT INTO pays(nompays) VALUES(:nompays)');
      $sql->bindValue(':nompays', $nom, PDO::PARAM_STR);
      $sql->execute();
    }
    catch(PDOException $e) {
      echo $sql . "<br/>" . $e->getMessage();
    }

  }

  /**
   * Retourne l'id du nom du pays entrée en paramètre
   *
   * @param string $nom
   * @return int
   */
  public function getIdPays($nom)
  {
    $sql = $this->bdd->query("SELECT idpays FROM pays WHERE nompays = '$nom'") or die(print_r($this->bdd->errorInfo()));
    $donnees = $sql->fetch(PDO::FETCH_ASSOC);
    return $donnees['idpays'];

  }

  /**
   * Selectionne l'ensemble des pays
   * et les places dans un tableau de Pays
   *
   * @return Pays[]
   */
    public function getAllPays()
    {
      $listePays = [];
      $sql = $this->bdd->query('SELECT idpays, nompays FROM pays ORDER BY nompays') or die(print_r($this->bdd->errorInfo()));
      $i = 0;
      while ($donnees = $sql->fetch(PDO::FETCH_ASSOC))
      {
        $listePays[$i] = new Pays($donnees['nompays'], $donnees['idpays']);
        $i++;
      }
      return $listePays;
    }
}

// $ormPays = new ORMPays($bdd);
// $listePays = $ormPays->getAllPays();
// foreach ($listePays as $pays => $value) {
//     echo $listePays[$pays] . "<br/>";
// }
//
// echo $ormPays->getIdPays("France");
