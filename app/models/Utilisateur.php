<?php
/* Modèle pour la table utilisateur
Structure de la table :
- idUtilisateur (int)
- pseudo (string)
- mdp (string (encrypted))
*/

/**
 * Représentation objet de la table utilisateur
 * de notre base de données
 *
 * @author Mégane Wintz
 */

class Utilisateur
{

  /**
   * @var int $idUtilisateur
   */
  private $idUtilisateur;
  /**
   * @var string $pseudo
   */
  private $pseudo;
  /**
   * @var string $mdp
   */
  private $mdp;

  /**
   * Constructeur
   * @param string $pseudo
   * @param string $mdp
   * @param int $id
   */
  public function  __construct($pseudo, $mdp, $id = NULL)
  {
    // Si l'id est bien positif et les strings de bonne taille
    if (
        is_string($pseudo) && strlen($pseudo) <= 20 &&
        is_string($mdp) && strlen($mdp) <= 20)
    {
      $this->iUtilisateur = $id;
      $this->pseudo = $pseudo;
      $this->mdp = $mdp;
    }
  }

  #------------------------------------------------------------
  #                         Getters
  #------------------------------------------------------------

  /**
  * Récupère l'id de l'utilisateur
  *
  * @return int
  */
  public function getIdUtilisateur()
  {
    return $this->idUtilisateur;
  }

  /**
  * Récupère le pseudo de l'utilisateur
  *
  * @return string
  */
  public function getPseudo()
  {
    return $this->pseudo;
  }

  /**
  * Récupère le mot de passe de l'utilisateur
  *
  * @return string
  */
  public function getMdp()
  {
    return $this->mdp;
  }

  #------------------------------------------------------------
  #                         Setters
  #------------------------------------------------------------

  /**
   * Définie l'id de l'utilisateur
   *
   * @param int $id
   * @return void
   */
   public function setIdUtilisateur($id)
   {
     // On vérifie qu'il s'agit bien d'un int positif
     if (is_int($id) && $id > 0 )
     {
       $this->idUtilisateur = $id;
     }
   }

   /**
    * Définie le pseudo de l'utilisateur
    *
    * @param string $pseudo
    * @return void
    */
    public function setPseudo($pseudo)
    {
      // On vérifie qu'il s'agit bien d'un string de longueur inf à 20
      if (is_string($pseudo) && strlen($pseudo) <= 20)
      {
        $this->pseudo = $pseudo;
      }
    }

    /**
     * Définie le mot de passe de l'utilisateur
     *
     * @param string $pseudo
     * @return void
     */
     public function setMdp($mdp)
     {
       // On vérifie qu'il s'agit bien d'un string de longueur inf à 20
       if (is_string($mdp) && strlen($mdp) <= 20)
       {
         $this->mdp = $mdp;
       }
     }

}
