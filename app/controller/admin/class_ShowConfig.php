<?php
  require_once('basicClass/twigStart.php');
  require_once('helpers/helpers.php');
  require_once('helpers/configHelper.php');

  class ShowConfig extends Controller{

    public function action(){

      $this->redirectIfNotLogged();
      redirectIfHasNotTheRight('ADMIN');

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(theseKeysExistsAndAreNotEmpty($_POST, array('domains', 'site_root', 'IPSqlServer', 'PortSqlServer', 'user', 'dbpassword', 'dbname'))) {

              if(serialize(explode(';', $_POST['domains'])) != DOMAINS || $_POST['site_root'] != SITEROOT){
                $config = array();
                $config['DOMAINS']      = addslashes(serialize((explode(';', $_POST['domains']))));
                $config['SITEROOT']     = $_POST['site_root'];
                writeConfArrayToFile($config, 'config/config.php');
              }

              if(HOSTNAME != $_POST['IPSqlServer'] || PORT != $_POST['PortSqlServer'] || DBUSER != $_POST['user'] || DBPASSWORD != $_POST['dbpassword'] || DBNAME != $_POST['dbname']){
                $configDB['HOSTNAME']   = $_POST['IPSqlServer'];
                $configDB['PORT']       = $_POST['PortSqlServer'];
                $configDB['DBUSER']     = $_POST['user'];
                $configDB['DBPASSWORD'] = $_POST['dbpassword'];
                $configDB['DBNAME']     = $_POST['dbname'];
                writeConfArrayToFile($configDB, 'config/db.conf.php');

              }
            }
          }

        $template = $this->twig->loadTemplate('config.twig');
        echo $template->render(array('cur_user' => $_SESSION, 'hostname' => HOSTNAME, 'port' => PORT, 'dbname' => DBNAME, 'user' => DBUSER, 'password' => DBPASSWORD, 'domains' => implode(';', unserialize(stripslashes(DOMAINS)))));
        exit;
    }
  }
?>
