<?php
require_once '../../config/connexionBDD.php';
require_once '../models/Photo.php';
require_once 'ORMUtilisateur.php';
require_once 'ORMVille.php';
require_once 'ORMCategorie.php';

/* Modèle pour la table Photo
Structure de la table :
- idPhoto (int)
- titre (string)
- description (string)
- urlFull (string)
- urlThumb (string)
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
   * Insert une nouvelle photo à
   * notre base de données
   *
   * @param string $titre
   * @param string $urlFull
   * @param string $urlThumb
   * @param string $pseudo
   * @param string $nomCategorie
   * @param string $nomVille
   * @param string $description
   * @return void
   */
  public function insertPhoto($titre, $urlFull, $urlThumb, $pseudo, $nomCategorie, $nomVille, $description = NULL)
  {
    // On récupère les ids
    $ormUtilisateur = new ORMUtilisateur($this->bdd);
    $idUtilisateur = $ormUtilisateur->getIdUtilisateur($pseudo);

    $ormCategorie = new ORMCategorie($this->bdd);
    $idCategorie = $ormCategorie->getIdCategorie($nomCategorie);

    $ormVille = new ORMVille($this->bdd);
    $idVille = $ormVille->getIdVille($nomVille);

    try {
      $sql = $this->bdd->prepare('INSERT INTO photo(titre, description, urlfull, urlthumb, idutilisateur, idcategorie, idville)
      VALUES(:titre, :description, :urlfull, :urlthumb, :idutilisateur, :idcategorie, :idville)');
      $sql->bindValue(':titre', $titre, PDO::PARAM_STR);
      $sql->bindValue(':description', $description, PDO::PARAM_STR);
      $sql->bindValue(':urlfull', $urlFull, PDO::PARAM_STR);
      $sql->bindValue(':urlthumb', $urlThumb, PDO::PARAM_STR);
      $sql->bindValue(':idutilisateur', $idUtilisateur, PDO::PARAM_INT);
      $sql->bindValue(':idcategorie', $idCategorie, PDO::PARAM_INT);
      $sql->bindValue(':idville', $idVille, PDO::PARAM_INT);
      $sql->execute();
    }
    catch(PDOException $e) {
      die( $sql . "<br/>" . $e->getMessage());
    }

  }

  /**
   * Retourne l'utilisateur associé à la photo
   * (son pseudo).
   *
   * @param int $idPhoto
   * @return string [le pseudo associé à la photo]
   */
  public function getUtilisateur($idPhoto)
  {
    $requete = 'SELECT pseudo FROM utilisateur u, photo p WHERE u.idutilisateur = p.idutilisateur and p.idphoto = ' . $idPhoto;
    $sql = $this->bdd->query($requete) or die(print_r($this->bdd->errorInfo()));
    $donnees = $sql->fetch(PDO::FETCH_ASSOC);
    return $donnees['pseudo'];
  }

  /**
   * Retourne la catégorie associé à la photo
   * (son nom).
   *
   * @param int $idPhoto
   * @return string [la catégorie associé à la photo]
   */
  public function getCategorie($idPhoto)
  {
    $requete = 'SELECT nomcategorie FROM categorie c, photo p WHERE c.idcategorie = p.idcategorie AND p.idphoto = ' . $idPhoto;
    $sql = $this->bdd->query($requete) or die(print_r($this->bdd->errorInfo()));
    $donnees = $sql->fetch(PDO::FETCH_ASSOC);
    return $donnees['nomcategorie'];
  }

  /**
   * Retourne la ville associé à la photo
   * (son nom).
   *
   * @param int $idPhoto
   * @return string [la ville associé à la photo]
   */
  public function getVille($idPhoto)
  {
    $requete = 'SELECT nomville FROM ville v, photo p WHERE v.idville = p.idville AND p.idphoto = ' . $idPhoto;
    $sql = $this->bdd->query($requete) or die(print_r($this->bdd->errorInfo()));
    $donnees = $sql->fetch(PDO::FETCH_ASSOC);
    return $donnees['nomville'];
  }

  /**
   * Retourne le pays associé à la photo
   * (son nom).
   *
   * @param int $idPhoto
   * @return string [le pays associé à la photo]
   */
  public function getPays($idPhoto)
  {
    $requete = 'SELECT nompays FROM pays pa, ville v, photo p WHERE pa.idpays = v.idpays AND v.idville = p.idville AND p.idphoto =' . $idPhoto;
    $sql = $this->bdd->query($requete) or die(print_r($this->bdd->errorInfo()));
    $donnees = $sql->fetch(PDO::FETCH_ASSOC);
    return $donnees['nompays'];
  }

  /**
   * Selectionne l'ensemble des photos suivant
   * la catégorie choisie.
   * et les places dans un tableau de Photo
   *
   * @param string $categorie
   * @return Photo[] ou string si pas de résultat
   */
  public function getAllPhotosCategorie($categorie)
  {
    $requete = 'SELECT idphoto, titre, description, urlfull, urlthumb, idutilisateur, p.idcategorie, idville FROM categorie c, photo p WHERE c.idcategorie = p.idcategorie AND c.nomcategorie =\'' . $categorie . '\'';
    $listePhotos = [];
    $sql = $this->bdd->query($requete) or die(print_r($this->bdd->errorInfo()));
    if($sql->rowCount() > 0)
    {
      $i = 0;
      while ($donnees = $sql->fetch(PDO::FETCH_ASSOC))
      {
        $listePhotos[$i] = new Photo($donnees['titre'], $donnees['urlfull'], $donnees['urlthumb'], $donnees['idutilisateur'], $donnees['idcategorie'], $donnees['idville'], $donnees['idphoto'], $donnees['description']);
        $i++;
      }
    }
    return $listePhotos;
  }

  /**
   * Selectionne l'ensemble des photos suivant
   * l'utilisateur choisi.
   * et les places dans un tableau de Photo
   *
   * @param string $utilisateur
   * @return Photo[]
   */
  public function getAllPhotosUtilisateur($utilisateur)
  {
    $requete = 'SELECT idphoto, titre, description, urlfull, urlthumb, p.idutilisateur, idcategorie, idville FROM utilisateur u, photo p WHERE u.idutilisateur = p.idutilisateur AND u.pseudo = \'' . $utilisateur . '\'';
    $listePhotos = [];
    $sql = $this->bdd->query($requete) or die(print_r($this->bdd->errorInfo()));
    $i = 0;
    while ($donnees = $sql->fetch(PDO::FETCH_ASSOC))
    {
      $listePhotos[$i] = new Photo($donnees['titre'], $donnees['urlfull'], $donnees['urlthumb'], $donnees['idutilisateur'], $donnees['idcategorie'], $donnees['idville'], $donnees['idphoto'], $donnees['description']);
      $i++;
    }
    return $listePhotos;
  }

  /**
   * Selectionne l'ensemble des photos suivant
   * la ville choisie.
   * et les places dans un tableau de Photo
   *
   * @param string $ville
   * @return Photo[]
   */
  public function getAllPhotosVille($ville)
  {
    $requete = 'SELECT idphoto, titre, description, urlfull, urlthumb, idutilisateur, idcategorie, v.idville FROM ville v, photo p WHERE v.idville = p.idville AND v.nomville = \'' . $ville . '\'';
    $listePhotos = [];
    $sql = $this->bdd->query($requete) or die(print_r($this->bdd->errorInfo()));
    $i = 0;
    while ($donnees = $sql->fetch(PDO::FETCH_ASSOC))
    {
      $listePhotos[$i] = new Photo($donnees['titre'], $donnees['urlfull'], $donnees['urlthumb'], $donnees['idutilisateur'], $donnees['idcategorie'], $donnees['idville'], $donnees['idphoto'], $donnees['description']);
      $i++;
    }
    return $listePhotos;
  }

  /**
   * Selectionne l'ensemble des photos suivant
   * le pays choisie.
   * et les places dans un tableau de Photo
   *
   * @param string $pays
   * @return Photo[]
   */
  public function getAllPhotosPays($pays)
  {
    $requete = 'SELECT idphoto, titre, description, urlfull, urlthumb, idutilisateur, idcategorie, p.idville FROM pays pa, photo p, ville v WHERE pa.idpays = v.idpays AND v.idville = p.idville AND pa.nompays = \'' . $pays . '\'';
    $listePhotos = [];
    $sql = $this->bdd->query($requete) or die(print_r($this->bdd->errorInfo()));
    $i = 0;
    while ($donnees = $sql->fetch(PDO::FETCH_ASSOC))
    {
      $listePhotos[$i] = new Photo($donnees['titre'], $donnees['urlfull'], $donnees['urlthumb'], $donnees['idutilisateur'], $donnees['idcategorie'], $donnees['idville'], $donnees['idphoto'], $donnees['description']);
      $i++;
    }
    return $listePhotos;
  }

  /**
   * Selectionne l'ensemble des photos
   * et les places dans un tableau de Photo
   *
   * @return Photo[]
   */
  public function getAllPhotos()
  {
    $listePhotos = [];
    $sql = $this->bdd->query('SELECT * FROM photo ORDER BY titre') or die(print_r($this->bdd->errorInfo()));
    $i = 0;
    while ($donnees = $sql->fetch(PDO::FETCH_ASSOC))
    {
      $listePhotos[$i] = new Photo($donnees['titre'], $donnees['urlfull'], $donnees['urlthumb'], $donnees['idutilisateur'], $donnees['idcategorie'], $donnees['idville'], $donnees['idphoto'], $donnees['description']);
      $i++;
    }
    return $listePhotos;
  }
}

$ormPhoto = new ORMPhoto($bdd);
//echo $ormPhoto->getVille(18);
// echo $ormPhoto->getUtilisateur(18);
// echo "<br/>";
// echo $ormPhoto->getCategorie(18);
// echo "<br/>";
// echo $ormPhoto->getVille(18);
// echo "<br/>";
//echo $ormPhoto->getPays(18);
// $listePhotos = $ormPhoto->getAllPhotosCategorie("Paysage");
// if (empty($listePhotos)) echo "vide";
// // foreach ($listePhotos as $photo => $value) {
// //     echo $listePhotos[$photo] . "<br/>";
// // }
// $ormPhoto->insertPhoto('megane', 'meg', 'meg', 'Johanna', 'Animaux', 'Paris', "");
