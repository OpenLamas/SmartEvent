<?php 
  require('basicClass/CodeError.php');
  
  class Error403 extends CodeError{
    public function action(){
      $this->setHeader('HTTP/1.1 403 Forbidden');
      $this->setTitle('Wola ! Vous n\'avez pas le droit d\'être là !');
      $this->setContent('Si vous pensé avoir le droit d\'accéder à cette zone, merci de contacter votre administrateur');
      $this->run();
    }
  }
