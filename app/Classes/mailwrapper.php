<?php
  require ('simple_mail.php');

  class MailWrapper {

    protected $mailer = NULL;

    public function __construct($sender)
    {
      $this->mailer = new Simple_Mail(TRUE);
      $this->mailer->setFrom($sender, 'localhost.local');
      $this->mailer->addMailHeader('Reply-To', $sender, 'localhost.local');
    }

    public function SendOneMail($dest, $subject, $message) {
      $this->mailer->setTo($dest, $dest);
      $this->mailer->addGenericHeader('X-Mailer', 'PHP/' . phpversion());
      $this->mailer->addGenericHeader('Content-Type', 'text/html; charset="utf-8"');
      $thus->mailer->setSubject($subject);
      $this->mailer->setMessage($message);
      $this->mailer->setWrap(100);
      return $this->mailer->send();
    }

    public function SendManyMail(array $dest, $subject, $message) {

    }

  }
?>