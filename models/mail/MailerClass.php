<?php

/**
 *
 * Classe para envio de e-mails anexando o documento de itens importados
 *
 * @author Vitor Paes
 * 
 **/
class MailerClass
{

	private $pdoQuery;
	private $pdoCrud;
	private $table;

	public function __construct()
	{
		$this->pdoQuery = new PDOQuery;
		$this->pdoCrud = new PDOCrud;
		$this->table = 'mail';
	}

	public function emailConstruct(array $destins, $subject, $text = null, $html = null, array $files = array(), $title = "")
	{

		// $senderData = $this->pdoQuery->fetch("SELECT * FROM system_config sc WHERE Status = 1");

		$info['sender'] = 'noreply@fishingbooking.com.br';
		$info['password'] = 'v_qY125d9';
		$info['reply'] = 'noreply@fishingbooking.com.br';
		$info['destins'] = $destins;
		if (!$info['destins'] || COUNT($info['destins']) == 0) {
			return false;
		}

		$title = $title == null ? "" : $title;

		$html = '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html>
			<HEAD>
				<TITLE>Emprezaz</TITLE>
				<META content="text/html; charset=ISO-8859-1" http-equiv=Content-Type>
				<META name=GENERATOR content="MSHTML 8.00.7600.16385">

				<style>
					a{
						color:#000;
						text-decoration:none;
					}
					a:hover,a:focus{
						color: #4c4c4c;
					}
					p {
						text-align: center;
						padding: 0 10px;
					}
					h1 {
						width: 100%;
						text-align: right;
						color: #fff;
						text-transform: uppercase;
					}

					.text {
						width: 90%;
					}

					@media (min-width: 768px) {
						.text {
							width: 50%;
						}
					}
				</style>
			</HEAD>
			<body style="background-color: #ececec;padding-bottom: 25px;">

				<div style="background-color: #00cacc;padding: 0 25px 0px 25px;border-radius: 0 0 25px 25px;height: 155px;display: flex;margin-bottom: 25px;">
					<img src="https://teste.fishingbooking.com.br/assets/img/logo.png" alt="Fishing Book" style="max-height: 100px;height: 100px;padding: 15px 20px;background-color: #fff; border-radius: 0 0 25px 25px;">
					' . $title . '
				</div>
				<center>
					<div class="text" style="margin-top: 0px;background-color: #fff;padding: 10px 0;border-radius: 25px;">
						' . $text . '
					</div>
				</center>
			</body>
				
		</html>';

		$content = array(
			'subject' 	=> $subject,
			'html'		=> $html,
			'attach'   	=> $files
		);

		return $this->send($info, $content);
	}

	private function send($info, $content)
	{
		$mail = new PHPMailer;

		$mail->IsSMTP(); // enable SMTP
		$mail->SMTPAuth = true; // authentication enabled
		$mail->Host = "177.10.89.81";
		$mail->Port = 587; // or 587
		$mail->IsHTML(true);
		$mail->SMTPOptions = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			)
		);
		// $mail->isSMTP();
		// $mail->Host = 'servidor.hostgator.com.br';
		// $mail->SMTPAuth = true;

		$mail->Username = $info['sender'];
		$mail->Password = $info['password'];
		$mail->charSet 		= 'utf-8';
		$mail->Encoding 	= 'base64';

		$mail->From = $info['sender'];
		$mail->FromName = utf8_decode("Fishing Booking");
		$mail->addReplyTo($info['reply']);

		//adicionando destinos
		foreach ($info['destins'] as $key => $destin) {
			$mail->addAddress($destin);
		}

		//adicionando anexos
		if (count($content['attach']) > 0) {

			$attachment = $content['attach'];
			foreach ($attachment['tmp_name'] as $key => $file) {
				if ($attachment['error'][$key] == 0)
					$mail->AddAttachment($file, $attachment['name'][$key], 'base64', $attachment['type'][$key]);
			}
		}

		$mail->Subject = utf8_decode($content['subject']);
		$mail->IsHTML(true);
		$mail->Body = utf8_decode($content['html']);

		// if (!$mail->Send()) {
		//     echo "Message could not be sent. 
		//       ";
		//     echo "Mailer Error: " . $mail->ErrorInfo;
		//     exit;
		//  }

		//  echo "Message has been sent";
		//  die;

		// return $result;
		if ($mail->send()) {
			return true;
		} else {
			return false;
		}
	}
}
