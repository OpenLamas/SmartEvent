<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class ManageBackups extends Controller{
    
    public function action(){

      if(!isset($_SESSION['login'])){
        $template = $this->twig->loadTemplate('login.twig');
        echo $template->render(array('cur_user' => array('login' => ''), 'state' => 'Vous devez être connecté pour voir cette page'));
        exit;
      }
      elseif ($_SESSION["right"]=="ADMIN") {
        $template = $this->twig->loadTemplate('backups.twig');
        echo $template->render(array('cur_user' => $_SESSION));
        exit;
      }
      else{        
        throw new ForbiddenError ("Nope");
        exit;
      }     
    }
  }
?>