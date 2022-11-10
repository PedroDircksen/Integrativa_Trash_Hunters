<?php

/**
*
* Controller do site.
*
* @author Code Universe
*
**/
class RegisterController extends Controller
{

	//home
	public function index()
	{		
		$coursesData = new CoursesData;
		$courses = $coursesData->getAllCourses();

		$this->setLayout(
			'site/login/layout.php',
			'Cadastrar - Trash Hunter',
			array(
				'assets/libs/bootstrap/css/bootstrap.min.css',
				'assets/libs/selectpicker/css/bootstrap.selectpicker.min.css',
				'assets/libs/fontawesome-6.0/css/all.min.css',
				'assets/css/site/login.css',
			),
			array(
				'assets/libs/jquery/jquery.min.js',
				'/assets/libs/bootstrap/js/bootstrap.bundle.min.js',
				'/assets/js/helpers/helpers.js',
				'assets/libs/selectpicker/js/bootstrap.selectpicker.min.js',
				'assets/libs/sweetalert2/dist/sweetalert2.all.min.js',
				'assets/js/site/register.js',
			)
		);
		
		$this->view('site/register/index.php',array(
			'courses' => $courses,
		));

	}

		//home
		public function editProfile($params)
		{		
	
			$this->setLayout(
				'site/login/layout.php',
				'Editar perfil - Trash Hunter',
				array(
					'assets/libs/bootstrap/css/bootstrap.min.css',
					'assets/libs/fontawesome-6.0/css/all.min.css',
					'assets/css/site/login.css',
				),
				array(
					'assets/libs/jquery/jquery.min.js',
					'assets/libs/bootstrap/js/bootstrap.min.js',
					'assets/libs/sweetalert2/dist/sweetalert2.all.min.js',
					'assets/js/site/register.js',
				)
			);
			
			$this->view('site/register/index.php');
	
		}

	public function checkEmail()
	{
		$email = $_POST['email'];
		$UserData = new UserData;
		$result = $UserData->checkEmail($email);

		if ($result && !$this->helpers['UserSession']->has()) {
			$result = true;
		}

		if ($result && $this->helpers['UserSession']->has() && $result['id'] == $this->helpers['UserSession']->get('id')) {
			$result = false;
		} else if ($result && $this->helpers['UserSession']->has() && $result['id'] != $this->helpers['UserSession']->get('id')) {
			$result = true;
		}


		echo json_encode(array(
			"result"    =>  $result,
		));
	}

	public function registerUser()
	{
		if(isset($_POST['name']) && $_POST['name'] != "" && isset($_POST['email']) && $_POST['email'] != "" && isset($_POST['course']) && $_POST['course'] != "" && isset($_POST['password']) && $_POST['password'] != ""){
			$name 		= $_POST['name'];
			$course 	= $_POST['course'];
			$email 		= $_POST['email'];
			$password 	= $_POST['password'];

			$userCrud = new UserCrud;
			$result   = $userCrud->register($name, $email, $course, $password);

			if($result){
				$resultScore = $userCrud->registerScore($result);
			}

			echo json_encode(array(
				'result' => $result,
			));
		}
	}

}