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

    public static function passagerCreate()
    {
        // ----- Construction chemin de la vue
        include 'config.php';
        $role = 'passager';
        $vue = $root . '/app/view/utilisateur/viewInsert.php';
        require($vue);
    }

    public static function conducteurCreate()
    {
        // ----- Construction chemin de la vue
        include 'config.php';
        $role = 'conducteur';
        $vue = $root . '/app/view/utilisateur/viewInsert.php';
        require($vue);
    }

    public static function utilisateurCreated()
    {
        // ajouter une validation des informations du formulaire
        $results = ModelUtilisateur::insert(
            htmlspecialchars($_GET['nom']),
            htmlspecialchars($_GET['prenom']),
            htmlspecialchars($_GET['role']),
            htmlspecialchars($_GET['solde']));
        // ----- Construction chemin de la vue
        include 'config.php';
        if ($results == -1) {
            $vue = $root . '/app/view/utilisateur/viewNotInserted.php'; 
        } else {
            $vue = $root . '/app/view/utilisateur/viewInserted.php'; 
        }
        require ($vue);
    }


}
    
?>