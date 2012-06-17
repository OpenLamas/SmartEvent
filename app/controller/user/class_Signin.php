<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  require('Classes/mailwrapper.php');

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
              $codeconfirmation = $dbUsers->addUser($_POST);
              if($codeconfirmation != false) {
                $maildest = $_POST['mailUtilisateur'];
                $mailer1 = new MailWrapper("local@localhost.local");
                //$mailer1->SendOneMail("$maildest","Confirmation de votre compte SmartEvent", "Votre code de confirmation : $codeconfirmation");
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