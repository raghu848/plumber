<?php
/*
 * Quote enquiry handler (home page and service-page quote forms).
 *
 * - Accepts POST only.
 * - Validates every field on the server (the browser checks are only a convenience).
 * - Verifies the Google reCAPTCHA v2 token (secret key is read from secrets.php, never from this file).
 * - Emails the enquiry as plain text. Customer details are not written to any log.
 * - Replies with JSON when called by the page script (fetch), or redirects to thankyou.php
 *   when the form was submitted without JavaScript.
 *
 * Optional setting in secrets.php:  'quote_to' => 'inbox@example.com.au'
 * (default recipient is the same inbox this script used before).
 */

define('QUOTE_PHONE_DISPLAY', '0433 629 517');
define('QUOTE_PHONE_LINK', '+61433629517');
define('QUOTE_DEFAULT_TO', 'admin@hydrolinkplumbing.com.au');
define('QUOTE_FROM', 'admin@hydrolinkplumbing.com.au');

function quote_wants_json()
{
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        return true;
    }
    return isset($_SERVER['HTTP_ACCEPT']) && stripos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false;
}

function quote_respond($ok, $message, $code = 200, $field = '')
{
    if (quote_wants_json()) {
        http_response_code($code);
        header('Content-Type: application/json; charset=utf-8');
        header('Cache-Control: no-store');
        echo json_encode(array('status' => (bool) $ok, 'message' => $message, 'field' => $field));
        exit;
    }
    if ($ok) {
        header('Location: thankyou.php');
        exit;
    }
    http_response_code($code);
    header('Content-Type: text/html; charset=utf-8');
    header('Cache-Control: no-store');
    $m = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    echo '<!doctype html><html lang="en-AU"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">'
        . '<meta name="robots" content="noindex"><title>Enquiry not sent | Hydrolink Plumbing</title>'
        . '<style>body{font-family:Inter,Arial,sans-serif;background:#f5f7fb;color:#25283a;margin:0;padding:48px 20px;text-align:center}'
        . 'main{max-width:560px;margin:0 auto}h1{color:#081739;font-size:26px}a.b{display:inline-block;margin:6px;padding:13px 24px;border-radius:4px;'
        . 'background:#1d88d0;color:#fff;font-weight:700;text-decoration:none}a.c{background:#1e7e34}</style></head><body><main>'
        . '<h1>Your enquiry was not sent</h1><p>' . $m . '</p>'
        . '<p><a class="b" href="javascript:history.back()">Go back to the form</a> '
        . '<a class="b c" href="tel:' . QUOTE_PHONE_LINK . '">Call ' . QUOTE_PHONE_DISPLAY . '</a></p></main></body></html>';
    exit;
}

/* Single-line text: no control characters (stops header injection), trimmed and length-limited. */
function quote_line($value, $max)
{
    $value = is_scalar($value) ? (string) $value : '';
    $value = preg_replace('/[\x00-\x1F\x7F]+/', ' ', $value);
    $value = trim(preg_replace('/\s{2,}/', ' ', $value));
    return function_exists('mb_substr') ? mb_substr($value, 0, $max, 'UTF-8') : substr($value, 0, $max);
}

/* Returns array(cleanData, errors) where errors is array(field => message). */
function quote_validate($post)
{
    $d = array(
        'name'    => quote_line(isset($post['name']) ? $post['name'] : '', 100),
        'email'   => quote_line(isset($post['email']) ? $post['email'] : '', 254),
        'phone'   => quote_line(isset($post['phone']) ? $post['phone'] : '', 30),
        'service' => quote_line(isset($post['service']) ? $post['service'] : '', 100),
        'suburb'  => quote_line(isset($post['suburb']) ? $post['suburb'] : (isset($post['address']) ? $post['address'] : ''), 100),
    );
    $e = array();
    if (strlen($d['name']) < 2) {
        $e['name'] = 'Please enter your name.';
    }
    if ($d['email'] === '' || !filter_var($d['email'], FILTER_VALIDATE_EMAIL)) {
        $e['email'] = 'Please enter a valid email address.';
    }
    $digits = preg_replace('/\D+/', '', $d['phone']);
    if (!preg_match('/^[0-9+()\s.-]+$/', $d['phone']) || strlen($digits) < 8 || strlen($digits) > 15) {
        $e['phone'] = 'Please enter a valid phone number.';
    }
    if ($d['service'] === '' || stripos($d['service'], 'select service') === 0) {
        $e['service'] = 'Please choose the service you need.';
    }
    if (strlen($d['suburb']) < 2) {
        $e['suburb'] = 'Please enter your suburb.';
    }
    return array($d, $e);
}

