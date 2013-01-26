<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  require('helpers/helpers.php');

  class ListUsers extends Controller{

    public function action(){

      redirectIfNotLogged();
      redirectIfHasNotTheRight('ADMIN');

      $dbUsers = new db_users();
      $template = $this->twig->loadTemplate('users.twig');
      echo $template->render(array('cur_user' => $_SESSION, 'users' => $dbUsers->getAllUsers()));

    }
  }
?>
