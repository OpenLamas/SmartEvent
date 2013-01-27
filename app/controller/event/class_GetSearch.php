<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  require('helpers/helpers.php');
  
  class GetSearch extends Controller{

    public function action(){

      if (isset($_SESSION['login'])){
        if(isset($_POST['query'])){
          $dbEvents = new db_events();
          if(strpos($_POST['query'], '%') !== false){
            throw new ForbiddenError ("Nope");
            exit;
          }

          $participation = json_decode(json_encode($dbEvents->getParticipation($_SESSION['idutilisateur'])), true);
          $like = json_decode(json_encode($dbEvents->searchEvents($_POST['query'])), true);
          for ($i=0; $i < count($like); $i++) { 
            if(ArrayEventInArrayEvents($like[$i], $participation)){
              $like[$i]["inscrit"] = true;
            }
            else{
              $like[$i]["inscrit"] = false;
            }
          }
          echo json_encode($like);
          exit;
        }
      }
      throw new ForbiddenError ("Nope");
      exit;
      
    }
  }
?>
