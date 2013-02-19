<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class Inscription extends Controller{

    public function action(){
      $this->redirectIfNotLogged();
      $dbEvents = new db_events();
      $dbSession = new db_session(); 
      $estInscrit = $dbEvents->getRegisteredFromEvent($_SESSION['idutilisateur'], $this->vars['idEvent']);
      
      if($estInscrit['count']){ //Si on est déjà inscrit
        $dbEvents->removeRegisteredFromEvent($_SESSION['idutilisateur'], $this->vars['idEvent']);
        echo(json_encode(array('ok' => 0))); // On n'est plus inscrit !
      }

      else{
        $placePrise = $dbEvents->getEventWithNbInscrit($this->vars['idEvent']);
        $placePossible = $dbSession->getSessionPlace($this->vars['idSession']);
        if($placePosible - $placePrise < 1){
          echo(json_encode(array('ok' => 'no'))); // Plus de place
          exit();
        }
        $dbEvents->addRegisteredFromEvent($_SESSION['idutilisateur'], $this->vars['idEvent']);
        echo(json_encode(array('ok' => 1))); // On est inscrit !
      }
    }
  }
?>
