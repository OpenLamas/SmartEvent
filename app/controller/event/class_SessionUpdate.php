<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
	
  class SessionUpdate extends Controller{
  
    public function action(){

      if(isset($_SESSION['login']) && isset($_POST['idSession'])){
        if($_SESSION['right'] == 'GESTIONAIRE' || $_SESSION['right'] == 'ADMIN'){
          
          if(!is_numeric($_POST['dateLimite'][0])){
            $_POST['dateLimite'] = self::rewiteDate($_POST['dateLimite']);
          }

          if(!is_numeric($_POST['dateRappel'][0])){
            $_POST['dateRappel'] = self::rewiteDate($_POST['dateRappel']);
          }


          $dbSessions = new db_sessions();
          $idSession = $dbSessions->updateSession($_POST);
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

    return 0;
  }
}
?>
