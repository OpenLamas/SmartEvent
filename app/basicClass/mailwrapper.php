<?php
  require_once '../Swift/lib/swift_required.php';

  class MailWrapper {

    public function __construct() {

    }

    public function SendOneMail($from, $to, $subject, $message) {
      $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'tls')
        ->setUsername('mouchet.max@gmail.com')
        ->setPassword("@v9#\$bb25x5h'7dmseg@\\n");

      $mailer = Swift_Mailer::newInstance($transport);

      $message = Swift_Message::newInstance()
        ->setSubject($subject)
        ->setFrom(array('mouchet.max@gmail.com' => 'Maxime Mouchet'))
        ->setTo(array("$to" => "aa"))
        ->setBody($message);

      echo var_dump($transport);
      $result = $mailer->send($message);
      echo $result;
    }

    public function SendManyMail(array $dest, $subject, $message) {

    }

  }
?>