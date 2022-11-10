<?php

/**
 *
 * Controller do site.
 *
 * @author Emprezaz.com
 *
 **/
class RecoverController extends Controller
{
	// if ($this->helpers['AgeSession']->has()) {

	public function index($param)
	{
		$id = $param[1];
		$code = $param[0];

		$DashboardData = new AdminData;
		$check = $DashboardData->checkRecoverValidateAdm($id, $code);
		if ($check) {
			$this->setLayout(
				'dashboard/login/layout.php',
				'Recuperar Senha - FishingBooking',
				array(
					'assets/libs/bootstrap/css/bootstrap.min.css',
					'assets/libs/fontawesome-6.0/css/all.min.css',

					'assets/css/fonts.css',
					'assets/css/dashboard/style.css',
					'assets/css/dashboard/login.css',
				),
				array(
					'assets/libs/jquery/jquery.min.js',
					'assets/libs/jquery/jquery.mask.min.js',
					'assets/libs/jquery/jquery.maskMoney.min.js',
					'assets/libs/bootstrap/js/bootstrap.min.js',
					'assets/libs/sweetalert/dist/sweetalert2.all.min.js',
					'assets/js/helpers/helpers.js',
					'assets/js/dashboard/recover.js',
				)
			);
			$this->view('dashboard/login/recover.php', array('id' => $id));
		} else {
			header('LOCATION: ' . $this->helpers['URLHelper']->getURL() . '/dashboard/login');
		}
	}

	// Verificando o email do adm
	public function sendRecover()
	{
		$url = $this->helpers['URLHelper']->getURL();

		$email = addslashes($_POST['email']);

		$DashboardData = new AdminData;
		$check = $DashboardData->checkIdAdm($email);

		$code =  rand(1, 999999);

		$destin[] = $email;

		$link = "https://teste.fishingbooking.com.br/dashboard/recover-password/$code/$check[id]";
		$text = "
		<p>
			Clique no botão ou no link para recuperar a sua senha!
			
			<br><br>
			<div style='background-color:#00cacc;border-radius:15px;padding:10px 15px;text-align: center;margin: 0 5%;'>
				<a href='$link' style='text-decoration: none;color: #fff;'>CLIQUE AQUI PARA RECUPERAR A SENHA</a>
			</div>
			<br><br>
			
			Caso o botão não funcione, clique no link: <br>
			<a href='$link' style='text-decoration: none;color: #00cacc;'>$link</a>
		</p>";

		$mail = new MailerClass;
		$response = $mail->emailConstruct($destin, "Recuperação de Senha - Administrador", $text);

		$adminCrud = new AdminCrud;
		$response = $adminCrud->RecoverCodeUpdate($check["id"], $code);

		echo json_encode(array(
			'result' => $response,
		));
	}

	public function recover()
	{

		$id = $_POST['id'];
		$pass = $_POST['password'];

		$adminCrud = new AdminCrud;
		$response = $adminCrud->updatePassword($id, $pass);

		echo json_encode(array(
			'result' => $response,
		));
	}
}
