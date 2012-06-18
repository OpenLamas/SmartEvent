<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class PromoteUsers extends Controller{
    
    public function action(){

    	if(isset($_SESSION['login'])){

        if ($_SESSION["right"]=="ADMIN" && isset($_POST['tabUsers']) && isset($_POST['rang'])) {
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

      throw new ForbiddenError ("Nope");
      exit;     
    }
  }
?>
