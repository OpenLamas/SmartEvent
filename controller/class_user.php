<?php
  require('/../dao/class_db_request.php');
	require('/../basicClass/twigStart.php');
	
	class User extends Controller{
		
		public function login(){
			
			$template = $this->twig->loadTemplate('login.twig');
			echo $template->render(array());
		}
		
		public function listUsers(){
			
			$donnees = new db_request();
			$template = $this->twig->loadTemplate('users.twig');
			echo $template->render(array('user' => $donnees->getUser(1), 'users' => $donnees->getAllUsers(), 'rights' => $donnees->getRights(1)));
		}
	}
?>