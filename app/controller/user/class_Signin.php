<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');

  class Signin extends Controller{

    public function action(){
      $template = $this->twig->loadTemplate('signin.twig');
      echo $template->render(array('cur_user' => array('login' => '')));
    }
  }
?>