<?php
  require('dao/class_db_request.php');
	require('basicClass/twigStart.php');
	
	class ShowConfig extends Controller{
		
		public function action(){
			
			$donnees = new db_request();
			
			$template = $this->twig->loadTemplate('config.twig');
			echo $template->render(array('cur_user' => $donnees->getUser(1), 'users' => $donnees->getAllUsers()));
		}
	}
?>
