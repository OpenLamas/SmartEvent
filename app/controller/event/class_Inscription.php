<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class Inscription extends Controller{

    public function action(){
      $dbEvents = new db_events(); 
      $estInscrit = $dbEvents->getRegisteredFromEvent($_SESSION['idutilisateur'], $this->vars['idEvent']);
      
      if($estInscrit['count']){ //Si on est déjà inscrit
        $dbEvents->removeRegisteredFromEvent($_SESSION['idutilisateur'], $this->vars['idEvent']);
        echo(json_encode(array('ok' => 0))); // On n'est plus inscrit !
      }

      else{
        $dbEvents->addRegisteredFromEvent($_SESSION['idutilisateur'], $this->vars['idEvent']);
        echo(json_encode(array('ok' => 1))); // On est inscrit !
      }
    }
  }
?>
