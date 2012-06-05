<?php /* Conection à postgrSQL */ 
  abstract class PostgreConnection{
    protected $bdd;

    public function __construct(){
      // $host = '';
      // $dbname = '';
      $login = 'dev';
      $password = 'ku67j8';

      try{
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $this->bdd = new PDO('pgsql:host=178.32.211.21;dbname=smartevent', $login, $password, $pdo_options);
      }

      catch(Exception $e){
        die('Erreur : '.$e->getMessage());
      }
    }
  } 
?>