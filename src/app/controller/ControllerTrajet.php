<?php

require_once "../model/ModelTrajet.php";
require_once "../model/ModelReservation.php";
require_once "../model/ModelVille.php";
require_once "../model/ModelVehicule.php";
require_once "../model/ModelUtilisateur.php";

class ControllerTrajet {

    public static function trajetReadMine()
    {
        $results = ModelTrajet::getMine();

        include 'config.php';
        $vue = $root . '/app/view/trajet/viewMine.php';
        if (DEBUG)
            echo ("ControllerTrajet : trajetReadMine : vue = $vue");
        require($vue);
    }

    public static function trajetCreate()
    {
        include 'config.php';
        $ville = ModelVille::getAll();
        $loginId = $_SESSION['login_id'] ?? null;
        $vehicule = ModelVehicule::getMine($loginId);

        // ----- Construction chemin de la vue
        $vue = $root . '/app/view/trajet/viewInsert.php';
        require($vue);
    }

    public static function trajetCreated()
    {
        include 'config.php';
        
        $results = ModelTrajet::insert(
            htmlspecialchars($_POST['ville_depart']),
            htmlspecialchars($_POST['ville_arrivee']),
            htmlspecialchars($_POST['conducteur_id']),
            htmlspecialchars($_POST['vehicule_id']),
            htmlspecialchars($_POST['prix']),
            htmlspecialchars($_POST['date_depart']),
            htmlspecialchars($_POST['heure_depart']),
            htmlspecialchars($_POST['statut']));
        
        // ----- Construction chemin de la vue
        $trajetId = $results;
        if ($results == -1) {
            $vue = $root . '/app/view/trajet/viewNotInserted.php'; 
        } else {
            $vue = $root . '/app/view/trajet/viewInserted.php'; 
        }
        require ($vue);
    }

    public static function trajetReadPassagers()
    {
        $loginId = $_SESSION['login_id'] ?? null;
        $loginRole = $_SESSION['login_role'] ?? null;

        if ($loginId === null || $loginRole !== 'conducteur') {
            include 'config.php';
            $vue = $root . '/app/view/utilisateur/viewLogin.php';
            require($vue);
            return;
        }

        $trajets = ModelTrajet::getMineActifs($loginId);
        $trajetId = isset($_POST['trajet_id']) ? intval($_POST['trajet_id']) : null;
        $results = [];

        if ($trajetId !== null && $trajetId > 0) {
            $results = ModelReservation::getPassagersByTrajet($loginId, $trajetId);
        }

        include 'config.php';
        $vue = $root . '/app/view/trajet/viewPassagers.php';
        if (DEBUG)
            echo ("ControllerTrajet : trajetReadPassagers : vue = $vue");
        require($vue);
    }

    public static function trajetCloturer()
    {
        include 'config.php';
        
        $loginId = $_SESSION['login_id'] ?? null;
        $loginRole = $_SESSION['login_role'] ?? null;

        if ($loginId === null || $loginRole !== 'conducteur') {
            $vue = $root . '/app/view/utilisateur/viewLogin.php';
            require($vue);
            return;
        }

        $trajets = ModelTrajet::getMineActifs($loginId);

        $vue = $root . '/app/view/trajet/viewCloturer.php';
        if (DEBUG)
            echo ("ControllerTrajet : trajetCloturer : vue = $vue");
        require($vue);
    }

    public static function trajetCloturered()
    {
        include 'config.php';
        
        $loginId = $_SESSION['login_id'] ?? null;
        $loginRole = $_SESSION['login_role'] ?? null;

        if ($loginId === null || $loginRole !== 'conducteur') {
            $errorMessage = 'Vous devez être connecté en tant que conducteur pour clôturer un trajet.';
            $vue = $root . '/app/view/trajet/viewNotCloturered.php';
            require($vue);
            return;
        }

        $trajetId = isset($_POST['trajet_id']) ? intval($_POST['trajet_id']) : null;

        if ($trajetId === null || $trajetId <= 0) {
            $errorMessage = 'ID du trajet invalide.';
            $vue = $root . '/app/view/trajet/viewNotCloturered.php';
            require($vue);
            return;
        }

        $result = ModelTrajet::cloturerAvecPaiements($trajetId, $loginId);

        if ($result['success']) {
            $_SESSION['login_solde'] = $result['nouveauSolde'];
            
            $trajetId = $trajetId;
            $nombreReservations = $result['nombreReservations'];
            $montantTotal = $result['montantTotal'];
            $nouveauSolde = $result['nouveauSolde'];
            $vue = $root . '/app/view/trajet/viewCloturered.php';
        } else {
            $errorMessage = $result['error'];
            $vue = $root . '/app/view/trajet/viewNotCloturered.php';
        }

        require($vue);
    }
}
?>