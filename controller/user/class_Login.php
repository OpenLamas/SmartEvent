<?php
  require('/dao/class_db_request.php');
	require('/basicClass/twigStart.php');
	
	class Login extends Controller{
		
		public function action(){
			
			$template = $this->twig->loadTemplate('login.twig');
			echo $template->render(array('user' => ''));
		}
	}
?>