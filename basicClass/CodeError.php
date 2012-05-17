<?php
	require('/twigStart.php');
	
	abstract class CodeError extends Controller{
		private $content;
		private $header;
		
		public function setHeader($header){
			$this->header = $header;
		}
		
		public function setContent($content){
			$this->content = $content;
		}
		public function run(){
			$template = $this->twig->loadTemplate('Error.twig');
			echo $template->render(array('content' => $this->content, 'user' => array('login'=>'')));
		}
	}

?>