<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  require('helpers/helpers.php');
  require('helpers/mailHelper.php');

  class SendReminders extends Controller{

    public function action(){

      $this->redirectIfNotLogged();
      redirectIfHasNotTheRight('GESTIONNAIRE');

      if(isset($this->vars['idSession'])) {
        $idSession = $this->vars['idSession'];

        // On récupère le nom de la session
        $dbSessions = new db_sessions();
        $session = $dbSessions->getSession($idSession);
        $nomsession = $session['nomsession'];

        // On récupère les utilisateurs "en rouge"
        $dbUsers = new db_users();
        $redUsers = $dbUsers->getRedUser($idSession);

        // On envoie un mail à chaque utilisateur
        foreach($redUsers as $user) {
          // On récupère le mail de l'utilisateur
          $u = $dbUsers->GetUser($user['idutilisateur']);
          $mailto = $u['mailutilisateur'];

          // On envoie le mail
          $message ="Bonjour,

Vous n'êtes pas inscrit au nombre requis d'évènement pour la session $nomsession.
Vous pouvez vous connecter sur http://jesépameservirduvpn.qom pour vous inscrire.

Cordialement,";
          $result  = SendOneMail($mailto, "IUT Annecy - Rappel inscription $nomsession", $message);
          echo $result;
        }

        $template = $this->twig->loadTemplate('mailReminders.twig');
        echo $template->render(array('cur_user' => $_SESSION));

      }

    }
  }
?>
