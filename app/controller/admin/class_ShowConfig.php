<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  require('helpers/helpers.php');

  class ShowConfig extends Controller{

    public function action(){

      $this->redirectIfNotLogged();
      redirectIfHasNotTheRight('ADMIN');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

        }

        $template = $this->twig->loadTemplate('config.twig');
        echo $template->render(array('cur_user' => $_SESSION, 'hostname' => HOSTNAME, 'port' => PORT, 'dbname' => DBNAME, 'user' => DBUSER, 'password' => DBPASSWORD, 'domains' => implode(';', unserialize(DOMAINS))));
        exit;
    }
  }
?>
