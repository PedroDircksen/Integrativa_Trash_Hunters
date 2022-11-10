<?php

/**
*
* Controller do site.
*
* @author Code Universe
*
**/
class LoginController extends Controller
{

	//home
	public function index()
	{		

		$this->setLayout(
			'site/login/layout.php',
			'Login - Trash Hunter',
			array(
				'assets/libs/bootstrap/css/bootstrap.min.css',
				'assets/libs/fontawesome-6.0/css/all.min.css',
				'assets/css/site/login.css',
			),
			array(
				'assets/libs/jquery/jquery.min.js',
				'assets/libs/bootstrap/js/bootstrap.min.js',
				'assets/libs/sweetalert2/dist/sweetalert2.all.min.js',
				'assets/js/site/login.js',
			)
		);
		
		$this->view('site/login/index.php');

	}

	// Verificando o login do adm
	public function checkName(){
		$name = addslashes($_POST['name']);
		
		$userData = new UserData;
		$check = $userData->checkName($name);

		echo json_encode(array(
			'result' => $check,
		));

	}
	// Verificando o email do adm
	public function checkEmail(){

		$email = addslashes($_POST['email']);

		$userData = new UserData;
		$result = $userData->checkEmail($email);

		echo json_encode(array(
			'result' => $result,
		));

	}
	
	// Verificando a senha do adm
	public function checkLogin(){

		$name = addslashes($_POST['name']);
		$password = $_POST['password'];

		$userData = new UserData;
		$result = $userData->checkLogin($name, $password);

		echo json_encode(array(
			'result' => $result,
		));

	}

	public function loginUser()
	{
		$name = mb_strtolower(addslashes($_POST['name']));
		$password = ($_POST['password']);

		$userData  = new UserData;
		$result = $userData->loginUser($name, $password);
		echo json_encode(array(
			'result'	=> $result,
		));
	}

	public function logoutUser()
	{
		$this->helpers['UserSession']->deleteUser();
		header('Location: ' . $this->helpers['URLHelper']->getURL('/'));
	}

}