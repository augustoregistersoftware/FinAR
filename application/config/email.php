<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['useragent'] = 'CodeIgniter';
$config['protocol'] = 'smtp';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_user'] = 'registersoftwaresistemas@gmail.com';
$config['smtp_pass'] = 'kvvjlpelztjybqwg';
$config['smtp_port'] = 587;
$config['smtp_timeout'] = 30;
$config['smtp_keepalive'] = TRUE;
$config['smtp_crypto'] = 'tls'; // Pode ser 'tls' ou 'ssl'
$config['wordwrap'] = TRUE;
$config['wrapchars'] = 76;
$config['mailtype'] = 'html'; // Pode ser 'text' ou 'html'
$config['charset'] = 'utf-8';
$config['validate'] = TRUE;
$config['priority'] = 3; // 1 = alta, 3 = normal, 5 = baixa
$config['crlf'] = "\r\n";
$config['newline'] = "\r\n";
$config['bcc_batch_mode'] = FALSE;
$config['bcc_batch_size'] = 200;
