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
	
  if(isset($_GET['page'])){
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
  }

  // Rendu Twig
  // echo $template->render($variableTwig);
	?>
