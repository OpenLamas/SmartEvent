<?php 
  require('basicClass/CodeError.php');
  
  class ErrorManchot extends CodeError{
    public function action(){
      $this->setHeader('HTTP/1.1 Manchot Error');
      $this->setTitle('Oups ! Une erreur de configuration est survenue !');
      $this->setContent('Les fichiers sont introuvables ! Le webmaster devrait enlever ses mouffles et remonter ses manches ;-)');
      $this->run();
    }
  }
