<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
	
  class EventDelete extends Controller{
  
    public function action(){
      if(isset($_SESSION['login']) && isset($_POST['tabEvents'])){
        if($_SESSION['right'] == 'ADMIN' || $_SESSION['right'] == 'GESTIONNAIRE'){
          $dbEvents = new db_events();
          foreach($_POST['tabEvents'] as $event){        
            $dbEvents->removeEvent($event);
          }
          echo json_encode(array('code' => 'ok'));
          //exit;
        }

        else{
          throw new ForbiddenError ("Nope");
          exit;
        }     
      }

      else{
        throw new ForbiddenError ("Nope");
        exit;
      }
    }
  }

?>
