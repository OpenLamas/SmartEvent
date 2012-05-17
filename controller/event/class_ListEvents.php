<?php
  require('/dao/class_db_request.php');
	require('/basicClass/twigStart.php');
	
	class ListEvents extends Controller{
		
		public function action(){
			$donnees = new db_request();
			
			$template = $this->twig->loadTemplate('home.twig');
			echo $template->render(array('user' => $donnees->getUser(1), 'rights' => $donnees->getRights(1), 'events' => $donnees->getAllEvents(), 'registered_count' => $donnees->getRegisteredCount()));
		}
	}
?>