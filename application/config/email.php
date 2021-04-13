<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* Local email */
$config = array(
    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'globalmuperu.com', 
    'smtp_port' => 465,
    'smtp_user' => 'test@globalmuperu.com',
    'smtp_pass' => '^K85zof7',
    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
    'mailtype' => 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
);

/* Server email */
/*$config = array(
    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'amtic.pe', 
    'smtp_port' => 465,
    'smtp_user' => 'rgomez.devop@amtic.pe',
    'smtp_pass' => 'sq6mxLyN6O',
    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
    'mailtype' => 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
);*/