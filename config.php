<?php
/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 05.07.2016
 * Time: 19:34
 */

ini_set('default_charset','UTF-8');
define('DS', DIRECTORY_SEPARATOR);


//$mail_config = [];
$mail_config['from_name']     = null;
$mail_config['from_email']    = null;
$mail_config['smtp_mode']     = 'disabled';
$mail_config['smtp_host']     = 'smtp.gmail.com';
$mail_config['smtp_secure']   = 'ssl';
$mail_config['smtp_port']     = 465;
$mail_config['smtp_user']     = 'SomeEmail';
$mail_config['smtp_password'] = 'SomePass';

