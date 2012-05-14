<?php
    require_once('twig/Autoloader.php');
    Twig_Autoloader::register();
    
    $nb_u = (isset($_GET['user']) && !empty($_GET['user']) ? intval($_GET['user']) : '1');
    include('config.php');
    
    $loader = new Twig_Loader_Filesystem('views'); // Dossier contenant les templates
    $twig = new Twig_Environment($loader, array(
      'cache' => false
    ));
    
    $template = $twig->loadTemplate('sample.twig');
    echo $template->render(array('user' => $user[$nb_u], 'rights' => $rights[$nb_u], 'events' => $events, 'registered_count' => $registered_count));
    
?>
