<?php
require_once 'Requete.php';
require_once 'Vue.php';
require_once 'Configuration.php';

/**
 * Classe abstraite Controleur
 * Fournit des services communs aux classes Controleur dérivées
 *
 * @author Alexandre BOUTHINON
 */
abstract class Controleur {

    /**
     * @var $action : Action à réaliser
     */
    private $action;

    /**
     * @var Requete $requete : Requête entrante
     */
    protected $requete;

    /**
     * Définit la requête entrante
     *
     * @param Requete $requete Requete entrante
     */
    public function setRequete(Requete $requete)
    {
        $this->requete = $requete;
    }


    /**
     * Récupére la requête entrante
     *
     * @return Requete $requete
     */
    public function getRequete()
    {
        return $this->requete;
    }

    /**
     * Exécute l'action à réaliser.
     * Appelle la méthode portant le même nom que l'action sur l'objet Controleur courant
     *
     * @throws Exception Si l'action n'existe pas dans la classe Controleur courante
     * @param string $action Nom de l'action à réaliser
     */
    public function executerAction($action)
    {
        if (method_exists($this, $action)) {
            $this->action = $action;
            $this->{$this->action}();

        }
        else {
            $classeControleur = get_class($this);
            throw new Exception("Action '$action' non définie dans la classe $classeControleur");
        }
    }

    /**
     * Méthode abstraite correspondant à l'action par défaut
     * Oblige les classes dérivées à implémenter cette action par défaut
     */
    public abstract function render();

    /**
     * Génère la vue associée au contrôleur courant
     *
     * @param array $donneesVue Données nécessaires pour la génération de la vue
     */
    protected function genererVue($donneesVue = array())
    {
        // Détermination du nom du fichier vue à partir du nom du contrôleur actuel
        $classeControleur = get_class($this);
        $controleur = str_replace("Controleur", "", $classeControleur);
        // On vérifie si un utilisateur est identifié
        $this->requete->existeParametre('token') ? $donneesVue['token'] = true : NULL;

        // Instanciation et génération de la vue
        $vue = new Vue($this->action, $controleur);
        $vue->generer($donneesVue);
    }

    /**
     * Effectue une redirection vers un contrôleur et une action spécifiques
     *
     * @param string $controleur Contrôleur
     * @param string $action  Action
     */
    protected function rediriger($controleur, $action = null)
    {
        $racineWeb = Configuration::getConf("racineWeb", "/");
        // Redirection vers l'URL /racine_site/controleur/action
        header("Location:" . $racineWeb . 'index.php?' . 'controleur=' . $controleur . "&" . 'action=' . $action);
    }
}
