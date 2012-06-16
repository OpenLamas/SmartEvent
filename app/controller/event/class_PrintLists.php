<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class PrintLists extends Controller{
    
    public function action(){

      if(!isset($_SESSION['login'])){
        $template = $this->twig->loadTemplate('login.twig');
        echo $template->render(array('cur_user' => array('login' => ''), 'state' => 'Vous devez être connecté pour voir cette page'));
        exit;
      }
      elseif ($_SESSION["right"]=="GESTIONNAIRE" || $_SESSION["right"]=="ADMIN") {
        if(isset($this->vars['idSession'])){
          $dbEvents = new db_events();
          $template = $this->twig->loadTemplate('listings.twig');
          
          $listUsers = $dbEvents->getInfoInscritFromSession($this->vars['idSession']);
          $listEvent = $dbEvents->getEventAndNomSession($this->vars['idSession']);

          foreach ($listEvent as $event) {
            $listeUsersEvent[$event['idevenement']]['info'] = $event;
            $listeUsersEvent[$event['idevenement']]['listUser'] = array();
          }

          foreach ($listUsers as $user) {
            array_push($listeUsersEvent[$user['idevenement']]['listUser'], $user); 
          }

          echo $template->render(array('cur_user' => $_SESSION, 'session' => $listeUsersEvent));
          exit;
        }
        
      }       
        throw new ForbiddenError ("Nope");
        exit;  
    }
  }



/* session = {
  1: { // idEvent
    info: {
      titre: 'Blablabla'
      dateDebut: 215
      dateFin: 553545
    }
    listUser: {
      0: {}
      0: {}
      0: {}
      0: {}
    }
  }

}*/

?>