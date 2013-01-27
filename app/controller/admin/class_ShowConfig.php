<?php
  require('dao/class_db_request.php');
  require('basicClass/twigStart.php');
  require('helpers/helpers.php');
  require('helpers/configHelper.php');

  class ShowConfig extends Controller{

    public function action(){

      $this->redirectIfNotLogged();
      redirectIfHasNotTheRight('ADMIN');

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          if(isset($_POST['domains']) && isset($_POST['site_root']) && isset($_POST['IPSqlServer']) && isset($_POST['PortSqlServer']) && isset($_POST['user']) && isset($_POST['dbpassword']) && isset($_POST['dbname'])){
            if(!empty($_POST['domains']) && !empty($_POST['site_root']) && !empty($_POST['IPSqlServer']) && !empty($_POST['PortSqlServer']) && !empty($_POST['user']) && !empty($_POST['dbpassword']) && !empty($_POST['dbname'])){

              /*if(serialize(explode(';', $_POST['domains'])) != DOMAINS || $_POST['site_root'] != SITEROOT){
                $config = array();
                $config['DOMAINS']      = 'serialize( array('.implode(',', explode(';', $_POST['domains'])).'))';
                $config['SITEROOT']     = $_POST['site_root'];
                writeConfArrayToFile($config, 'config/config.php');
              }*/

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
        }

        $template = $this->twig->loadTemplate('config.twig');
        echo $template->render(array('cur_user' => $_SESSION, 'hostname' => HOSTNAME, 'port' => PORT, 'dbname' => DBNAME, 'user' => DBUSER, 'password' => DBPASSWORD, 'domains' => implode(';', unserialize(DOMAINS))));
        exit;
    }
  }
?>
