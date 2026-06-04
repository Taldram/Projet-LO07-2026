<?php

require_once "Model.php";

class ModelVehicule
{

    private $marque;
    private $modele;
    private $annee;
    private $immatriculation;
    private $proprietaire;

    function getMarque()
    {
        return $this->marque;
    }

    function getModele()
    {
        return $this->modele;
    }

    function getAnnee()
    {
        return $this->annee;
    }

    function getImmat()
    {
        return $this->immatriculation;
    }

    function getProprio()
    {
        return $this->proprietaire;
    }

    public static function getAll()
    {
        try {
            $database = Model::getInstance();
            $query = "select marque, modele, annee, immatriculation, CONCAT(nom, ' ', prenom) AS proprietaire
                      from vehicule, utilisateur 
                      where vehicule.proprietaire_id = utilisateur.id
                      order by proprietaire";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVehicule");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
