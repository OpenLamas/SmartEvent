<?php
  require_once '../Swift/lib/swift_required.php';

  class MailWrapper {

    public function __construct() {

    }

    public function SendOneMail($from, $to, $subject, $message) {
      $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
        ->setUsername('...')
        ->setPassword("...");

      $mailer = Swift_Mailer::newInstance($transport);

      $message = Swift_Message::newInstance()
        ->setSubject($subject)
        ->setFrom(array("$from" => "$from"))
        ->setTo(array("$to" => "$to"))
        ->setBody($message);

      echo var_dump($transport);
      $result = $mailer->send($message);
      echo $result;
    }

    public function SendManyMail(array $dest, $subject, $message) {

    }

  }
?>