<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class ListEvents extends Controller{

    public function action(){

      if(!isset($_SESSION['login'])){
        $template = $this->twig->loadTemplate('login.twig');
        echo $template->render(array('cur_user' => array('login' => ''), 'state' => 'Vous devez être connecté pour voir cette page'));
        exit;
      }
      else {
        $dbEvents = new db_events();
        $dbSessions = new db_sessions();

        $template = $this->twig->loadTemplate('listevents.twig');
        $events = $dbEvents->getEventsFromSessionWithNbInscrit($this->vars['idSession']);
        $dateslimites  = $dbEvents->getDateLimiteInscriptionFromSession($this->vars['idSession']);
        for($i=0;$i<count($events);$i++) {
          $bool = $dbEvents->getRegisteredFromEvent($_SESSION['idutilisateur'], $events[$i]['idevenement']);
          $events[$i]['estinscrit'] = $bool['count'];
        }
        if(!isset($this->vars['idEvent'])){
          $this->vars['idEvent'] = '';
        }

        $session = $dbSessions->getSession($this->vars['idSession']);
        $session['id'] = $this->vars['idSession'];
        
        echo $template->render(array('cur_user' => $_SESSION, 'session' => $session, 'activeEvent' => $this->vars['idEvent'],'events' => $events, 'dateactuelle' => date("dmY"), 'dateslimites' => $dateslimites));
        exit;
      }
    }
  }
?>