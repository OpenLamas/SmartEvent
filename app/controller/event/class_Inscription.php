<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class Inscription extends Controller{

    public function action(){
      $donnees = new db_request(); 
      $estInscrit = $donnees->getRegisteredFromEvent($_SESSION['idutilisateur'], $this->vars['idEvent']);
      
      if($estInscrit['count']){ //Si on est déjà inscrit
        $donnees->removeRegisteredFromEvent($_SESSION['idutilisateur'], $this->vars['idEvent']);
        echo(json_encode(array('ok' => 0))); // On n'est plus inscrit !
      }

      else{
        $donnees->addRegisteredFromEvent($_SESSION['idutilisateur'], $this->vars['idEvent']);
        echo(json_encode(array('ok' => 1))); // On est inscrit !
      }
    }
  }
?>
