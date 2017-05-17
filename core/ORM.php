<?php
require_once 'Configuration.php';

/**
 * Classe abstraite Modèle.
 * Centralise les services d'accès à une base de données.
 * Utilise l'API PDO de PHP
 *
 * @author Alexandre BOUTHINON
 */
abstract class ORM {

    /**
     * @var $bdd : Objet PDO d'accès à la BD
     * Statique donc partagé par toutes les instances des classes dérivées
     */
    public static $bdd;

    /**
     * Exécute une requête SQL
     *
     * @param string $sql Requête SQL
     * @param array $params Paramètres de la requête
     * @param array $typeArray Tableau des types pour chaque paramètre
     *
     * @return PDOStatement $resultat Résultats de la requête
     */
    protected function executerRequete($sql, $params = false, $typeArray = false) {
        if ($params) {
            $req = static::getBdd()->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY)); // requête préparée
            $this->autoBinding($req, $params, $typeArray);
            $req->execute(); // execution de la requète en ajoutant les paramètres
            $resultat = $req;
        }
        else {
            $resultat = static::getBdd()->query($sql); // exécution directe
        }
        return $resultat;
    }

    /**
     * Permet de binder automatiquement des paramètres à une requête SQL
     *
     * @param string $req Requéte SQL préalablement préparée
     * @param array $params Tableau des valeurs à "binder"
     * @param array $typeArray Tableau des types pour chaque valeur à binder
     *
     */
    private function autoBinding($req, $params, $typeArray = false) {
        if(is_object($req) && ($req instanceof PDOStatement)) {
            foreach($params as $key => $value) {
                if($typeArray) { // Si on a spécifié le type utiliser dans $typeArray
                    $req->bindValue(":$key",$value,$typeArray[$key]);
                }
                else { // Sinon on essaie de le déduire
                    if(is_int($value))
                        $param = PDO::PARAM_INT;
                    elseif(is_bool($value))
                        $param = PDO::PARAM_BOOL;
                    elseif(is_null($value))
                        $param = PDO::PARAM_NULL;
                    elseif(is_string($value))
                        $param = PDO::PARAM_STR;
                    else
                        $param = FALSE;

                    if($param) {
                        $req->bindValue(":$key",$value,$param);
                    }
                    else {
                        throw new Exception("Problème de typage pour le paramétre '$key' sur la requête '$req'");
                    }
                }
            }
        }
    }

    /**
     * Renvoie un objet de connexion à la BDD en initialisant la connexion au besoin
     *
     * @return PDO Objet PDO de connexion à la BDD
     */
    protected static function getBdd() {
        if (static::$bdd === null) {
            // Récupération des paramètres de configuration BD
            $dsn = Configuration::getConf("dsn");
            $login = Configuration::getConf("login");
            $mdp = Configuration::getConf("mdp");
            // Création de la connexion
            static::$bdd = new PDO($dsn, $login, $mdp,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return static::$bdd;
    }
}
