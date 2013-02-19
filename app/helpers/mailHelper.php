<?php
  require_once 'vendor/swiftmailer/swiftmailer/lib/swift_required.php';
  require_once 'config/mail.conf.php';

  class MailHelper {

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

  $mailer = new MailHelper(SMTP_HOST, SMTP_PORT, SMTP_AUTH, SMTP_USER, SMTP_PASS);

  function SendOneMail($to, $subject, $message) {
    global $mailer;
    $mailer->SendOneMail(MAIL_FROM, $to, $subject, $message);
  }

  function SendManyMail(array $to, $subject, $message) {
    global $mailer;
    $mailer->SendManyMail(MAIL_FROM, $to, $subject, $message);
  }

  

?>
