<?php 
  require_once('Twig/Autoloader.php');

  abstract class Controller{
    protected $twig;
    protected $view_folder;
    protected $loader;
    protected $vars;
    
    public function __construct(){
      Twig_Autoloader::register();
      
      // $nb_u = (isset($_GET['user']) && !empty($_GET['user']) ? intval($_GET['user']) : '1');
    
      // Config Twig
      $this->view_folder = 'views'; // Dossier contenant les templates
      $this->loader = new Twig_Loader_Filesystem($this->view_folder); 
      $this->twig = new Twig_Environment($this->loader, array(
        'cache' => false, 'debug' => true, 'strict_variables' => true
      ));
      $this->twig->addExtension(new Twig_Extension_Debug());
      $this->twig->addGlobal('cur_page', "");
      $this->twig->addGlobal('site_root', "/SmartEvent/app");

    }

    public function setVars(array $vars){
      $this->vars = $vars;
    }

  }
?>
