<?php
/* Modèle pour la table categorie
Structure de la table :
- idCategorie (int)
- nomCategorie (string)
*/

/**
 * Représentation objet de la table categorie
 * de notre base de données
 *
 * @author Mégane Wintz
 */

class Categorie
{

  /**
   * @var int $idCategorie
   */
  private $idCategorie;
  /**
   * @var string $nomCategorie
   */
  private $nomCategorie;

  /**
   * Constructeur
   * @param string $nom
   * @param int $id [NULL par défaut]
   */
  public function __construct($nom, $id = NULL)
  {
    // Si le nom est un string de bonne taille
    if (is_string($nom) && strlen($nom) <= 50 ) {
      $this->idCategorie = $id;
      $this->nomCategorie = $nom;
    }
  }

  #------------------------------------------------------------
  #                           Getters
  #------------------------------------------------------------

  /**
  * Récupère l'id de la categorie
  *
  * @return int
  */
  public function getIdCategorie()
  {
    return $this->idCategorie;
  }

  /**
  * Récupère le nom de la categorie
  *
  * @return string
  */
  public function getNomCategorie()
  {
    return $this->nomCategorie;
  }

  #------------------------------------------------------------
  #                          Setters
  #------------------------------------------------------------

  /**
   * Définie l'id de la catégorie
   *
   * @param int $id
   * @return void
   */
   public function setIdCategorie($id)
   {
     // On vérifie qu'il s'agit bien d'un int
     if (is_int($id) && $id > 0 )
     {
       $this->idCategorie = $id;
     }
   }

  /**
   * Définie le nom de la catégorie
   *
   * @param string $nom
   * @return void
   */
   public function setNomCategorie($nom)
   {
     // On vérifie qu'il s'agit bien d'un string
     // et que sa longueur est inférieure à 50.
     if (is_string($nom) && strlen($nom) <= 50)
     {
       $this->nomCategorie = $nom;
     }
   }

   /**
    * affichage du type Catégorie,
    * retourne son nom.
    *
    */
   public function __toString()
    {
        return $this->nomCategorie;
    }

}
