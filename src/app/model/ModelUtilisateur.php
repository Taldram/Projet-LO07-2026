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
            $query = "select *
                      from utilisateur
                      order by id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelUtilisateur");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function getConducteurs()
    {
        try {
            $database = Model::getInstance();
            $query = "select *
                      from utilisateur
                      where role = 'conducteur'
                      order by id";
            $statement = $database->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_CLASS, "ModelUtilisateur");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($nom, $prenom, $role, $solde)
    {
        try {
            $database = Model::getInstance();

            // recherche de la valeur de la clé = max(id) + 1
            $query = "select max(id) from utilisateur";
            $statement = $database->query($query);
            $tuple = $statement->fetch();
            $id = $tuple['0'];
            $id++;

            $login = strtolower(trim($prenom . $nom));
            $password = 'secret';

            // ajout d'un nouveau tuple;
            $query = "insert into utilisateur (id, nom, prenom, role, login, password, solde)
                      values (:id, :nom, :prenom, :role, :login, :password, :solde)";
            $statement = $database->prepare($query);
            $statement->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'role' => $role,
                'login' => $login,
                'password' => $password,
                'solde' => $solde
            ]);
            return $id;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return -1;
        }
    }

    public static function login($login, $password)
    {
        try {
            $database = Model::getInstance();
            $query = "select *
                      from utilisateur
                      where login = :login AND password = :password";
            $statement = $database->prepare($query);
            $statement->execute([
                'login' => $login,
                'password' => $password
            ]);
            $result = $statement->fetchObject('ModelUtilisateur');
            return $result ? $result : null;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return null;
        }
    }
}