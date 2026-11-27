<?php
// Copy to secrets.php (gitignored) and fill in real values.
return [
  'recaptcha_v3_secret' => '',
  'recaptcha_secret'    => '',
  'smtp_user'           => '',
  'smtp_pass'           => '',
  // Optional settings for the quote form (slider-form.php):
  // 'quote_to'   => 'inbox@your-domain.com.au',   // where enquiries are delivered (default: admin@hydrolinkplumbing.com.au)
  // 'smtp_host'  => 'smtp.zoho.in',               // set this to send through your real mailbox instead of PHP mail()
  // 'smtp_port'  => 465,
  // 'smtp_from'  => 'admin@hydrolinkplumbing.com.au', // must be the mailbox that smtp_user logs in to
];
