<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  require('helpers/helpers.php');

  class ManageBackups extends Controller{

    public function action(){

      $this->redirectIfNotLogged();
      redirectIfHasNotTheRight('ADMIN');

      $template = $this->twig->loadTemplate('backups.twig');
      echo $template->render(array('cur_user' => $_SESSION));

    }
  }
?>
