<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
	
  class ManageEvents extends Controller{
  
    public function action(){
      
      $donnees = new db_request();
      $template = $this->twig->loadTemplate('events.twig');

      echo $template->render(array('cur_user' => $donnees->getUser(1), 'events' => $donnees->getEvent(), 'sessions' => $donnees->getSession()));
    }
  }
?>
