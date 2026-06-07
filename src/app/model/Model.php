<?php

class Model extends PDO {

 private static $_instance;

 // Constructeur : héritage public obligatoire par héritage de PDO
 public function __construct() {
 }

 // Singleton
 public static function getInstance() {
  
  $cheminConfig = __DIR__ . '/../controller/config.php';
  
  if (file_exists($cheminConfig)) {
      include $cheminConfig;
  } else {
      die("Erreur critique : impossible de trouver le fichier config.php au chemin : $cheminConfig");
  }

  // Petite sécurité pour le debug
  if (defined('DEBUG') && DEBUG) {
      echo ("Model : getInstance : dsn = $dsn</br>");
  }

  $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

  if (!isset(self::$_instance)) {
   try {
    // Si la connexion réussit, PDO est créé avec les bonnes variables
    self::$_instance = new PDO($dsn, $username, $password, $options);
   } catch (PDOException $e) {
    printf("Erreur de connexion PDO : %s - %s<p/>\n", $e->getCode(), $e->getMessage());
    die(); 
   }
  }
  return self::$_instance;
 }

}
?>