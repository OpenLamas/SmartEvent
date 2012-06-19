<?php
  require_once 'Swift/lib/swift_required.php';

  class MailWrapper {

    protected $transport = NULL;

    public function __construct($smtp, $port, $auth, $username, $password) {
      $this->transport = Swift_SmtpTransport::newInstance($smtp, $port, $auth)
        ->setUsername($username)
        ->setPassword($password);
    }

    public function SendOneMail($from, $to, $subject, $message) {
      $mailer = Swift_Mailer::newInstance($this->transport);

      $message = Swift_Message::newInstance()
        ->setSubject($subject)
        ->setFrom(array("$from"))
        ->setTo(array("$to"))
        ->setBody($message);

      $result = $mailer->send($message);
      echo $result;
    }

    public function SendManyMail($from, array $to, $subject, $message) {
      $mailer = Swift_Mailer::newInstance($this->transport);

      $message = Swift_Message::newInstance()
        ->setSubject($subject)
        ->setFrom(array("$from"))
        ->setTo(array("$from"))
        ->setBcc($to)
        ->setBody($message);

      $result = $mailer->send($message);
      echo $result;
    }

  }
?>