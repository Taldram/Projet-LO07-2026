<?php

require_once "Model.php";

class ModelUtilisateur
{

    private $id;
    private $nom;
    private $prenom;
    private $role;
    private $login;
    private $password;
    private $solde;

    function getId()
    {
        return $this->id;
    }

    function getNom()
    {
        return $this->nom;
    }

    function getPrenom()
    {
        return $this->prenom;
    }

    function getRole()
    {
        return $this->role;
    }

    function getLogin()
    {
        return $this->login;
    }

    function getPassword()
    {
        return $this->password;
    }
    
    function getSolde()
    {
        return $this->solde;
    }

    public static function getAll()
    {
        try {
            $database = Model::getInstance();
            $query = "select id, nom, prenom, role, login, password, solde
                      from utilisateur
                      order by nom";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelUtilisateur");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}