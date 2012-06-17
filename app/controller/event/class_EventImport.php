<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class EventImport extends Controller{

    public function action(){
      
      if(isset($_SESSION['login'])){

        $tmp = explode('.', $_FILES['eventsCSV']['name']);

        if(strtolower(end($tmp)) == 'csv'){
          $file = fopen($_FILES['eventsCSV']['tmp_name'], 'r');
          $listEvent = explode('<br />', nl2br(utf8_encode(fread($file, $_FILES['eventsCSV']['size']))));
          
          $eventsFormat = array();
          foreach($listEvent as $event){
            $tabEvent = explode(';', $event); //On casse la ligne
            array_push($tabEvent, serialize($tabEvent)); // On ajoute a la fin du tableau le tableau serializer
            array_push($eventsFormat, $tabEvent);
          }
          array_pop($eventsFormat);

          $dbSessions = new db_sessions();
          $template = $this->twig->loadTemplate('importEvent.twig');
          echo $template->render(array('cur_user' => $_SESSION, 'session'=> $dbSessions->getSession($_POST['idCurrentSession']),'listEvents' => $eventsFormat));
          fclose($file);
          exit;
        }
      }

      throw new ForbiddenError ("Nope");
      exit;
    }
  }
?>
