<?php
  require('dao/class_db_request.php');
  // require('basicClass/twigStart.php');
  
  class DeleteUsers{
    
    public function action(){
      $donnees = new db_request();
      if(isset($_SESSION['rights']) && $_SESSION['rights']['delete_user']){
        if(isset($_POST['tabUsers'])){       
          for($i=0; $i < count($_POST['tabUsers']); $i++){
            $donnees->deleteUser($_POST['tabUsers'][$i]);
          }
          echo "ok";
          return ;
        }
        echo "!user";
        return;
      }
      
      else{
        echo "!rights";
        return;
      }
    }
  }
?>
