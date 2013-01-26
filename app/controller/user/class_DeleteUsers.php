<?php
  require('dao/class_db_request.php');

  class DeleteUsers{

    public function action(){
      $dbUsers = new db_users();
      if($_SESSION["right"]=='ADMIN'){
        if(isset($_POST['tabUsers'])){
          foreach($_POST['tabUsers'] as $i){
            if($i != $_SESSION['idUtilisateur']){
              $dbUsers->removeUser($i);
            }

            else{
              echo "!soi";
            }
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
