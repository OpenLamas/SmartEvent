<?php
  require_once('Twig/Autoloader.php');
  Twig_Autoloader::register();
    
  $nb_u = (isset($_GET['user']) && !empty($_GET['user']) ? intval($_GET['user']) : '1');
  include('config.php');
  
  // Config Twig
  $view_folder = 'views'; // Dossier contenant les templates
  $loader = new Twig_Loader_Filesystem($view_folder); 
  $twig = new Twig_Environment($loader, array(
    'cache' => false
  ));
  
  // Essai de routeur (toujours tester la valeur d'un GET) 
	// en fonction de la valeur du page on charge le bon template
	// Puis on crée un array qui contient les données pout Twig
  if(isset($_GET['page'])){
			if($_GET['page'] == 'login'){
				$template = $twig->loadTemplate('login.twig');
				$variableTwig =  array();
			}
			
			else if($_GET['page'] == 'detail'){
				$template = $twig->loadTemplate('detail.twig');
				if(isset($_GET['ajax'])){
					$addClass = 'modal fade';
				}
				else{
					$addClass = 'nojavascript';
				}
				$variableTwig = array('user' => $user[$nb_u], 'rights' => $rights[$nb_u], 'event' => $events[0], 'get' => $addClass);
			}
      
      else if($_GET['page'] == 'users_mgmt'){
        $template = $twig->loadTemplate('users.twig');
        if(isset($_GET['ajax'])){
					$addClass = 'modal fade';
				}
				else{
					$addClass = 'nojavascript';
				}
        $variableTwig = array('user' => $user[$nb_u], 'rights' => $rights[$nb_u], 'event' => $events[0], 'get' => $addClass);
      }
			
			else{
			$template = $twig->loadTemplate('home.twig');
			$variableTwig = array('user' => $user[$nb_u], 'rights' => $rights[$nb_u], 'events' => $events, 'registered_count' => $registered_count);
			}
  }
  else{
    $template = $twig->loadTemplate('home.twig');
		$variableTwig = array('user' => $user[$nb_u], 'rights' => $rights[$nb_u], 'events' => $events, 'registered_count' => $registered_count);
  }

  // Rendu Twig
  echo $template->render($variableTwig);
?>
