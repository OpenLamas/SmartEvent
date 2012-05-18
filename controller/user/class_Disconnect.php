<?php
	require('basicClass/twigStart.php');
	
	class Disconnect extends Controller{
		
		public function action(){
			session_destroy();
			$template = $this->twig->loadTemplate('disconnect.twig');
			echo $template->render(array('cur_user' => array('login' => '')));
		}
	}
?>