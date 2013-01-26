<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  require('helpers/helpers.php');

  class GetRedUsers extends Controller{

    public function action(){

      redirectIfNotLogged();
      redirectIfHasNotTheRight('GESTIONNAIRE');

      if(isset($_POST['idSession'])) {
        $dbUsers = new db_users();
        echo json_encode($dbUsers->getRedUser($_POST['idSession']));
        exit;
      }

    }
  }
?>
