<?php
// simpan sebagai inc/mail_config.php
return [
  'host'     => 'smtp.yourhost.com',
  'username' => 'no-reply@ilhamakbar.com',
  'password' => '{Y,M-h86j5iA&?8j;P',
  'port'     => 587,
  // gunakan \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS atau ::ENCRYPTION_SMTPS
  'secure'   => \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS,
  'from'     => 'no-reply@ilhamakbar.com',
  'to'       => 'hi.ilhamakbar@gmail.com',
];
