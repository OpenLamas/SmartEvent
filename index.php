<?php
  session_start();
  
  $dom = new DOMDocument;
  if(!$dom->load('./config/routes.xml')){
    throw new RuntimeException ("Routes introuvable");
  }
  
  foreach ($dom->getElementsByTagName('route') as $route)
  {
    if(preg_match('#'.$route->getAttribute('url').'$#', $_SERVER['REQUEST_URI'], $matches)){
      $module = $route->getAttribute('module');
      $action = $route->getAttribute('action');
      $vars = array();
      
      
      if(!is_dir('./controller/'.$module.'/'))
      {
        throw new RuntimeException ("Le module ".$module." n'existe pas");
      }
      
      if(!file_exists('./controller/'.$module.'/class_'.$action.'.php')){
        throw new RuntimeException ("La classe ".$action." n'existe pas");
      }
      
      require('./controller/'.$module.'/class_'.$action.'.php');
      $page = new $action;
      
      if ($route->hasAttribute('vars'))
      {
        $varsName = explode(',', $route->getAttribute('vars')); //On casse les liste des variables
        $partRegExp = explode('-', $route->getAttribute('url')); // On casse le masque
        $foo = explode('/', $_SERVER['REQUEST_URI']); // On casse l'url
        $partUrl = explode('-', $foo[2]); // On ne garde que le chemin depuis la racine du serveur
        $j = 0;
        for($i=0;$i<count($partUrl);$i++){
          if($partRegExp[$i][0] == '('){ // Si le morceau de masque ou le dernier caractère du dernier morceau est une RegExp
            $vars[$varsName[$j]] = $partUrl[$i]; 
            /*On met la valeur passé dans l'url dans l'array (ex varName='foo'
            url='/bar-toto' et masque= /bar-([a-z]+) =>array['foo'] = 'toto')*/
            $j++;
           }
           
           elseif ($i > 0 && $partRegExp[$i-1][count($partRegExp[$i-1])-1] == '('){
            $i++;
            if(isset($partUrl[$i])){
              $vars[$varsName[$j]] = $partUrl[$i]; 
              /*On met la valeur passé dans l'url dans l'array (ex varName='foo'
              url='/bar-toto' et masque= /bar-([a-z]+) =>array['foo'] = 'toto')*/
              $j++;
            }
           }
        }
        $page->setVars($vars); // On envoi le tableau a la class
      }
      $page->action();
      break;
    }
  }
  
  if(!isset($page)){
    require('./controller/error/class_Error404.php');
    $error = new Error404;
    $error->action();
    
  }
  ?>
