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

      elseif (!$_SESSION["rights"]['add_user'] && !$_SESSION["rights"]['edit_user'] && !$_SESSION["rights"]['delete_user']) {
        header('Location: error-403');
        exit;
      }

      $donnees = new db_request();
      $template = $this->twig->loadTemplate('users.twig');
      echo $template->render(array('cur_user' => $donnees->getUser(1), 'users' => $donnees->getUser(), 'groups' => $donnees->getGroup()));
    }
  }
?>
