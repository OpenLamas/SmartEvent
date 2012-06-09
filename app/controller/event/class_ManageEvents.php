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
        $dbSessions = new db_sessions();
        $template = $this->twig->loadTemplate('events.twig');
        echo $template->render(array('cur_user' => $_SESSION, 'sessions' => $dbSessions->getSessionAndCreatorFromCreator($_SESSION['idUtilisateur'])));
        exit;
      }      

      elseif ($_SESSION["right"]=="ADMIN") {
        $dbSessions = new db_sessions();
        $template = $this->twig->loadTemplate('events.twig');
        echo $template->render(array('cur_user' => $_SESSION, 'sessions' => $dbSessions->getAllSessionAndCreator()));
        exit;
      }
      else{        
        header('Location: error-403');
        exit;
      }
    }
  }
?>
