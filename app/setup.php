<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>SmartEvent</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      body{
        font-family: sans-serif;
      }
      .control-group{
        margin-bottom: 10px;
      }
    </style>
  </head>
  <body>
  <?php
  require('helpers/configHelper.php');

  if(isset($_ENV['HEROKU_POSTGRESQL_GOLD_URL'])){ //Si l'addon postgre est dispo
    $config   = array();
    $configDB = array();

    $infoCo = preg_split("#[/:@]+#", $_ENV['HEROKU_POSTGRESQL_GOLD_URL']);

    $config['DOMAINS']      = "etu.mon-univ.fr;univ-mon.fr";
    $config['SITEROOT']     = "/app";
    $configDB['HOSTNAME']   = $infoCo[3];
    $configDB['PORT']       = $infoCo[4];
    $configDB['DBUSER']     = $infoCo[1];
    $configDB['DBPASSWORD'] = $infoCo[2];
    $configDB['DBNAME']     = $infoCo[5];

    writeConfArrayToFile($config, 'config/config.php');
    writeConfArrayToFile($configDB, 'config/db.conf.php');

    header('Location: '.$_POST['siteRoot']);
    die();
  }

  else{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if (!empty($_POST['userMail']) && !empty($_POST['userPass']) && !empty($_POST['mailDomain']) && !empty($_POST['siteRoot']) && !empty($_POST['sqlServer']) &&!empty($_POST['sqlPort']) && !empty($_POST['sqlUser']) && !empty($_POST['sqlPassword']) && !empty($_POST['sqlDB'])) {

        $config   = array();
        $configDB = array();

        $config['DOMAINS']      = $_POST['mailDomain'];
        $config['SITEROOT']     = $_POST['siteRoot'];
        $configDB['HOSTNAME']   = $_POST['sqlServer'];
        $configDB['PORT']       = $_POST['sqlPort'];
        $configDB['DBUSER']     = $_POST['sqlUser'];
        $configDB['DBPASSWORD'] = $_POST['sqlPassword'];
        $configDB['DBNAME']     = $_POST['sqlDB'];

        writeConfArrayToFile($config, 'config/config.php');
        writeConfArrayToFile($configDB, 'config/db.conf.php');

        // On crée la DB
        include('config/db.conf.php');
        $sql_create  = file_get_contents('sql/create.sql');
        $sql_default = file_get_contents('sql/default.sql');
        pg_connect('host='.HOSTNAME.' port='.PORT.' dbname='.DBNAME.' user='.DBUSER.' password='.DBPASSWORD);
        pg_query($sql_create);
        pg_query($sql_default);
        pg_close();

        // Puis on ajoute l'user
        require('dao/class_db_request.php');
        $user = array();
        $user['refDroit']          = '3';
        $user['nomUtilisateur']    = 'Admin';
        $user['prenomUtilisateur'] = 'Admin';
        $user['mailUtilisateur']   = $_POST['userMail'];
        $user['mdpUtilisateur']    = md5($_POST['userPass']);

        $dbUsers = new db_users();
        $dbUsers->addUser($user);

        header('Location: '.$_POST['siteRoot']);
        die();
      }
      else {
        echo('Vous devez renseigner tout les champs');
      }
    }
  }
  ?>
  <h1>Bienvenue dans SmartEvent !</h1>
  <p>C'est sûrement la première fois que vous venez ici, pour commencer quelques informations sont nécessaires.</p>
  <form method="POST" action="#">
      <div class='control-group'>
        <label for='input_userMail'>Veuillez entrez votre adresse email (ou celle de la personne qui administrera le site).</label>
        <div class='controls'>
          <input type='text' id='input_userMail' name='userMail' value='admin@admin.com' />
        </div>
      </div>
      <div class='control-group'>
        <label for='input_userPass'>Veuillez entrez un mot de passe.</label>
        <div class='controls'>
          <input type='password' id='input_userPass' name='userPass' value='1234' />
        </div>
      </div>
      <div class="control-group">
        <label for="input_mailDomain">Si vous le souhaitez vous pouvez restreindre l'utilisation du site via le domaine mail des utilisateur.<br />Pour celà entrez les domaines séparés par un point-virgule.</label>
        <div class="controls">
          <input type="text" id="input_mailDomain" name='mailDomain' value="etu.mon-univ.fr;" />
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input_siteRoot">Quel est le chemin absolu vers votre site ?</label>
        <div class="controls">
          <input type="text" id="input_siteRoot" name='siteRoot' value="/SmartEvent/app" />
          <p class="help-block">Par exemple pour http://www.google.fr/app/monApp/ => /app/monApp</p>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input_sqlServer">Quel est l'adresse de votre serveur SQL ?</label>
        <div class="controls">
          <input type="text" id="input_sqlServer" name='sqlServer' value="127.0.0.1" />
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input_sqlPort">Et quel est son port ?</label>
        <div class="controls">
          <input type="text" id="input_sqlPort" name='sqlPort' value="3380" />
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input_sqlUser">Utilisateur</label>
        <div class="controls">
          <input type="text" id="input_sqlUser" name='sqlUser' value="projetRT1" />
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input_sqlPassword">Mot de passe</label>
        <div class="controls">
          <input type="password" id="input_sqlPassword" name='sqlPassword' value="projetRT1" />
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input_sqlDB">BDD</label>
        <div class="controls">
          <input type="text" id="input_sqlDB" name='sqlDB' value="smartevent" />
        </div>
      </div>
    <div class="form-actions">
        <button type="submit">C'est tout bon !</button>
      </div>
  </form>
  </body>
</html>
