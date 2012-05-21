<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');

  class Login extends Controller{

    public function action(){
      $state = '';
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $donnees = new db_request();
        if(isset($_POST['email']) && isset($_POST['password'])){
          $tmpUser = $donnees->getPassword(addslashes($_POST['email']));
          if($tmpUser['password'] == md5(addslashes($_POST['password']))){
            $_SESSION = $donnees->getUser($tmpUser['id']);
            $state = 'success';
          }
          $state = 'wrong';
        }
      } else {
        $state = 'noData';
      }
      $template = $this->twig->loadTemplate('login.twig');
      if(!isset($_SESSION['login'])){
        $_SESSION['login'] = '';
      }
      echo $template->render(array('cur_user' => $_SESSION, 'state' => $state));
    }
  }
?>
