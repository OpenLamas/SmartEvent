<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  
  class Detail extends Controller{
      
    public function action(){
      
      if(isset($this->vars['ajax']) && $this->vars['ajax'] == 'ajax'){
        $addClass = 'modal fade';
      }
      else{
        $addClass = 'nojavascript';
      }
      
      if(!isset($_SESSION['login'])){
        $template = $this->twig->loadTemplate('login.twig');
        echo $template->render(array('cur_user' => array('login' => ''), 'state' => 'Vous devez être connecté pour voir cette page'));
        exit;
      }
      elseif ($_SESSION["right"]=="utilisateur" || $_SESSION["right"]=="gestionnaire" || $_SESSION["right"]=="admin") {
        $donnees = new db_request();
        $template = $this->twig->loadTemplate('detail.twig');
        echo $template->render(array('cur_user' => $_SESSION, 'event' => $donnees->getEvent($this->vars['idEvent']), 'get' => $addClass));
        exit;
      }
      else{        
        header('Location: error-403');
        exit;
      }
    }
  }
?>