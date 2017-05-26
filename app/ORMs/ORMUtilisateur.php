<?php
require_once '../../config/connexionBDD.php';
require_once '../models/Utilisateur.php';

/* Modèle pour la table Utilisateur
Structure de la table :
- idUtilisateur (int)
- pseudo (string)
- mdp (string)
*/

/**
 * Permet la gestion de la table Utilisateur
 * de notre base de données
 *
 * @author Mégane Wintz
 */

class ORMUtilisateur
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
   * Insert un nouveau utilisateur à
   * notre base de données
   *
   * @param string $pseudo
   * @param string $mdp
   * @return void
   */
  public function insertUtilisateur($pseudo, $mdp)
  {
    // On crypte le mot de passe utilisateur
    $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);

    try {
      $sql = $this->bdd->prepare('INSERT INTO utilisateur(pseudo, mdp) VALUES(:pseudo, :mdp)');
      $sql->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
      $sql->bindValue(':mdp', $mdpHash, PDO::PARAM_STR);
      $sql->execute();
    }
    catch(PDOException $e) {
      echo $sql . "<br/>" . $e->getMessage();
    }

  }

  /**
   * Selectionne un utlisateur à partir
   * de son pseudo.
   *
   * @param string $pseudo
   * @return Utilisateur
   */
    public function getUtilisateur($pseudo)
    {
      $sql = $this->bdd->query('SELECT idutilisateur, pseudo, mdp FROM utilisateur ORDER BY pseudo') or die(print_r($this->bdd->errorInfo()));
      $i = 0;
      $donnees = $sql->fetch(PDO::FETCH_ASSOC);
      return new Utilisateur($donnees['pseudo'], $donnees['mdp'], $donnees['idutilisateur']);

    }

    /**
     * Retourne l'id du nom de l'utilisateur entrée en paramètre
     *
     * @param string $nom
     * @return int
     */
    public function getIdUtilisateur($pseudo)
    {
      $sql = $this->bdd->query("SELECT idutilisateur FROM utilisateur WHERE pseudo = '$pseudo'") or die(print_r($this->bdd->errorInfo()));
      $donnees = $sql->fetch(PDO::FETCH_ASSOC);
      return $donnees['idutilisateur'];

    }

  /**
   * Selectionne l'ensemble des utilisateurs
   * et les places dans un tableau de Utilisateur
   *
   * @return Utilisateur[]
   */
    public function getAllUtilisateurs()
    {
      $listeUtilisateurs = [];
      $sql = $this->bdd->query('SELECT idutilisateur, pseudo, mdp FROM utilisateur ORDER BY pseudo') or die(print_r($this->bdd->errorInfo()));
      $i = 0;
      while ($donnees = $sql->fetch(PDO::FETCH_ASSOC))
      {
        $listeUtilisateurs[$i] = new Utilisateur($donnees['pseudo'], $donnees['mdp'], $donnees['idutilisateur']);
        $i++;
      }
      return $listeUtilisateurs;
    }
}
