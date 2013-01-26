<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');

  class SelfEdit extends Controller {

    public function action(){

      if(!isset($_SESSION['login'])){
        $template = $this->twig->loadTemplate('login.twig');
        echo $template->render(array('cur_user' => array('login' => ''), 'state' => 'Vous devez être connecté pour voir cette page'));
        exit;
      }
      elseif ($_SESSION["right"]=="ADMIN" || $_SESSION["right"]=="GESTIONNAIRE" || $_SESSION["right"]=="UTILISATEUR") {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $dbUsers = new db_users();
          if(!empty($_POST['nomUtilisateur']) && !empty($_POST['prenomUtilisateur']) && !empty($_POST['mailUtilisateur'])) {
            $dbUsers->updateUser($_POST);
            $_SESSION = $dbUsers->getUser($_SESSION['idutilisateur']);
            $state = 'ok';
            $template = $this->twig->loadTemplate('user.twig');
            echo $template->render(array('cur_user' => $_SESSION, 'state' => $state));
          }
          else {
            $state = 'noData';
            $template = $this->twig->loadTemplate('user.twig');
            echo $template->render(array('cur_user' => $_SESSION, 'state' => $state));
          }
        }
        else {
          $template = $this->twig->loadTemplate('user.twig');
          echo $template->render(array('cur_user' => $_SESSION));
        exit;
        }
      }
      else{
        throw new ForbiddenError ("Nope");
        exit;
      }
    }
  }
?>
