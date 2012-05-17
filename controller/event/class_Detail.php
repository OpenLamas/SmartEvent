<?php
  require('/dao/class_db_request.php');
	require('/basicClass/twigStart.php');
	
	class Detail extends Controller{
		
		public function action($id){
			
			if(isset($_GET['ajax'])){
				$addClass = 'modal fade';
			}
			else{
				$addClass = 'nojavascript';
			}
			
			$donnees = new db_request();
			$template = $this->twig->loadTemplate('detail.twig');
			echo $template->render(array('user' => $donnees->getUser(1), 'rights' => $donnees->getRights(), 'event' => $donnees->getEvent($id), 'get' => $addClass));
		}
	}
?>