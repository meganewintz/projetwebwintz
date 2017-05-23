<?php
/* Modèle pour la table Photo
Structure de la table :
- idPhoto (int)
- titre (string)
- description (string)
- url (string)
- idUtilisateur (int)
- idCategorie (int)
- idPosition (int)
*/

/**
 * Représentation objet de la table Photo
 * de notre base de données
 *
 * @author Mégane Wintz
 */

class Photo
{

  /**
  * @var int $idPhoto
  */
  private $idPhoto;
  /**
   * @var string $titre
   */
  private $titre;
  /**
   * @var string $description
   */
  private $description;
  /**
   * @var string $url
   */
  private $url;
  /**
   * @var int $idUtilisateur
   */
  private $idUtilisateur;
  /**
   * @var int $idCategorie
   */
  private $idCategorie;
  /**
   * @var int $idPosition
   */
  private $idPosition;

  /**
   * Constructeur
   * @param string $titre
   * @param string $desc
   * @param string $url
   * @param string $idUtil
   * @param string $idCat
   * @param string $idPos
   * @param int $id [NULL par défaut]
   */
  public function __construct($titre, $desc, $url, $idUtil, $idCat, $idPos, $id = NULL)
  {
    // Si les ids sont bien positifs et les strings de bonne taille
    if (
      is_int($idUtil) && $idUtil > 0 &&
      is_int($idCat) && $idCat > 0 &&
      is_int($idPos) && $idPos > 0 &&
      is_string($titre) && strlen($titre) <= 100 &&
      is_string($description) && strlen($description) <= 500 &&
      is_string($url) && strlen($url) <= 200
      )
    {
      $this->idPhoto = $id;
      $this->titre = $titre;
      $this->description = $desc;
      $this->url = $url;
      $this->idUtilisateur = $idUtil;
      $this->idCategorie = $idCat;
      $this->idPosition = $idPos;
    }
  }

  #------------------------------------------------------------
  #                          Getters
  #------------------------------------------------------------

  /**
  * Récupère l'id de la Photo
  *
  * @return int
  */
  public function getIdPhoto()
  {
    return $this->idPhoto;
  }

  /**
  * Récupère le titre de la Photo
  *
  * @return string
  */
  public function getTitre()
  {
    return $this->titre;
  }

  /**
  * Récupère la description de la Photo
  *
  * @return string
  */
  public function getDescription()
  {
    return $this->description;
  }

  /**
  * Récupère l'url de la Photo
  *
  * @return string
  */
  public function getUrl()
  {
    return $this->url;
  }

  /**
  * Récupère l'id de l'utilisateur associé à la Photo
  *
  * @return int
  */
  public function getIdUtilisateur()
  {
    return $this->idUtilisateur;
  }

  /**
  * Récupère l'id de la catégorie associé à la Photo
  *
  * @return int
  */
  public function getIdCategorie()
  {
    return $this->idCategorie;
  }

  /**
  * Récupère l'id de la Position associé à la Photo
  *
  * @return int
  */
  public function getIdPosition()
  {
    return $this->idPosition;
  }

  #------------------------------------------------------------
  #                          Setters
  #------------------------------------------------------------

  /**
   * Définie l'id de la photo
   *
   * @param int
   * @return void
   */
   public function setIdPhoto($id)
   {
     // On vérifie qu'il s'agit bien d'un int
     if (is_int($id) && $id > 0 )
     {
       $this->idPhoto = $id;
     }
   }

   /**
    * Définie le titre de la photo
    *
    * @param string
    * @return void
    */
   public function setTitre($titre)
   {
     // On vérifie qu'il s'agit bien d'un string
     // et que sa longueur est inférieure à 100.
     if (is_string($titre) && strlen($titre) <= 100)
     {
       $this->titre = $titre;
     }
   }

   /**
    * Définie la description de la photo
    *
    * @param string
    * @return void
    */
   public function setDescription($desc)
   {
     // On vérifie qu'il s'agit bien d'un string
     // et que sa longueur est inférieure à 500.
     if (is_string($desc) && strlen($desc) <= 500)
     {
       $this->description = $desc;
     }
   }

   /**
    * Définie l'url de la photo
    *
    * @param string
    * @return void
    */
   public function setUrl($url)
   {
     // On vérifie qu'il s'agit bien d'un string
     // et que sa longueur est inférieure à 200.
     if (is_string($url) && strlen($url) <= 200)
     {
       $this->url = $url;
     }
   }

   /**
    * Définie l'id utilisateur associé à la photo
    *
    * @param int
    * @return void
    */
   public function setIdUtilisateur($id)
   {
     // On vérifie qu'il s'agit bien d'un int
     if (is_int($id) && $id > 0)
     {
       $this->idUtilisateur = $id;
     }
   }

   /**
    * Définie l'id categorie associé à la photo
    *
    * @param int
    * @return void
    */
   public function setIdCategorie($id)
   {
     // On vérifie qu'il s'agit bien d'un int positif
     if (is_int($id) && $id > 0)
     {
       $this->idCategorie = $id;
     }
   }

   /**
    * Définie l'id position associé à la photo
    *
    * @param int : l'id position que l'on veut lui attribuer
    */
   public function setIdPosition($id)
   {
     // On vérifie qu'il s'agit bien d'un int
     if (is_int($id) && $id > 0)
     {
       $this->idPosition = $id;
     }
   }

}
