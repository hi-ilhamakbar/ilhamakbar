<?php
declare(strict_types=1);
session_start();

// Hindari cache agar captcha tidak stale
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');

/* =========================
   Helpers
========================= */
function make_captcha(): array {
  // dua digit, hasil non-minus
  $a = random_int(1, 9);
  $b = random_int(1, 9);
  $useSub = (random_int(0,1) === 1) && ($a >= $b); // minus hanya jika a>=b
  return $useSub
    ? ['expr' => "$a - $b", 'answer' => $a - $b]
    : ['expr' => "$a + $b", 'answer' => $a + $b];
}
function field(string $k): string {
  return htmlspecialchars($_POST[$k] ?? '', ENT_QUOTES, 'UTF-8');
}

/* =========================
   Captcha init / regen
========================= */
if (isset($_GET['regen'])) {
  unset($_SESSION['captcha'], $_SESSION['captcha_token']);
}
if (!isset($_SESSION['captcha']['expr'])) {
  $_SESSION['captcha'] = make_captcha();
  $_SESSION['captcha_token'] = bin2hex(random_bytes(16)); // token terikat captcha
}

/* =========================
   Handle submit
========================= */
$ok=false; $err='';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name  = trim($_POST['name'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $msg   = trim($_POST['message'] ?? '');
  $ans   = trim($_POST['captcha'] ?? '');
  $token = trim($_POST['token'] ?? '');

  if ($name==='' || $email==='' || $msg==='' || $ans==='') {
    $err = 'Please fill all fields.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $err = 'Invalid email.';
  } elseif (!ctype_digit($ans)) {
    $err = 'Captcha must be numeric.';
  } elseif (!hash_equals($_SESSION['captcha_token'] ?? '', $token)) {
    $err = 'Security token expired. Please try again.';
  } else {
    $correct = (int)($_SESSION['captcha']['answer'] ?? -999);
    if ((int)$ans !== $correct) {
      $err = 'Captcha is incorrect.';
    }
  }

  if ($err === '') {
    $subject = 'Contact Form — ilhamakbar.com';
    $bodyTxt = "From: {$name} <{$email}>\n\nMessage:\n{$msg}\n\nIP: ".($_SERVER['REMOTE_ADDR'] ?? 'n/a');

    $sent = false; $mailErr = '';

    // Coba PHPMailer bila tersedia dan ada konfigurasi
    $phpmailer = __DIR__.'/vendors/phpmailer/src/PHPMailer.php';
    $cfgFile   = __DIR__.'/inc/mail_config.php'; // kamu isi sendiri (contoh di bawah)

    if (file_exists($phpmailer) && file_exists($cfgFile)) {
      try {
        require_once __DIR__.'/vendors/phpmailer/src/PHPMailer.php';
        require_once __DIR__.'/vendors/phpmailer/src/SMTP.php';
        require_once __DIR__.'/vendors/phpmailer/src/Exception.php';
        $cfg = require $cfgFile; // return [host,username,password,port,secure,from,to]

        $m = new PHPMailer\PHPMailer\PHPMailer(true);
        $m->isSMTP();
        $m->Host       = $cfg['host'];
        $m->SMTPAuth   = true;
        $m->Username   = $cfg['username'];
        $m->Password   = $cfg['password'];
        $m->SMTPSecure = $cfg['secure'] ?? PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $m->Port       = (int)($cfg['port'] ?? 587);
        $m->CharSet    = 'UTF-8';

        // Hindari problem TLS
        $m->SMTPAutoTLS = true;
        $m->SMTPOptions = ['ssl' => [
          'verify_peer'       => true,
          'verify_peer_name'  => true,
          'allow_self_signed' => false,
        ]];

        $from = $cfg['from'] ?? 'no-reply@ilhamakbar.com';
        $to   = $cfg['to']   ?? 'hi.ilhamakbar@gmail.com';

        $m->setFrom($from, 'Website Contact');
        $m->addAddress($to);
        $m->addReplyTo($email, $name);

        $m->Subject = $subject;
        $m->Body    = $bodyTxt;
        $m->AltBody = $bodyTxt;

        $sent = $m->send();
      } catch (Throwable $ex) {
        $mailErr = $ex->getMessage();
        $sent = false;
      }
    }

    // Fallback: PHP mail() bila PHPMailer tidak dipakai
    if (!$sent) {
      $sent = @mail('hi.ilhamakbar@gmail.com', $subject, $bodyTxt, "From: {$name} <{$email}>\r\n");
    }

    if ($sent) {
      $ok = true;
      // regenerate captcha untuk submit berikutnya
      unset($_SESSION['captcha'], $_SESSION['captcha_token']);
      $_SESSION['captcha'] = make_captcha();
      $_SESSION['captcha_token'] = bin2hex(random_bytes(16));
    } else {
      $err = 'Unable to send email at the moment.' . ($mailErr ? ' ['.htmlspecialchars($mailErr, ENT_QUOTES, 'UTF-8').']' : '');
    }
  }
}
?>
<?php include __DIR__.'/inc/header.php'; ?>
<section class="max-w-7xl mx-auto px-4 py-12">
  <h1 class="text-3xl font-bold mb-6">Contact</h1>

  <div class="grid md:grid-cols-2 gap-8">
    <div class="space-y-4">
      <div class="p-4 border rounded-xl">
        <div class="text-sm text-gray-500 mb-1">LinkedIn</div>
        <a href="https://www.linkedin.com/in/hi-ilhamakbar/" target="_blank" class="text-cyan-700 hover:underline">linkedin.com/in/hi-ilhamakbar</a>
      </div>
      <div class="p-4 border rounded-xl">
        <div class="text-sm text-gray-500 mb-1">Email</div>
        <a href="mailto:hi.ilhamakbar@gmail.com" class="text-cyan-700 hover:underline">hi.ilhamakbar@gmail.com</a>
      </div>
      <div class="p-4 border rounded-xl">
        <div class="text-sm text-gray-500 mb-1">WhatsApp</div>
        <a href="https://wa.me/66633824208" target="_blank" class="text-cyan-700 hover:underline">+66 633 824 208</a>
      </div>
    </div>

    <form method="post" class="space-y-4" autocomplete="off" novalidate>
      <?php if($ok): ?>
        <div class="p-3 border rounded text-green-700">Thanks! Message sent.</div>
      <?php elseif($err): ?>
        <div class="p-3 border rounded text-red-700"><?php echo $err; ?></div>
      <?php endif; ?>

      <input class="w-full border rounded-lg p-3" name="name" placeholder="Full Name" value="<?php echo field('name'); ?>" required>
      <input class="w-full border rounded-lg p-3" name="email" placeholder="Email" value="<?php echo field('email'); ?>" required>
      <textarea class="w-full border rounded-lg p-3" rows="6" name="message" placeholder="Message" required><?php echo field('message'); ?></textarea>

      <div class="flex items-center gap-3">
        <label class="text-gray-700">Solve:</label>
        <div class="px-3 py-2 border rounded bg-gray-50 font-semibold"><?php echo htmlspecialchars($_SESSION['captcha']['expr'] ?? ''); ?> =</div>
        <input class="border rounded p-2 w-24" name="captcha" inputmode="numeric" placeholder="?" required>
        <a class="text-sm text-cyan-700 hover:underline" href="?regen=1">Regenerate</a>
      </div>
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['captcha_token'] ?? ''); ?>">

      <button class="px-6 py-3 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg">Send</button>
    </form>
  </div>
</section>
<?php include __DIR__.'/inc/footer.php'; ?>
