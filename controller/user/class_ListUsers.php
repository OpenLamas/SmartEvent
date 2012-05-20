<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class ListUsers extends Controller{
    
    public function action(){
      $donnees = new db_request();
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['user'])){       
          for($i=0; $i < count($_POST['user']); $i++){
            $donnees->deleteUser($_POST['user'][$i]);
          }
        }
      }
      $template = $this->twig->loadTemplate('users.twig');
      echo $template->render(array('cur_user' => $donnees->getUser(1), 'users' => $donnees->getAllUsers()));
    }
  }
?>