function quote_subject($d)
{
    return 'New website quote enquiry: ' . $d['service'];
}

function quote_build_mail($d, $page, $to)
{
    $subject = quote_subject($d);
    if (function_exists('mb_encode_mimeheader')) {
        $subject = mb_encode_mimeheader($subject, 'UTF-8', 'B', "\r\n");
    }
    $body = "A new quote enquiry was sent from the Hydrolink Plumbing website.\r\n\r\n"
        . 'Name:    ' . $d['name'] . "\r\n"
        . 'Phone:   ' . $d['phone'] . "\r\n"
        . 'Email:   ' . $d['email'] . "\r\n"
        . 'Service: ' . $d['service'] . "\r\n"
        . 'Suburb:  ' . $d['suburb'] . "\r\n"
        . ($page !== '' ? 'Sent from page: ' . $page . "\r\n" : '')
        . "\r\nReply to this email or call the customer back on the number above.\r\n";
    $replyName = preg_replace('/[^\p{L}\p{N} .\'-]+/u', '', $d['name']);
    $headers = 'From: Hydrolink Plumbing <' . QUOTE_FROM . ">\r\n"
        . 'Reply-To: ' . ($replyName !== '' ? '"' . $replyName . '" ' : '') . '<' . $d['email'] . ">\r\n"
        . "MIME-Version: 1.0\r\nContent-Type: text/plain; charset=UTF-8\r\nX-Mailer: Hydrolink-quote-form";
    return array($to, $subject, $body, $headers);
}

/*
 * Sends the email. If secrets.php defines smtp_host, the message goes through that authenticated SMTP
 * account (PHPMailer, already in /mail/vendor). Otherwise PHP mail() is used.
 * Authenticated SMTP is the better option for this domain: its SPF record only authorises Zoho, so mail
 * sent straight from the web server is likely to be filtered as spam.
 */
function quote_send($to, $subject, $body, $headers, $d, $page, $secrets)
{
    if (!empty($secrets['smtp_host']) && is_file(__DIR__ . '/mail/vendor/autoload.php')) {
        require_once __DIR__ . '/mail/vendor/autoload.php';
        try {
            $m = new \PHPMailer\PHPMailer\PHPMailer(true);
            $m->isSMTP();
            $m->Host = $secrets['smtp_host'];
            $m->Port = !empty($secrets['smtp_port']) ? (int) $secrets['smtp_port'] : 465;
            $m->SMTPAuth = true;
            $m->Username = isset($secrets['smtp_user']) ? $secrets['smtp_user'] : '';
            $m->Password = isset($secrets['smtp_pass']) ? $secrets['smtp_pass'] : '';
            $m->SMTPSecure = ($m->Port === 465) ? \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS : \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $m->Timeout = 10;
            $m->CharSet = 'UTF-8';
            $from = (!empty($secrets['smtp_from']) && filter_var($secrets['smtp_from'], FILTER_VALIDATE_EMAIL)) ? $secrets['smtp_from'] : QUOTE_FROM;
            $m->setFrom($from, 'Hydrolink Plumbing');
            $m->addAddress($to);
            $m->addReplyTo($d['email'], $d['name']);
            $m->isHTML(false);
            $m->Subject = quote_subject($d);
            $m->Body = $body;
            return $m->send();
        } catch (\Throwable $e) {
            error_log('slider-form.php: SMTP send failed');
            return false;
        }
    }
    return @mail($to, $subject, $body, $headers);
}

