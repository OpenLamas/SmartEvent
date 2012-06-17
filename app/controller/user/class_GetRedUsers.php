<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
	
  class GetRedUsers extends Controller{
  
    public function action(){
      
      if(!isset($_SESSION['login'])){
        $template = $this->twig->loadTemplate('login.twig');
        echo $template->render(array('cur_user' => array('login' => ''), 'state' => 'Vous devez être connecté pour voir cette page'));
        exit;
      }
      elseif ($_SESSION["right"]=="GESTIONNAIRE" || $_SESSION["right"]=="ADMIN") {
        
        if(isset($_POST['idSession']))
          $dbUsers = new db_users();
          echo json_encode($dbUsers->getRedUser($_POST['idSession']));
          exit;
      }
      else{        
        throw new ForbiddenError ("Nope");
        exit;
      }
    }
  }
?>
