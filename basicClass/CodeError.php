<?php
	require('twigStart.php');
	
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
			$template = $this->twig->loadTemplate('error.twig');
			echo $template->render(array('content' => $this->content, 'cur_user' => array('login'=>'')));
		}
	}

?>
