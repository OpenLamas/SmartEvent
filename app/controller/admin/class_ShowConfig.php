<?php
  require('dao/class_db_request.php');
	require('basicClass/twigStart.php');
	
	class ShowConfig extends Controller{
		
		public function action(){

			if(!isset($_SESSION['login'])){
        $template = $this->twig->loadTemplate('login.twig');
        echo $template->render(array('cur_user' => array('login' => ''), 'state' => 'Vous devez être connecté pour voir cette page'));
        exit;
      }
      elseif ($_SESSION["right"]=="ADMIN") {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          
        }
        
        $template = $this->twig->loadTemplate('config.twig');
        echo $template->render(array('cur_user' => $_SESSION, 'hostname' => HOSTNAME, 'port' => PORT, 'dbname' => DBNAME, 'user' => DBUSER, 'password' => DBPASSWORD, 'domains' => implode(';', unserialize(DOMAINS))));
        exit;
      }
      else{        
        throw new ForbiddenError ("Nope");
        exit;
      }     
		}
	}
?>
