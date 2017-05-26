<?php
require_once '../../config/connexionBDD.php';
require_once '../models/Ville.php';
require_once 'ORMPays.php';



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
   * @param string $nomVille
   * @param string $nomPays [son pays associé]
   * @return void
   */
  public function insertVille($nomVille, $nomPays)
  {
    $ormPays = new ORMPays($this->bdd);
    $idPays = $ormPays->getIdPays($nomPays);
    try {
      $sql = $this->bdd->prepare('INSERT INTO ville(nomville, idpays) VALUES(:nomville, :idpays)');
      $sql->bindValue(':nomville', $nomVille, PDO::PARAM_STR);
      $sql->bindValue(':idpays', $idPays, PDO::PARAM_INT);
      $sql->execute();
    }
    catch(PDOException $e) {
      echo $sql . "<br/>" . $e->getMessage();
    }
  }

  /**
   * Retourne l'id du nom de la ville entrée en paramètre
   *
   * @param string $nom
   * @return int
   */
  public function getIdVille($nom)
  {
    $sql = $this->bdd->query("SELECT idville FROM ville WHERE nomville = '$nom'") or die(print_r($this->bdd->errorInfo()));
    $donnees = $sql->fetch(PDO::FETCH_ASSOC);
    return $donnees['idville'];
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

$ormVille = new ORMVille($bdd);
//$ormVille->insertVille("Cannes", "France");

// $ormVille->getIdVille("Cannes");
