<?php
require_once '../../config/connexionBDD.php';
require_once '../models/Ville.php';

/* Modèle pour la table Ville
Structure de la table :
- idVille (int)
- nomVille (string)
*/

/**
 * Permet la gestion de la table Ville
 * de notre base de données
 *
 * @author Mégane Wintz
 */

class ORMVille
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
   * Insert une nouvelle ville à
   * notre base de données
   *
   * @param string $nom
   * @return void
   */
  public function insertVille($nom)
  {
    try {
      $sql = $this->bdd->prepare('INSERT INTO ville(nomville) VALUES(:nomville)');
      $sql->bindValue(':nomville', $nom, PDO::PARAM_STR);
      $sql->execute();
    }
    catch(Exception $e) {
      echo $sql . "<br/>" . $e->getMessage();
    }

  }

  /**
   * Selectionne l'ensemble des ville
   * et les places dans un tableau de Ville
   *
   * @return Ville[]
   */
    public function getAllVilles()
    {
      $listeVilles = [];
      $sql = $this->bdd->query('SELECT idville, nomville FROM ville ORDER BY nomville') or die(print_r($this->bdd->errorInfo()));
      $i = 0;
      while ($donnees = $sql->fetch(PDO::FETCH_ASSOC))
      {
        $listeVilles[$i] = new Ville($donnees['nomville'], $donnees['idville']);
        $i++;
      }
      return $listeVilles;
    }
}
