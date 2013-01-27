<?php

  function redirectIfNotLogged() {
    if(!isset($_SESSION['login'])) {
      $template = $this->twig->loadTemplate('login.twig');
      echo $template->render(array('cur_user' => array('login' => ''), 'state' => 'Vous devez être connecté pour voir cette page'));
      die();
    }
  }

  function redirectIfHasNotTheRight($right) {
    if(!hasRight($right, $_SESSION)) {
      throw new ForbiddenError('Nope');
      die();
    }
  }

  function hasRight($right, $user) {
    if(!isset($user['right'])) { return false; }
    $userRight = $user['right'];
    switch($right) {
      case 'ADMIN':
        if($userRight != 'ADMIN') { return false; }
        else { return true; }
        break;

      case 'GESTIONNAIRE':
        if($userRight == 'UTILISATEUR') { return false; }
        else { return true; }
        break;

      case 'UTILISATEUR':
        return true;

      default:
        return false;
    }
  }

?>
