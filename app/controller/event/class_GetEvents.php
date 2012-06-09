<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
	
  class GetEvents extends Controller{
  
    public function action(){
      
      if(!isset($_SESSION['login'])){
        $template = $this->twig->loadTemplate('login.twig');
        echo $template->render(array('cur_user' => array('login' => ''), 'state' => 'Vous devez être connecté pour voir cette page'));
        exit;
      }
      elseif ($_SESSION["right"]=="GESTIONNAIRE" || $_SESSION["right"]=="ADMIN") {
        $dbEvents = new db_events();
        echo json_encode($dbEvents->getEventsFromSessionWithNbInscrit($this->vars['idSession']));
        exit;
      }
      else{        
        header('Location: error-403');
        exit;
      }
    }
  }
?>
