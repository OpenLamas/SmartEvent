<?php
  require('dao/class_db_request.php');
  // require('basicClass/twigStart.php');
  
  class DeleteUsers{
    
    public function action(){
      $donnees = new db_request();
      if($_SESSION["right"]=="admin"){
        if(isset($_POST['tabUsers'])){       
          foreach($_POST['tabUsers'] as $i){
            $donnees->deleteUser($i);
          }
          echo "ok";
          exit;
        }
        echo "!user";
        exit;
      }
      
      else{
        echo "!rights";
        exit;
      }
    }
  }
?>
