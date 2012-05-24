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
          } else {
            $state = 'wrong';
          }
        } else {
          $state = 'noData';
        }
      }
      
      if($state == 'success'){
        $template = $this->twig->loadTemplate('home.twig');
        if(!isset($_SESSION['login'])){
          echo $template->render(array('cur_user' => array('login' => ''), 'collections' => $donnees->getCollection()));
        }
        else{
          echo $template->render(array('cur_user' => $_SESSION, 'collections' => $donnees->getCollection()));
        }
      }
      else
      {
        $template = $this->twig->loadTemplate('login.twig');
        if(!isset($_SESSION['login'])){
          echo $template->render(array('cur_user' => array('login'=> ''), 'state' => $state));
        }
        else{
          echo $template->render(array('cur_user' => $_SESSION, 'state' => $state));
        }
      }
    }
  }
?>
