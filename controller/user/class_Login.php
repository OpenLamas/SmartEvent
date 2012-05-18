<?php
  // require('/dao/class_db_request.php');
	require('basicClass/twigStart.php');
	
	class Login extends Controller{
		
		public function action(){
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				if(isset($_POST['login']) && isset($_POST['password']){
					
				}
			}
			$template = $this->twig->loadTemplate('login.twig');
			echo $template->render(array('cur_user' => ''));
		}
	}
?>