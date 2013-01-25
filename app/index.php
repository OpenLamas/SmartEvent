<?php
  session_start();
  require('basicClass/customError.php');
  ini_set('display_errors', True);

  // On verifie si le fichier de conf existe, sinon on redirige sur setup.php
  if (!file_exists('config/config.php') || !file_exists('config/db.conf.php')) {
    header('Location: setup.php');
    die();
  }
  else {
    include('config/config.php');
    include('config/db.conf.php');
  }

  try {
    $dom = new DOMDocument;
    if(!$dom->load('./config/routes.xml')){
      throw new ManchotError ("Routes introuvable");
    }

    foreach ($dom->getElementsByTagName('route') as $route)
    {
      if(preg_match('#'.$route->getAttribute('url').'$#', $_SERVER['REQUEST_URI'], $matches)){
        $module = $route->getAttribute('module');
        $action = $route->getAttribute('action');
        $vars = array();


        if(!is_dir('./controller/'.$module.'/'))
        {
          throw new ManchotError ("Le module ".$module." n'existe pas");
        }

        if(!file_exists('./controller/'.$module.'/class_'.$action.'.php')){
          throw new ManchotError ("La classe ".$action." n'existe pas");
        }

        require('./controller/'.$module.'/class_'.$action.'.php');
        $page = new $action;

        if ($route->hasAttribute('vars'))
        {
          $varsName = explode(',', $route->getAttribute('vars')); //On casse les liste des variables
          $partRegExp = explode('-', $route->getAttribute('url')); // On casse le masque

          // **OLD**  $foo = explode('/', $_SERVER['REQUEST_URI']); // On casse l'url

          $req = substr($_SERVER['REQUEST_URI'], strlen(SITEROOT)+1); // On ne garde que l'uri de la demande
          $partUrl = explode('-', $req); // On ne garde que le chemin depuis la racine du serveur
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
  }
  catch(ManchotError $e){
    //header("Location: error-manchot");
    echo $e->getMessage();
    exit;
  }

  catch(NotFoundError $e){
    //header('Location: error-404');
    echo 'Axiste pas !';
  }

  catch(ForbiddenError $e){
    //header('Location: error-403');
    echo 'Pas le droit !';
  }

  catch(Exception $e){
    //header('Location: error-500');
    echo $e->getFile().' ';
    echo $e->getLine().' ';
    echo $e->getMessage();
    exit;
  }

  if(!isset($page)){
    require('./controller/error/class_Error404.php');
    $error = new Error404;
    $error->action();

  }
  ?>
