<?php
require_once '../../config/connexionBDD.php';
require_once '../models/Photo.php';

/* Modèle pour la table Photo
Structure de la table :
- idPhoto (int)
- titre (string)
- description (string)
- urlFull (string)
- urlThumb (string)
- latitude (int)
- longitude (int)
- idUtilisateur (int)
- idCategorie (int)
- idVille (int)
*/

/**
 * Permet la gestion de la table Photo
 * de notre base de données
 *
 * @author Mégane Wintz
 */

class ORMPhoto
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
   * Insert un nouveau photo à
   * notre base de données
   *
   * @param string $nom
   * @return void
   */
  public function insertPhoto($nom)
  {
    try {
      $sql = $this->bdd->prepare('INSERT INTO photo(nomphoto) VALUES(:nomphoto)');
      //$sql->bindValue(':idphoto', 'DEFAULT');
      $sql->bindValue(':nomphoto', $nom, PDO::PARAM_STR);
      $sql->execute();
    }
    catch(PDOException $e) {
      echo $sql . "<br/>" . $e->getMessage();
    }

  }

  /**
   * Selectionne l'ensemble des photo
   * et les places dans un tableau de Photo
   *
   * @return Photo[]
   */
    public function getAllPhotos()
    {
      $listePhotos = [];
      $sql = $this->bdd->query('SELECT idphoto, nomphoto FROM photo ORDER BY nomphoto') or die(print_r($this->bdd->errorInfo()));
      $i = 0;
      while ($donnees = $sql->fetch(PDO::FETCH_ASSOC))
      {
        $listePhotos[$i] = new Photo($donnees['nomphoto'], $donnees['idphoto']);
        $i++;
      }
      return $listePhotos;
    }
}

$ormPhoto = new ORMPhoto($bdd);
$listePhotos = $ormPhoto->getAllPhoto();
foreach ($listePhotos as $photo => $value) {
    echo $listePhotos[$photo] . "<br/>";
}
