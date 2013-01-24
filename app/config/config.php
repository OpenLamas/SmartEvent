<?php
  require 'db.conf.php';

  define("DOMAINS", serialize( array('etu.univ-savoie.fr', 'univ-savoie.fr')));
  define("SITEROOT", "/SmartEvent/app");

  /* DATABASE */
  //define("HOSTNAME", "");
  //define("PORT", "5432");
  //define("DBUSER", "projetRT1");
  //define("DBPASSWORD", "projetRT1");
  //define("DBNAME", "smartevent");

  /* MAIL */
  define("SERV_SMTP", "");
  define("PORT_SMTP", "");
  define("AUTH_SMTP", ""); // TLS ou SSL (a2enmod ssl)
  define("USERNAME_SMTP", "");
  define("PASSWORD_SMTP", '');
  define("MAIL_FROM", "");
?>
