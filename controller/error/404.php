<?php	
	require('./basicClass/CodeError.php');
	
	class Error404 extends CodeError{
		public function action(){
			$this->setHeader('HTTP/1.0 404 Not Found');
      $this->setTitle('Mince, la page n\'existe pas :(');
			$this->setContent('Le problème a été enregistré, il sera bientôt résolu.');
			$this->run();
		}
	}
