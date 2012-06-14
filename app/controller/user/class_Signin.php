<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');

  class Signin extends Controller{

    public function action(){
      $state = '';
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $dbUsers = new db_users();        
        
        if (isset($_POST['nomUtilisateur']) && isset($_POST['prenomUtilisateur']) && isset($_POST['mailUtilisateur']) && isset($_POST['mdpUtilisateur']))
        {
          if($_POST['nomUtilisateur'] != "" && $_POST['prenomUtilisateur'] != "" && $_POST['mailUtilisateur'])
          {
            if($_POST['mdpUtilisateur'] != $_POST['mdpUtilisateur2']){
              $state='erreurPass';
            }
            else {
              $_POST['mdpUtilisateur'] = md5($_POST['mdpUtilisateur']);
              if(is_int($dbUsers->addUser($_POST))) {
                $state = 'ok';
              }
              else {
                $state = 'erreur';
              }  
            }
          }
          else {
            $state='noData';
          }   
        }
        else {
          $state='noData';
        }               
      }
      $template = $this->twig->loadTemplate('signin.twig');
      echo $template->render(array('cur_user' => array('login' => ''), 'state' => $state));
    }
  }
?>