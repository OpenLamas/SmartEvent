<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class DetailSession extends Controller{

    public function action(){
      if(isset($this->vars['idEvent']) && isset($_SESSION['login'])){
        $donnees = new db_request();  
        $template = $this->twig->loadTemplate('detailSession.twig');

        echo $template->render(array('cur_user' => $_SESSION, 'session' => $donnees->getSession($this->vars['idEvent'])));
      }
      
      else{
       echo 'NOPE' /*$template->render(array('cur_user' => array('login' => '')))*/;
      }
    }
  }
?>
