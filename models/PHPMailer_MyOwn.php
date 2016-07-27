<?php
/**
 * Created by PhpStorm.
 * User: Mibert
 * Date: 25.07.2016
 * Time: 21:38
 */

namespace Aplication\Models;
use PHPMailer\PHPMailer\PHPMailer;


class PHPMailer_MyOwn
	extends PHPMailer

{
	public $From = null;
	public $FromName = null;
	public $Sender = null;

	public function configuration()
	{
		//configurate with $mail_config from config.php
		global $mail_config;

		if ($mail_config['smtp_mode'] == 'enabled')
		{
			$this->isSMTP();
			$this->Host       = $mail_config['smtp_host'];
			$this->SMTPAuth   = true;
			$this->SMTPSecure = $mail_config['smtp_secure'];
			$this->Port       = $mail_config['smtp_port'];
			$this->Username   = $mail_config['smtp_user'];
			$this->Password   = $mail_config['smtp_password'];
		}

		if (!$this->From) { $this->From = $mail_config['from_email']; }

		if(!$this->FromName) { $this->FromName = $mail_config['from_name']; }

		if(!$this->Sender) { $this->Sender = $mail_config['from_email']; }
		
	}
}