<?php
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
   * @var string $urlFull [url de l'image taille originale]
   */
  private $urlFull;
  /**
   * @var string $urlThumb [url de l'image redimensionnée]
   */
  private $urlThumb;
  /**
   * @var int $latitude
   */
  private $latitude;
  /**
   * @var int $longitude
   */
  private $longitude;
  /**
   * @var int $idUtilisateur
   */
  private $idUtilisateur;
  /**
   * @var int $idCategorie
   */
  private $idCategorie;
  /**
   * @var int $idVille
   */
  private $idVille;

  /**
   * Constructeur
   * @param string $titre
   * @param string $desc
   * @param string $url
   * @param string $idUtil
   * @param string $idCat
   * @param string $idV
   * @param int $id [NULL par défaut]
   */
  public function __construct($titre, $desc, $url, $idUtil, $idCat, $idV, $id = NULL)
  {
    // Si les ids sont bien positifs et les strings de bonne taille
    if (
      is_int($idUtil) && $idUtil > 0 &&
      is_int($idCat) && $idCat > 0 &&
      is_int($idV) && $idV > 0 &&
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
      $this->idVille = $idV;
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
  * Récupère l'url de la Photo originale
  *
  * @return string
  */
  public function getUrlFull()
  {
    return $this->urlFull;
  }

  /**
  * Récupère l'url de la Photo redimensionnée
  *
  * @return string
  */
  public function getUrlThumb()
  {
    return $this->urlThumb;
  }

  /**
  * Récupère la latitude associée à la Photo
  *
  * @return int
  */
  public function getLatitude()
  {
    return $this->latitude;
  }

  /**
  * Récupère la longitude associée à la Photo
  *
  * @return int
  */
  public function getLongitude()
  {
    return $this->longitude;
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
  public function getidVille()
  {
    return $this->idVille;
  }

  #------------------------------------------------------------
  #                          Setters
  #------------------------------------------------------------

  /**
   * Définie l'id de la photo
   *
   * @param int $id
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
    * @param string $titre
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
    * @param string $desc
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
    * Définie l'url de la photo originale
    *
    * @param string $url
    * @return void
    */
   public function setUrlFull($url)
   {
     // On vérifie qu'il s'agit bien d'un string
     // et que sa longueur est inférieure à 200.
     if (is_string($url) && strlen($url) <= 200)
     {
       $this->urlFull = $url;
     }
   }

   /**
    * Définie l'url de la photo redimensionnée
    *
    * @param string $url
    * @return void
    */
   public function setUrlThumb($url)
   {
     // On vérifie qu'il s'agit bien d'un string
     // et que sa longueur est inférieure à 200.
     if (is_string($url) && strlen($url) <= 200)
     {
       $this->urlThumb = $url;
     }
   }

   /**
    * Définie la latitude associée à la photo
    *
    * @param int $lat
    * @return void
    */
   public function setLatitude($lat)
   {
     // On vérifie qu'il s'agit bien d'un int
     if (is_int($lat))
     {
       $this->latitude = $lat;
     }
   }

   /**
    * Définie la longitude associée à la photo
    *
    * @param int $long
    * @return void
    */
   public function setLongitude($long)
   {
     // On vérifie qu'il s'agit bien d'un int
     if (is_int($long))
     {
       $this->longitude = $long;
     }
   }

   /**
    * Définie l'id utilisateur associé à la photo
    *
    * @param int $id
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
    * @param int $id
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
    * @param int $id
    */
   public function setidVille($id)
   {
     // On vérifie qu'il s'agit bien d'un int
     if (is_int($id) && $id > 0)
     {
       $this->idVille = $id;
     }
   }

   /**
    * affichage du type Photo,
    * retourne son titre.
    *
    */
   public function __toString()
    {
        return $this->titre;
    }

}
