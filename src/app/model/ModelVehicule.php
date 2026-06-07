<?php

require_once "Model.php";

class ModelVehicule
{

    private $marque;
    private $modele;
    private $annee;
    private $immatriculation;
    private $proprietaire;
    private $id;

    function getId()
    {
        return $this->id;
    }

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

    public static function getMine($proprietaireId)
    {
        try {
            $database = Model::getInstance();
            $query = "select vehicule.id as id, marque, modele, annee, immatriculation
                      from vehicule, utilisateur
                      where vehicule.proprietaire_id = utilisateur.id
                      and vehicule.proprietaire_id = :proprietaire_id
                      order by annee";
            $statement = $database->prepare($query);
            $statement->execute([
                'proprietaire_id' => $proprietaireId
            ]);
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelVehicule");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($marque, $modele, $annee, $immatriculation, $proprietaire)
    {
        try {
            $database = Model::getInstance();

            //verif immat
            $queryCheck = "SELECT id FROM vehicule WHERE immatriculation = :immatriculation";
            $statementCheck = $database->prepare($queryCheck);
            $statementCheck->execute([
                'immatriculation' => $immatriculation
            ]);

            $tuple = $statementCheck->fetch();
            if ($tuple) {
                return -1;
            }

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from vehicule";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            // ajout d'un nouveau tuple;
            $query = "insert into vehicule (id, marque, modele, annee, immatriculation, proprietaire_id)
            values (:id, :marque, :modele, :annee, :immatriculation, :proprietaire)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'marque' => $marque,
                'modele' => $modele,
                'annee' => $annee,
                'immatriculation' => $immatriculation,
                'proprietaire' => $proprietaire
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }
}
