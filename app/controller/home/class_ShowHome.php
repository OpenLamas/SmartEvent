<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  require('helpers/helpers.php');

  class ShowHome extends Controller{

    public function action(){

      $this->redirectIfNotLogged();
      redirectIfHasNotTheRight('UTILISATEUR');

      $dbEvents = new db_events();
      $dbSessions = new db_sessions();

      $nbEvent = $dbEvents->getNbEventRegisteredLast($_SESSION['idutilisateur']);
      $template = $this->twig->loadTemplate('home.twig');
      // $sessions = $donnees->getSessionPlace();
      $sessions = $dbSessions->getAllSessionLast();
      for($i=0;$i<count($sessions);$i++) {
        $nbReg = $dbEvents->getRegisteredEventPerSession($_SESSION['idutilisateur'], $sessions[$i]['idsession']);
        $sessions[$i]['eventInscrit'] = $nbReg['count'];
      }
      echo $template->render(array('cur_user' => $_SESSION, 'sessions' => $sessions, 'totalRegisteredCount' => $nbEvent['count'], 'lastevent' => $dbEvents->getLastEvents($_SESSION['idutilisateur'])));
    }
  }
?>
