<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class ListUsers extends Controller{
    
    public function action(){
      $donnees = new db_request();
      /*if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['user'])){       
          foreach ($_POST['user'] as $user_id){
            $donnees->deleteUser($user_id);
          }
        }
      }*/
      $template = $this->twig->loadTemplate('users.twig');
      echo $template->render(array('cur_user' => $donnees->getUser(1), 'users' => $donnees->getAllUsers()));
    }
  }
?>
