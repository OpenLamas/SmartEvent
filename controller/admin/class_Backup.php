<?php
  require('dao/class_db_request.php');
	require('basicClass/twigStart.php');
	
	class Backup extends Controller{
		
		public function action(){
			
			$donnees = new db_request();
			
			$template = $this->twig->loadTemplate('backup.twig');
			echo $template->render(array('cur_user' => $donnees->getUser(1), 'users' => $donnees->getAllUsers()));
		}
	}
?>
