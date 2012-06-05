<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class ShowHome extends Controller{

    public function action(){

      $donnees = new db_request();
      
      if(!isset($_SESSION['login'])){
        $template = $this->twig->loadTemplate('login.twig');
        echo $template->render(array('cur_user' => array('login' => ''), 'state' => ''));
        exit;
      }
      else{
        $nbEvent = $donnees->getNbEventRegistered($_SESSION['idutilisateur']);
        $template = $this->twig->loadTemplate('home.twig');
        // $sessions = $donnees->getSessionPlace();
        $sessions = $donnees->getSession();
        /* for($i=0;$i<count($sessions);$i++) {
          $sessions[$i]['eventInscrit'] = $donnees->getRegisteredEventPerSession($_SESSION['idutilisateur'], $sessions[$i]['idsession']);
        }*/
        echo $template->render(array('cur_user' => $_SESSION, 'sessions' => $sessions, 'totalRegisteredCount' => $nbEvent['count'], 'lastevent' => $donnees->getLastEvents($_SESSION['idutilisateur'])));
      }
    }
  }
?>
