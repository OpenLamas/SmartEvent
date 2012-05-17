<?php
  require('dao/class_db_request.php');
	require('basicClass/twigStart.php');
	
	class Home extends Controller{
		
		public function listEvents(){
			$donnees = new db_request();
			
			$template = $this->twig->loadTemplate('home.twig');
			echo $template->render(array('cur_user' => $donnees->getUser(1), 'events' => $donnees->getAllEvents()));
		}
		
		public function detail($id){
			
			if(isset($_GET['ajax'])){
				$addClass = 'modal fade';
			}
			else{
				$addClass = 'nojavascript';
			}
			
			$donnees = new db_request();
			$template = $this->twig->loadTemplate('detail.twig');
			echo $template->render(array('cur_user' => $donnees->getUser(1), 'event' => $donnees->getEvent($id), 'get' => $addClass));
		}
	}
?>
