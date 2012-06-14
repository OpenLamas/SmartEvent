<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class GetSearch extends Controller{

    public function action(){

      if (isset($_SESSION['login'])){
        if(isset($_POST['query'])){
          $dbEvents = new db_events();
          //echo json_encode($_POST);
          echo json_encode($dbEvents->searchEvents($_POST['query']));
          exit;
        }
      } 

      throw new ForbiddenError ("Nope");
      exit;
      
    }
  }
?>
