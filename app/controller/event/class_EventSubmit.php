<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
	
  class EventSubmit extends Controller{
  
    public function action(){

      if(isset($_SESSION['login'])){
        $dbEvents = new db_events();
        $_POST['dateDebut'] = self::rewiteDate($_POST['dateDebut'], $_POST['heureDebut'], $_POST['minuteDebut']);
        $_POST['dateFin'] = self::rewiteDate($_POST['dateFin'], $_POST['heureFin'], $_POST['minuteFin']);
        
        if($_SESSION['right'] == 'GESTIONAIRE'){
          $dbSessions = new db_sessions();
          if($_SESSION['idUtilisateur'] == $dbSession->getSessionCreator($_POST['idSession'])){
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

  /**
  * Methode retournant la date au format (YYYY-DD-MM HH:mm)
  * @param $date au format francais en toute lettre
  * @param $heure en chiffre
  * @param $minute en chiffre
  * @return string
  */
  public function rewiteDate($date, $heure, $minute){
    $listMois = array('','Janvier','Février','Mars','Avril','Mai','Juin',
    'Juillet','Août','Septembre','Octobre','Novembre','Décembre');

    $dateCasse = explode(' ', $date);
    /*Echo '<pre>';
    Print_r($dateCasse);
    Echo '</pre>';*/
    $dateOutput = $dateCasse[3].'-'.$dateCasse[1].'-';

    foreach($listMois as $key => $mois){
      if($mois == $dateCasse[2]){
        return $dateCasse[3].'-'.$dateCasse[1].'-'.$key.' '.$heure.':'.$minute;
      }
    }

    //throw new Exception("Error Processing Request", 1);
  }
}
?>
