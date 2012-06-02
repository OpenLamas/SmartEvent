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
  <h1>Bienvenue dans SmartEvent !</h1>
  <p>C'est sûrement la première fois que vous venez ici, pour commencer quelques informations sont nécessaires.</p>
  <form method="POST" action="#">
      <div class="control-group">
        <label for="input_mailDomain">Si vous le souhaitez vous pouvez restreindre l'utilisation du site via le domaine mail des utilisateur.<br />Pour celà entrez les domaines séparés par un point-virgule.</label>
        <div class="controls">
          <input type="text" id="input_mailDomain" value="etu.mon-univ.fr;" />
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input_siteRoot">Quel est le chemin absolu vers votre site ?</label>
        <div class="controls">
          <input type="text" id="input_siteRoot" value="monsite.com/events/" />
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input_sqlServer">Quel est l'adresse de votre serveur SQL ?</label>
        <div class="controls">
          <input type="text" id="input_sqlServer" value="127.0.0.1" />
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="input_sqlPort">Et quel est son port ?</label>
        <div class="controls">
          <input type="text" id="input_sqlPort" value="3380" />
        </div>
      </div>
    <div class="form-actions">
        <button type="submit">C'est tout bon !</button>
      </div>
  </form>
  </body>
</html>