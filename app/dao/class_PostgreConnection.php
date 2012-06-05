<?php /* Conection à postgrSQL */ 
  abstract class PostgreConnection{
    protected $bdd;

    public function __construct(){
      // $host = '';
      // $dbname = '';
      $login = 'projetRT1';
      $password = 'projetRT1';

      try{
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $this->bdd = new PDO('pgsql:host=198.245.60.178;dbname=smartevent', $login, $password, $pdo_options);
      }

      catch(Exception $e){
        die('Erreur : '.$e->getMessage());
      }
    }
  } 
?>