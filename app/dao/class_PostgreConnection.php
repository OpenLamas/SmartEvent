<?php /* Conection à postgrSQL */ 
  abstract class PostgreConnection{
    protected $bdd;

    public function __construct(){

      try{
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $this->bdd = new PDO('pgsql:host='.HOSTNAME.';dbname='.DBNAME, DBUSER, DBPASSWORD, $pdo_options);
      }

      catch(Exception $e){
        die('Erreur : '.$e->getMessage());
      }
    }
  } 
?>