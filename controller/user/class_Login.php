<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');

  class Login extends Controller{

    public function action(){
      $state = '';
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $donnees = new db_request();
        echo 'requete post<br />';
        if(isset($_POST['email']) && isset($_POST['password'])){
          $tmpUser = $donnees->getPassword(addslashes($_POST['email']));
          echo 'champs remplis<br />';
          if($tmpUser['password'] == md5(addslashes($_POST['password']))){
            echo 'identification ok';
            $_SESSION = $donnees->getUser($tmpUser['id']);
            $state = 'success';
          }
          $state = 'wrong';
        }
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