function quote_verify_captcha($token, $secret)
{
    $post = http_build_query(array('secret' => $secret, 'response' => $token, 'remoteip' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : ''));
    $raw = false;
    if (function_exists('curl_init')) {
        $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
        curl_setopt_array($ch, array(CURLOPT_POST => true, CURLOPT_POSTFIELDS => $post, CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 8, CURLOPT_SSL_VERIFYPEER => true));
        $raw = curl_exec($ch);
        curl_close($ch);
    } else {
        $ctx = stream_context_create(array('http' => array('method' => 'POST', 'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => $post, 'timeout' => 8)));
        $raw = @file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $ctx);
    }
    if ($raw === false || $raw === '') {
        return null; // could not reach Google
    }
    $r = json_decode($raw, true);
    return is_array($r) && !empty($r['success']);
}

if (!defined('QUOTE_HANDLER_LIB')) {
    if (!isset($_SERVER['REQUEST_METHOD']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Allow: POST');
        header('Location: /');
        exit;
    }
    // Hidden trap field: real visitors never fill it in. Pretend it worked so bots move on.
    if (!empty($_POST['website'])) {
        quote_respond(true, 'Thanks, your enquiry has been sent.');
    }
    if (session_status() === PHP_SESSION_NONE) {
        @session_start();
    }
    if (!empty($_SESSION['quote_last']) && time() - (int) $_SESSION['quote_last'] < 30) {
        quote_respond(false, 'Please wait a moment before sending another enquiry.', 429);
    }
    list($d, $errors) = quote_validate($_POST);
    if ($errors) {
        reset($errors);
        quote_respond(false, current($errors), 422, key($errors));
    }
    $token = isset($_POST['g-recaptcha-response']) ? (string) $_POST['g-recaptcha-response'] : '';
    if ($token === '') {
        quote_respond(false, 'Please tick the "I\'m not a robot" box and try again.', 422, 'captcha');
    }
    $secrets = is_file(__DIR__ . '/secrets.php') ? require __DIR__ . '/secrets.php' : array();
    if (empty($secrets['recaptcha_secret'])) {
        error_log('slider-form.php: recaptcha_secret is missing from secrets.php');
        quote_respond(false, 'Our enquiry form is temporarily unavailable. Please call us on ' . QUOTE_PHONE_DISPLAY . '.', 503);
    }
    $ok = quote_verify_captcha($token, $secrets['recaptcha_secret']);
    if ($ok === null) {
        quote_respond(false, 'We could not check the security box just now. Please try again, or call us on ' . QUOTE_PHONE_DISPLAY . '.', 503, 'captcha');
    }
    if (!$ok) {
        quote_respond(false, 'The security check did not pass. Please tick the box again and resend.', 422, 'captcha');
    }
    $to = (!empty($secrets['quote_to']) && filter_var($secrets['quote_to'], FILTER_VALIDATE_EMAIL)) ? $secrets['quote_to'] : QUOTE_DEFAULT_TO;
    $page = '';
    if (!empty($_SERVER['HTTP_REFERER'])) {
        $path = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
        $page = is_string($path) ? quote_line($path, 150) : '';
    }
    list($mto, $subject, $body, $headers) = quote_build_mail($d, $page, $to);
    if (!quote_send($mto, $subject, $body, $headers, $d, $page, $secrets)) {
        error_log('slider-form.php: the enquiry email could not be sent');
        quote_respond(false, 'Sorry, we could not send your enquiry just now. Please call us on ' . QUOTE_PHONE_DISPLAY . '.', 500);
    }
    $_SESSION['quote_last'] = time();
    $first = preg_split('/\s+/', $d['name']);
    quote_respond(true, 'Thanks ' . $first[0] . ', your enquiry has been sent. We will contact you as soon as we can.');
}
