<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class EventAddImport extends Controller{

    public function action(){
      
      if(isset($_SESSION['login'])){

        $dbEvents = new db_events();
        foreach ($_POST as $event) {
          if(is_numeric($event)){
            $session = $event;
          }

          else{
            $tabEvent = unserialize($event);
            $dbEvents->addEvent(array('idSession' => $session, 'titre' => $tabEvent[0], 'description' => $tabEvent[1], 'dateDebut' => self::parseDate($tabEvent[2]), 'dateFin' => self::parseDate($tabEvent[3]), 'emplacement' => $tabEvent[4]));
          }         
        }

        $template = $this->twig->loadTemplate('importSucces.twig');
        echo $template->render(array('cur_user' => $_SESSION));
        exit;
      }

      throw new ForbiddenError ("Nope");
      exit;
    }

    /**
    * Methode retrounant la date au format postgres
    * @param $date au format DD/MM/YYYY hh:mm
    * @return string au format YYYY/MM/DD hh:mm
    */
    public function parseDate($date){

      $jour = explode(' ', $date); // On récupére le jour, le mois et l'année
      $tabJour = explode('/', $jour[0]); // On sépart les trois champ

      return $tabJour[2].'/'.$tabJour[1].'/'.$tabJour[0].' '.$jour[1];
    }
  }
?>
