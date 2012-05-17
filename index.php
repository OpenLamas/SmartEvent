<?php
  /*require_once('Twig/Autoloader.php');
  Twig_Autoloader::register();
    
  $nb_u = (isset($_GET['user']) && !empty($_GET['user']) ? intval($_GET['user']) : '1');
  
  // Config Twig
  $view_folder = 'views'; // Dossier contenant les templates
  $loader = new Twig_Loader_Filesystem($view_folder); 
  $twig = new Twig_Environment($loader, array(
    'cache' => false
  ));*/
  
  // Essai de routeur (toujours tester la valeur d'un GET) 
	// en fonction de la valeur du page on charge le bon template
	// Puis on crée un array qui contient les données pout Twig
	// include('config.php');
	
	
  $dom = new DOMDocument;
	if(!$dom->load('./config/routes.xml')){
		throw new RuntimeException ("Routes introuvable");
	}

	foreach ($dom->getElementsByTagName('route') as $route)
	{
		if(preg_match('#'.$route->getAttribute('url').'$#', $_SERVER['REQUEST_URI'], $matches)){
			$module = $route->getAttribute('module');
			$action = $route->getAttribute('action');
			/*if(!is_dir('./controller/'.$module'/'))
			{
				throw new RuntimeException ("Le module ".$module." n'existe pas");
			}*/
			
			if(!file_exists('./controller/'.$module.'/class_'.$action.'.php')){
				throw new RuntimeException ("La classe ".$action." n'existe pas");
			}
			require('./controller/'.$module.'/class_'.$action.'.php');
			$page = new $action;
			$page->action();
		}
	}
	
	if(!isset($page)){
		require('/controller/error/404.php');
		$error = new Error404;
		$error->action();
		
	}
	
	
	
	
	/*if(isset($_GET['page'])){
			if($_GET['page'] == 'login'){
				require('controller/class_user.php');
				$page = new User();
				$page->login();
			}
			
			else if($_GET['page'] == 'detail'){
				require('controller/class_event.php');
				$page = new Event();
				$page->delail(1);
			}
      
      else if($_GET['page'] == 'users_mgmt'){
        require('controller/class_user.php');
				$page = new User();
				$page->listUsers();
      }
			
			else{
				require('controller/class_event.php');
				$page = new Home();
				$page->listEvents();
			}
  }
  else{
    require('controller/class_event.php');
		$page = new Home();
		$page->listEvents();
  }*/

  // Rendu Twig
  // echo $template->render($variableTwig);
	?>
