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
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['userMail']) && !empty($_POST['userPass']) && !empty($_POST['mailDomain']) && !empty($_POST['siteRoot']) && !empty($_POST['sqlServer'])) {
      // On ecrit le fichier config.php
      file_put_contents('config/config.php', "<?php\n");
      file_put_contents('config/config.php', 'require("db.conf.php");'."\n", FILE_APPEND);
      file_put_contents('config/config.php', 'define("SITEROOT", "'.$_POST['siteRoot'].'");'."\n", FILE_APPEND);
      file_put_contents('config/config.php', '?>', FILE_APPEND);
      // On ecrit le fichier db.conf.php
      file_put_contents('config/db.conf.php', "<?php\n");
      file_put_contents('config/db.conf.php', 'define("HOSTNAME", "'.$_POST['sqlServer'].'");'."\n", FILE_APPEND);
      file_put_contents('config/db.conf.php', 'define("PORT", "'.$_POST['sqlPort'].'");'."\n", FILE_APPEND);
      file_put_contents('config/db.conf.php', 'define("DBUSER", "'.$_POST['sqlUser'].'");'."\n", FILE_APPEND);
      file_put_contents('config/db.conf.php', 'define("DBPASSWORD", "'.$_POST['sqlPassword'].'");'."\n", FILE_APPEND);
      file_put_contents('config/db.conf.php', 'define("DBNAME","'.$_POST['sqlDB'].'");'."\n", FILE_APPEND);
      file_put_contents('config/db.conf.php', '?>', FILE_APPEND);
      // On redirige
      header('Location: '.$_POST['siteRoot']);
      die();
    }
    else {
      echo('Vous devez renseigner tout les champs');
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
