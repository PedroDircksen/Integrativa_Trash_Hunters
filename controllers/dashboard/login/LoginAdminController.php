<?php

/**
 * 
 * Controller do dashboard
 * 
 * @author Emprezaz
 * 
**/

class LoginAdminController extends Controller{

    // Página de login
    public function login(){

		$this->setLayout(
			'dashboard/login/layout.php',
			'Login Dashboard - Trash Hunters',
			array(
				'assets/libs/bootstrap/css/bootstrap.min.css',
				'assets/libs/fontawesome-6.0/css/all.min.css',
				'assets/css/dashboard/login.css',
			),
			array(
				'assets/libs/sweetalert2/dist/sweetalert2.all.min.js',
				'assets/js/dashboard/login.js',
			)
		);
		$this->view('dashboard/login/index.php');
	}
	
	// Verificando o login do adm
	public function checkLoginAdm(){
		$login = addslashes($_POST['login']);
		$check = new AdminData;
		$check = $check->checkLoginAdm($login);

		echo json_encode(array(
			'result' => $check,
		));

	}
	// Verificando o email do adm
	public function checkEmailAdm(){

		$email = addslashes($_POST['email']);

		$check = new AdminData;
		$check = $check->checkEmailAdm($email);

		echo json_encode(array(
			'result' => $check,
		));

	}
	
	public function checkIdAdm(){

		$id = $_POST['id'];

		$check = new AdminData;
		$check = $check->getDataById($id);

		echo json_encode(array(
			'result' => $check,
		));

	}

	// Verificando a senha do adm
	public function checkPasswordAdm(){

		$login = addslashes($_POST['login']);
		$password = addslashes($_POST['password']);

		$check = new AdminData;
		$check = $check->checkPasswordAdm($login, $password);

		echo json_encode(array(
			'result' => $check,
		));

	}

	// Criando a sessão
	public function saveLogin(){

		$login = addslashes($_POST['login']);

		$getData = new AdminData;
		$getData = $getData->getData($login);

		if($getData){
			$this->helpers['AdmSession']->save(array(
				'id'		=> $getData['id'],
				'username'  => $getData['name'],
			));
		}

		echo json_encode(array(
			'result'	=> $getData,
		));

	}

	// Logout adm
	public function logoutAdmin(){

		$this->helpers['AdmSession']->delete();
		header('Location: ' . $this->helpers['URLHelper']->getURL('/dashboard/login'));

	}

}