<?php /* Conection à postgrSQL */ 
  abstract class PostgreConnection{
    private $bdd;

    /*
    public function __construct(){
      $host = '';
      $dbname = '';
      $login = '';
      $password = '';

      try{
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $this->$bdd = new PDO('pgsql:host=$host;dbname=$dbname', $login, $password, $pdo_options);
      }

      catch(Exception $e){
        die('Erreur : '.$e->getMessage());
      }
    }
    */
  } 
?>