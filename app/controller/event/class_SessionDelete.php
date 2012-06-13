<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
	
  class SessionDelete extends Controller{
  
    public function action(){

      if(isset($_SESSION['login']) && isset($_POST['tabSessions'])){
        $dbSessions = new db_sessions();
        if($_SESSION['right'] == 'GESTIONNAIRE'){
          foreach($_GET['tabSessions'] as $session){
            if($dbSession->getSessionCreator($session) != $_SESSION['idUtilisateur']){
              echo json_encode(array('code' => '!right'));
              exit;
            } 
          }
            echo json_encode(self::deleteSession($_POST['tabSessions'], $dbSessions));
        }

        elseif($_SESSION['right'] == 'ADMIN'){
          echo json_encode(self::deleteSession($_POST['tabSessions'], $dbSessions));
        }
      }

      else{
        throw new ForbiddenError ("Nope");
        exit;
      }
    }

    public function deleteSession($tabSessions, $handler){
      foreach ($tabSessions as $session) {        
        $handler->removeSession($session);
      }
      return array('code' => 'ok');
    }
  }
?>
