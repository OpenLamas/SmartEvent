<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
	
  class EventSubmit extends Controller{
  
    public function action(){
      
      if(isset($_SESSION['login'])){
        $dbEvents = new db_events();
        if($_SESSION['right'] == 'GESTIONAIRE'){
          $dbSessions = new db_sessions();
          if($_SESSION['idUtilisateur'] == $dbSession->getSessionCreator($_POST['session'])){
            $idEvent = $dbEvents->addEvent($_POST);
            echo json_encode(array('code' => 'ok', 'idEvent' => $idEvent));
            exit;
          }
          echo json_encode(array('code' => '!createur'));
          exit;
        }

        elseif($_SESSION['right'] == 'ADMIN'){
          $idEvent = $dbEvents->addEvent($_POST);
          echo json_encode(array('code' => 'ok', 'idEvent' => $idEvent));
          exit;
        }
        echo json_encode(array('code' => '!right'));
        exit;
      }
      header('Location: error-403');
      exit;
    }
  }
?>
