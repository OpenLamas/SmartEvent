<?php
  require 'mailwrapper.php';

  $mailer = new MailWrapper('SERV', PORT, 'AUTH', 'USERNAME', 'PASSWORD');
  $mailer->SendOneMail("FROM", "TO", "SUBJECT", "MESSAGE");
?>