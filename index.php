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
        $varsName = explode(',', $route->getAttribute('vars'));
        $partRegExp = explode('-', $route->getAttribute('url'));
        $foo = explode('/', $_SERVER['REQUEST_URI']);
        $partUrl = explode('-', $foo[2]);
        $j = 0;
        for($i=0;$i<count($partUrl)-1;$i++){
          if($partRegExp[$i][0] == '('){
            $vars[$varsName[$j]] = $partUrl[$i];
            $j++;
          }
        }
        $page->setVars($vars);
      }
      $page->action();
			break;
		}
	}
	
	if(!isset($page)){
		require('./controller/error/404.php');
		$error = new Error404;
		$error->action();
		
	}
	?>
