<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class ListUsers extends Controller{
    
    public function action(){

    	if(!isset($_SESSION['login'])){
        $template = $this->twig->loadTemplate('login.twig');
        echo $template->render(array('cur_user' => array('login' => ''), 'state' => 'Vous devez être connecté pour voir cette page'));
        exit;
      }
      elseif ($_SESSION["right"]=="ADMIN") {
        $dbUsers = new db_users();
        $template = $this->twig->loadTemplate('users.twig');
        echo $template->render(array('cur_user' => $_SESSION, 'users' => $dbUsers->getAllUsers()));
        exit;
      }
      else{        
        header('Location: error-403');
        exit;
      }      
    }
  }
?>
