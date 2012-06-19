<?php
  require 'mailwrapper.php';

  $mailer = new MailWrapper('smtp.gmail.com', 465, 'ssl', '...', '...');
  $mailer->SendOneMail("mouchet.max@gmail.com", "mouchet.max@gmail.com", "SmartEvent", "Coucou");
?>