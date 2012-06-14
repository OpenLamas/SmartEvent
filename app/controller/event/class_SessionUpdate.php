<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
	
  class SessionUpdate extends Controller{
  
    public function action(){

      if(isset($_SESSION['login']) && isset($_POST['dateLimite'])){
        if($_SESSION['right'] == 'GESTIONAIRE' || $_SESSION['right'] == 'ADMIN'){
          $_POST['dateLimite'] = self::rewiteDate($_POST['dateLimite']);
          $_POST['dateRappel'] = self::rewiteDate($_POST['dateRappel']);
          $_POST['idCreateur'] = $_SESSION['idutilisateur'];
          $dbSessions = new db_sessions();
            $idSession = $dbSessions->addSession($_POST);
          echo json_encode(array('code' => 'ok', 'idSession' => $idSession));
          exit;
        }
        echo json_encode(array('code' => 'Non'));
        exit;
      }
      throw new ForbiddenError ("Nope");
      exit;
    }

  /**
  * Methode retournant la date au format (YYYY-DD-MM)
  * @param $date au format francais en toute lettre
  * @return string
  */
  public function rewiteDate($date){
    $listMois = array('','Janvier','Février','Mars','Avril','Mai','Juin',
    'Juillet','Août','Septembre','Octobre','Novembre','Décembre');

    $dateCasse = explode(' ', $date);

    foreach($listMois as $key => $mois){
      if($mois == $dateCasse[2]){
        return $dateCasse[3].'-'.$key.'-'.$dateCasse[1];
      }
    }
  }
}
?>
