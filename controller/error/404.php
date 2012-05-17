<?php	
	require('/basicClass/CodeError.php');
	
	class Error404 extends CodeError{
		public function action(){
			$this->setHeader('HTTP/1.0 404 Not Found');
			$this->setContent('404 - Et non il n\'y a rien ici');
			$this->run();
		}
	}