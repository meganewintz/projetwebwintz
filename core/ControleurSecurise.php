<?php
require_once 'Controleur.php';
require_once 'lib/JWT.php';
require_once 'Configuration.php';
/**
 * Classe abstraite ControleurSecurise
 * Securise les Controleurs fils
 *
 * @author Alexandre BOUTHINON
 */
abstract class ControleurSecurise extends Controleur {
    public function executerAction($action, $donnees = NULL) {
        // Vérifie si la requete comporte un token dans son entête et si il est toujours valide.
        // Si oui, l'utilisateur s'est déjà authentifié : l'exécution de l'action continue normalement
        // Si non, l'utilisateur est renvoyé vers le contrôleur de connexion
        if ($this->requete->existeParametre('token')) {
            $token = JWT::decode($this->requete->getParametre('token'),Configuration::getConf('secret'));
            $now = date("d-m-Y H:i:s");
            if($token->exp >= $now) {
                parent::executerAction($action);
            }
            else {
                $this->rediriger("connexion", "render");
            }
        }
        else {
            $this->rediriger("connexion", "render");
        }
   }
}
