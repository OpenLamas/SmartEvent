<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');

  class Signin extends Controller{

    public function action(){
      $state = '';
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $dbUsers = new db_users();

        if (isset($_POST['nomUtilisateur']) && isset($_POST['prenomUtilisateur']) && isset($_POST['mailUtilisateur']) && isset($_POST['mdpUtilisateur']) && isset($_POST['mdpUtilisateur2']))
        {
          if($_POST['nomUtilisateur'] != "" && $_POST['prenomUtilisateur'] != "" && $_POST['mailUtilisateur'] != "")
          {
            $domain_mail = explode('@', $_POST['mailUtilisateur']);
            if(in_array($domain_mail[1], unserialize(DOMAINS))){
              if($_POST['mdpUtilisateur'] != $_POST['mdpUtilisateur2']){
                $state='erreurPass';
              }
              else {
                $_POST['mdpUtilisateur'] = md5($_POST['mdpUtilisateur']);
                $_POST['refDroit'] = '1';
                $codeconfirmation = $dbUsers->addUser($_POST);
                $template = $this->twig->loadTemplate('login.twig');
                echo $template->render(array('cur_user' => array('login' => ''), 'state' => ''));
                die();
              }
            }
            else{
              $state='badDomain';
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
      else if(isset($this->vars['codeconfirmation'])){
        $dbUsers = new db_users();
        if(is_int($dbUsers->confirmUser($this->vars['codeconfirmation'])))
        {
          $state='confirmed';
        }
        else
        {
          $state="erreur";
        }
      }
      $template = $this->twig->loadTemplate('signin.twig');
      echo $template->render(array('cur_user' => array('login' => ''), 'state' => $state));
    }
  }
?>
