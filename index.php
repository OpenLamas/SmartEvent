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
  
  // Essai de routeur
  if(isset($_GET['page'])){
    $template = $twig->loadTemplate($_GET['page'].'.twig');
  }
  else{
    $template = $twig->loadTemplate('home.twig');
  }

  // Rendu Twig
  echo $template->render(array('user' => $user[$nb_u], 'rights' => $rights[$nb_u], 'events' => $events, 'registered_count' => $registered_count));
  
  /*$template = $twig->loadTemplate('detail.twig');
  if(isset($_GET['ajax'])){
    $addClass = 'modal fade';
  }
  else{
    $addClass = '';
  }
  echo $template->render(array('user' => $user[$nb_u], 'rights' => $rights[$nb_u], 'event' => $events[0], 'get' => $addClass));*/
?>
