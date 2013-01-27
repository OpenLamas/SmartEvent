<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  require('helpers/helpers.php');

  class PromoteUsers extends Controller{

    public function action(){

      $this->redirectIfNotLogged();
      redirectIfHasNotTheRight('ADMIN');

      if(theseKeysExistsAndAreNotEmpty($_POST, array('tabUsers', 'rang'))) {
        $dbUsers = new db_users();
        foreach($_POST['tabUsers'] as $user){
          $dbUsers->updateUserRight($user, $_POST['rang']);
        }
        echo json_encode(array('code' => 'ok'));
        exit;
      }
      else{
        echo json_encode(array('code' => '!right'));
        exit;
      }

    }
  }
?>
