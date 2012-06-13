<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class ListUsers extends Controller{
    
    public function action(){

    	if(!isset($_SESSION['login'])){
        if ($_SESSION["right"]=="ADMIN" && isset($_POST['tabUsers'])) {
        $dbUsers = new db_users();

          $dbUsers->
        exit;
        }
      }

      throw new ForbiddenError ("Nope");
      exit;     
    }
  }
?>
