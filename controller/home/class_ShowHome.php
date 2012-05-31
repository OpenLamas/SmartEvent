<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class ShowHome extends Controller{

    public function action(){

      $donnees = new db_request();  
      
      
      if(!isset($_SESSION['login'])){
        $template = $this->twig->loadTemplate('login.twig');
        echo $template->render(array('cur_user' => array('login' => ''), 'state' => 'Vous devez être connecté pour voir cette page'));
        exit;
      }
      else{
        $template = $this->twig->loadTemplate('home.twig');
        echo $template->render(array('cur_user' => $_SESSION, 'sessions' => $donnees->getSession()));
      }
    }
  }
?>
