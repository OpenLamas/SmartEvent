<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class ShowHome extends Controller{

    public function action(){

      $dbEvents = new db_events();
      $dbSessions = new db_sessions();
      
      if(!isset($_SESSION['login'])){
        $template = $this->twig->loadTemplate('login.twig');
        echo $template->render(array('cur_user' => array('login' => ''), 'state' => ''));
        exit;
      }
      else{
        $nbEvent = $dbEvents->getNbEventRegistered($_SESSION['idutilisateur']);
        $template = $this->twig->loadTemplate('home.twig');
        // $sessions = $donnees->getSessionPlace();
        $sessions = $dbSessions->getAllSession();
        for($i=0;$i<count($sessions);$i++) {
          $nbReg = $dbEvents->getRegisteredEventPerSession($_SESSION['idutilisateur'], $sessions[$i]['idsession']);
          $sessions[$i]['eventInscrit'] = $nbReg['count'];
        }
        echo $template->render(array('cur_user' => $_SESSION, 'sessions' => $sessions, 'totalRegisteredCount' => $nbEvent['count'], 'lastevent' => $dbEvents->getLastEvents($_SESSION['idutilisateur'])));
      }
    }
  }
?>
