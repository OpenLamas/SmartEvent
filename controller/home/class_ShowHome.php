<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class ShowHome extends Controller{

    public function action(){

      $donnees = new db_request();  
      $template = $this->twig->loadTemplate('home.twig');
      
      if(!isset($_SESSION['login'])){
        echo $template->render(array('cur_user' => array('login' => ''), 'sessions' => $donnees->getSession()));
      }
      else{
       echo $template->render(array('cur_user' => $_SESSION, 'sessions' => $donnees->getSession()));
      }
    }
  }
?>
