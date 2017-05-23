<?php
/* Modèle pour la table pays
Structure de la table :
- idPays (int)
- nomPays (string)
*/

/**
 * Représentation objet de la table pays
 * de notre base de données
 *
 * @author Mégane Wintz
 */

class Pays
{

  /**
   * @var int $idPays
   */
  private $idPays;
  /**
   * @var string $nomPays
   */
  private $nomPays;

  /**
   * Constructeur
   *
   * @param string $nom
   * @param int $id [NULL par défault]
   */
  public function __construct($nom, $id = NULL)
  {
    // Si l'id est bien positif et le nom de bonne taille
    if (is_string($nom) && strlen($nom) <= 50 ) {
      $this->idPays = $id;
      $this->nomPays = $nom;
    }
  }

  #------------------------------------------------------------
  #                         Getters
  #------------------------------------------------------------

  /**
  * Récupère l'id du Pays
  * @return int
  */
  public function getIdPays()
  {
    return $this->idPays;
  }

  /**
  * Récupère le nom de la Pays
  *
  * @return string
  */
  public function getNomPays()
  {
    return $this->nomPays;
  }

  #------------------------------------------------------------
  #                         Setters
  #------------------------------------------------------------

  /**
   * Définie l'id du pays
   *
   * @param int
   * @return void
   */
   public function setIdPays($id)
   {
     // On vérifie qu'il s'agit bien d'un int
     if (is_int($id) && $id > 0 )
     {
       $this->idPays = $id;
     }
   }

   /**
    * Définie le nom du pays
    *
    * @param string
    * @return void
    */
    public function setNomPays($nom)
    {
      // On vérifie qu'il s'agit bien d'un string
      // et que sa longueur est inférieure à 50.
      if (is_string($nom) && strlen($nom) <= 50)
      {
        $this->nomPays = $nom;
      }
    }
}
