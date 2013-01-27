<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  require('helpers/helpers.php');

  class SelfEdit extends Controller {

    public function action(){

      $this->redirectIfNotLogged();
      redirectIfHasNotTheRight('UTILISATEUR');

      // On regarde si on vient du form
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $dbUsers = new db_users();
        if(theseKeysExistsAndAreNotEmpty($_POST, array('idUtilisateur', 'nomUtilisateur', 'prenomUtilisateur', 'mailUtilisateur'))) {
          $dbUsers->updateUser($_POST);
          $_SESSION = $dbUsers->getUser($_SESSION['idutilisateur']);
          $state = 'ok';
        }
        // Si des champs sont vides on met à jour le statut
        else { $state = 'noData'; }

        // On réaffiche la page avec le statut
        $template = $this->twig->loadTemplate('user.twig');
        echo $template->render(array('cur_user' => $_SESSION, 'state' => $state));
      }

      // Si on ne vient pas du form
      else {
        $template = $this->twig->loadTemplate('user.twig');
        echo $template->render(array('cur_user' => $_SESSION));
      }

    }
  }
?>
