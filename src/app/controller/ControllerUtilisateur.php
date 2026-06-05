<?php

require_once "../model/ModelUtilisateur.php";

class ControllerUtilisateur {

    public static function utilisateurReadAll()
    {
        $results = ModelUtilisateur::getAll();

        include 'config.php';
        $vue = $root . '/app/view/utilisateur/viewAll.php';
        if (DEBUG)
            echo ("ControllerUtilisateur : utilisateurReadAll : vue = $vue");
        require($vue);
    }

}
    
?>