<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class PrintLists extends Controller{

    public function action(){

      $donnees = new db_request();  
      $template = $this->twig->loadTemplate('printlists.twig');
      
      if(!isset($_SESSION['login'])){
        echo $template->render(array('cur_user' => array('login' => ''), 'events' => $donnees->getEvent()));
      }
      else{
       echo $template->render(array('cur_user' => $_SESSION, 'events' => $donnees->getEvent()));
      }
    }
  }
?>
