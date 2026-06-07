<?php

require_once "Model.php";

class ModelReservation
{

    private $depart;
    private $destination;
    private $date_depart;
    private $heure_depart;
    private $passager_id;
    private $conducteur;
    private $vehicule;
    private $immatriculation;

    function getDepart()
    {
        return $this->depart;
    }

    function getDestination()
    {
        return $this->destination;
    }

    function getDate_depart()
    {
        return $this->date_depart;
    }

    function getImmat()
    {
        return $this->immatriculation;
    }

    function getHeure_depart()
    {
        return $this->heure_depart;
    }
    function getConducteur()
    {
        return $this->conducteur;
    }

    function getVehicule()
    {
        return $this->vehicule;
    }

    public static function getMine($passager_id)
    {
        try {
            $database = Model::getInstance();
            $query = "SELECT DISTINCT ville_depart.nom AS depart, 
                    ville_arrivee.nom AS destination, 
                    t.date_depart, 
                    t.heure_depart, 
                    CONCAT(u.prenom, ' ', u.nom) AS conducteur, 
                    CONCAT(v.marque, ' ', v.modele) AS vehicule, 
                    v.immatriculation
                    FROM reservation r
                    INNER JOIN trajet t ON r.trajet_id = t.id
                    INNER JOIN utilisateur u ON t.conducteur_id = u.id
                    INNER JOIN vehicule v ON t.vehicule_id = v.id
                    INNER JOIN ville ville_depart ON t.ville_depart = ville_depart.id
                    INNER JOIN ville ville_arrivee ON t.ville_arrivee = ville_arrivee.id
                    WHERE r.passager_id = :passager_id
                    ORDER BY t.date_depart ASC, t.heure_depart ASC";
            $statement = $database->prepare($query);
            $statement->execute([
                'passager_id' => $passager_id
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelReservation");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
