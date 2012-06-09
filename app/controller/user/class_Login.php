<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');

  class Login extends Controller{

    public function action(){
      $state = '';
      if(isset($_SESSION['login']) && $_SESSION['login'] != ''){
        $tmp = $this->twig->getGlobals();
        header('Location: '.$tmp["site_root"]);
      }
      else{
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $dbUsers = new db_users();
          if(isset($_POST['email']) && isset($_POST['password'])){
            $tmpUser = $dbUsers->getPassword(addslashes($_POST['email']));
            if($tmpUser['mdputilisateur'] == md5(addslashes($_POST['password']))){
              $_SESSION = $dbUsers->getUser($tmpUser['idutilisateur']);
              $state = 'success';
            } else {
              $state = 'wrong';
            }
          } else {
            $state = 'noData';
          }
        }
        
        if($state == 'success'){
          if(!isset($_SESSION['login'])){          
            throw new Exception("Error Processing Request", 1);
          }
          else{
            $tmp = $this->twig->getGlobals();
            header('Location: '.$tmp["site_root"]);
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
  }
?>
