<?php 
  require('basicClass/CodeError.php');
  
  class Error500 extends CodeError{
    public function action(){
      $this->setHeader('HTTP/1.1 500 Internal Server Error');
      $this->setTitle('Oups ! Une erreur interne est survenue !');
      $this->setContent('Si celle-ci est récurrente, contactez le webmaster. Sinon, vous pouvez tenter d\'actualiser la page');
      $this->run();
    }
  }
