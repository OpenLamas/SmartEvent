<?php
  require('twigStart.php');
  
  abstract class CodeError extends Controller{
    private $content;
    private $header;
    private $title;
    
    public function setHeader($header){
      $this->header = $header;
    }
    
    public function setContent($content){
      $this->content = $content;
    }
    
    public function setTitle($title){
      $this->title = $title;
    }
    public function run(){
      $template = $this->twig->loadTemplate('error.twig');
      echo $template->render(array('content' => $this->content, 'title' => $this->title, 'cur_user' => array('login'=>'')));
    }
  }

?>
