<?php
  require('dao/class_db_request.php');
	require('basicClass/twigStart.php');
	
	class ListRGroups extends Controller{
		
		public function action(){
			
			$donnees = new db_request();
			
			$template = $this->twig->loadTemplate('rightgrps.twig');
			echo $template->render(array('cur_user' => $donnees->getUser(1), 'rightgroups' => $donnees->getRightGroup()));
		}
	}
?>
