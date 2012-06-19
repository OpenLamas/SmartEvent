<?php
  require 'mailwrapper.php';

  $mailer = new MailWrapper();
  $mailer->SendOneMail("mouchet.max@gmail.com", "mouchet.max@gmail.com", "SmartEvent", "Coucou");
?>