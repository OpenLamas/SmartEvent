<?php
  require('dao/class_db_request.php');
	require('basicClass/twigStart.php');
	
	class ListEvents extends Controller{
		public function listEvents(){
			$donnees = new db_request();
			
			$template = $this->twig->loadTemplate('home.twig');
			echo $template->render(array('cur_user' => $donnees->getUser(1), 'events' => $donnees->getAllEvents()));
		}
	}
?>