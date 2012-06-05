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
        echo $template->render(array('cur_user' => $_SESSION, 'sessions' => $donnees->getSession(), 'totalRegisteredCount' => $nbEvent['count'], 'lastevent' => $donnees->getLastEvents($_SESSION['idutilisateur'])));
      }
    }
  }
?>