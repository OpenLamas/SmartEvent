<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');

  class NextEvents extends Controller{
    
    public function action(){
      
      if(!isset($_SESSION['login'])){
        $template = $this->twig->loadTemplate('login.twig');
        echo $template->render(array('cur_user' => array('login' => ''), 'state' => 'Vous devez être connecté pour voir cette page'));
        exit;
      }
      else{
        $dbEvents = new db_events();
        $template = $this->twig->loadTemplate('calendar.twig');
        $events = $dbEvents->getEventsFromUser($_SESSION['idutilisateur']);
        $script = "";

        foreach ($events as $event) {
          $date = explode(" ", $event['datedebutevenement']);
          $heure = $date[1];
          $date = explode("-", $date[0]);

          $length = 26;
          $cutString = '...';
          $str = substr($event['nomevenement'],0,$length-strlen($cutString)+1);
          $titre = (strlen($event['nomevenement']) <= $length) ? $event['nomevenement'] : substr($str,0,strrpos($str,' ')).$cutString;

          $script .= "{
            title: '".$titre."',
            start: new Date("./*$date[0]*/'2012'.", ".($date[1] - 1).", ".$date[2].")
          },";
        }
        echo $template->render(array('cur_user' => $_SESSION, 'nextevents' => $script, 'events' => $events));
        exit;
      }
    }
  }
?>
