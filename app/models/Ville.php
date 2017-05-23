<?php
/* Modèle pour la table ville
Structure de la table :
- idVille (int)
- nomVille (string)
- idPays (int)
*/

/**
 * Représentation objet de la table ville
 * de notre base de données
 *
 * @author Mégane Wintz
 */

class Ville
{
  /**
   * @var int $idVille
   */
  private $idVille;
  /**
   * @var string $nomVille
   */
  private $nomVille;
  /**
   * @var int $idPays
   */
  private $idPays;

  /**
   * Constructeur
   *
   * @param string $nom
   * @param int $idP
   * @param int $id
   */
  public function __construct($nom, $idP, $id = NULL)
  {
    // Si l'id pays est bien positif et le nom de bonne taille
    if (
        is_int($idP) && $idP > 0 &&
        is_string($nom) && strlen($nom) <= 50 )
    {
      $this->idVille = $id;
      $this->nomVille = $nom;
      $this->idPays = $idP;
    }
  }

  #------------------------------------------------------------
  #                            Getters
  #------------------------------------------------------------

  /**
  * Récupère l'id de la Ville
  *
  * @return int
  */
  public function getIdVille()
  {
    return $this->idVille;
  }

  /**
  * Récupère le nom de la Ville
  *
  * @return string
  */
  public function getNomVille()
  {
    return $this->nomVille;
  }

  /**
  * Récupère l'id du pays lui correspondant
  *
  * @return int
  */
  public function getIdPays()
  {
    return $this->idPays;
  }

  #------------------------------------------------------------
  #                            Setters
  #------------------------------------------------------------

  /**
   * Définie l'id de la ville
   *
   * @param int $id
   * @return void
   */
   public function setIdVille($id)
   {
     // On vérifie qu'il s'agit bien d'un int
     if (is_int($id) && $id > 0 )
     {
       $this->idVille = $id;
     }
   }

   /**
    * Définie le nom de la ville
    *
    * @param string $nom
    * @return void
    */
   public function setNom($nom)
   {
     // On vérifie qu'il s'agit bien d'un string
     // et que sa longueur est inférieure à 50.
     if (is_string($nom) && strlen($nom) <= 50)
     {
       $this->nomVille = $nom;
     }
   }

   /**
    * Définie l'id pays de la ville
    *
    * @param int $id
    * @return void
    */
   public function setIdPays($id)
   {
     // On vérifie qu'il s'agit bien d'un int
     if (is_int($id) && $id > 0)
     {
       $this->idPays = $id;
     }
   }

}

$Montpellier = new Ville("Montpellier", 2);

echo $Montpellier->getNomVille();
