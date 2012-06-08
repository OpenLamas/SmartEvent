<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
	
  class ManageEvents extends Controller{
  
    public function action(){
      
      if(!isset($_SESSION['login'])){
        $template = $this->twig->loadTemplate('login.twig');
        echo $template->render(array('cur_user' => array('login' => ''), 'state' => 'Vous devez être connecté pour voir cette page'));
        exit;
      }
      
      elseif ($_SESSION["right"]=="GESTIONNAIRE"){
        $donnees = new db_request();
        $template = $this->twig->loadTemplate('events.twig');
        echo $template->render(array('cur_user' => $_SESSION, 'sessions' => $donnees->getSessionAndCreatorFromCreator()));
        exit;
      }      

      elseif ($_SESSION["right"]=="ADMIN") {
        $donnees = new db_request();
        $template = $this->twig->loadTemplate('events.twig');
        echo $template->render(array('cur_user' => $_SESSION, 'sessions' => $donnees->getSessionAndCreator()));
        exit;
      }
      else{        
        header('Location: error-403');
        exit;
      }
    }
  }
?>
