<?php
/* Modèle pour la table position
Structure de la table :
- idPosition (int)
- latitude (float)
- longitude (float)
- idVille (int)
*/

/**
 * Représentation objet de à la table Position
 * de notre base de données
 *
 * @author Mégane Wintz
 */

class Position
{
  /**
   * @var int $idPosition
   */
  private $idPosition;
  /**
   * @var float $latitude
   */
  private $latitude;
  /**
   * @var float $longitude
   */
  private $longitude;
  /**
   * @var int $idVille
   */
  private $idVille;

  /**
   * Constructeur
   *
   * @param float $latitude
   * @param float $longitude
   * @param int $idVille
   * @param int $id
   */
  public function __construct($lat, $long, $idV, $id = NULL)
  {
    // Si les ids sont bien positifs et lat, long des floats
    if (
        is_int($idV) && $idV > 0 &&
        is_float($lat)
        is_float($long) )
    {
      $this->idPosition = $id;
      $this->latitude = $lat;
      $this->longitude = $long;
      $this->idVille = $idVille;
    }
  }

  #------------------------------------------------------------
  #                         Getters
  #------------------------------------------------------------

  /**
  * Récupère l'id de la Position
  *
  * @return int
  */
  public function getIdPosition()
  {
    return $this->idPosition;
  }

  /**
  * Récupère la latitude de la Position
  *
  * @return float
  */
  public function getLatitude()
  {
    return $this->latitude;
  }

  /**
  * Récupère la longitude de la Position
  *
  * @return float
  */
  public function getLongitude()
  {
    return $this->longitude;
  }

  /**
   * Définie l'id de la ville correspondant Position
   *
   * @return int
   */
   public function getIdVille()
   {
     // On vérifie qu'il s'agit bien d'un int
     if (is_int($id) && $id > 0 )
     {
      return $this->idVille;
    }

#------------------------------------------------------------
#                         Setters
#------------------------------------------------------------

   /**
    * Définie l'id de la Position
    *
    * @param int
    * @return void
    */
   public function setIdPosition($id)
   {
     // On vérifie qu'il s'agit bien d'un int
     if (is_int($id) && $id > 0)
     {
       $this->idPosition = $id;
     }
   }

   /**
    * Définie la latitude de la Position
    *
    * @param float
    * @return void
    */
   public function setLatitude($lat)
   {
     // On vérifie qu'il s'agit bien d'un float
     if (is_float($lat))
     {
       $this->latitude = $lat;
     }
   }

   /**
    * Définie la longitude de la Position
    *
    * @param float
    * @return void
    */
   public function setLongitude($long)
   {
     // On vérifie qu'il s'agit bien d'un float
     if (is_float($long))
     {
       $this->longitude = $long;
     }
   }

   /**
    * Définie l'id Ville associé à la Position
    *
    * @param int
    * @return void
    */
   public function setIdVille($id)
   {
     // On vérifie qu'il s'agit bien d'un int
     if (is_int($id) && $id > 0)
     {
       $this->idVille = $id;
     }
   }

}
