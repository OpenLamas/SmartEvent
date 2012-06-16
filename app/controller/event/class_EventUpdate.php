<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
	
  class EventUpdate extends Controller{
  
    public function action(){

      if(isset($_SESSION['login']) && isset($_POST['idEvenement'])){
        if($_SESSION['right'] == 'GESTIONAIRE' || $_SESSION['right'] == 'ADMIN'){
          
          if(!is_numeric($_POST['dateDebut'][0])){
            $_POST['dateDebut'] = self::rewiteDate($_POST['dateDebut']);
          }

          if(!is_numeric($_POST['dateFin'][0])){
            $_POST['dateFin'] = self::rewiteDate($_POST['dateFin']);
          }


          $dbEvents = new db_events();
          $dbEvents->updateEvent($_POST);
          echo json_encode(array('code' => 'ok'));
          exit;
        }
        echo json_encode(array('code' => 'Non'));
        exit;
      }
      throw new ForbiddenError ("Nope");
      exit;
    }

  /**
  * Methode retournant la date au format (YYYY-DD-MM hh:mm)
  * @param $date au format francais en toute lettre avec heure
  * @return string
  */
  public function rewiteDate($date){
    $listMois = array('','Janvier','Février','Mars','Avril','Mai','Juin',
    'Juillet','Août','Septembre','Octobre','Novembre','Décembre');

    $dateCasse = explode(' ', $date);
    $heure = explode(':', $dateCasse[4]);

    foreach($listMois as $key => $mois){
      if($mois == $dateCasse[2]){
        return $dateCasse[3].'-'.$key.'-'.$dateCasse[1].' '.$heure[0].':'.$heure[1];
      }
    }

    return 0;
  }
}
?>
