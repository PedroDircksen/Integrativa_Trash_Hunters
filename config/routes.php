<?php

/**
*
* Definição das rotas e seus respectivos controllers e actions
*
* @author Emprezaz.com
*
**/

// views routes
$commonRoutes = array(
	'/'				=> 'HomeController/menu',
	'game'			=> 'HomeController/game',

	'entrar'		=> 'LoginController/index',
	'cadastrar' 	=> 'RegisterController/index',
	'edit-profile' 	=> 'RegisterController/edit',


	// rotas do dashboard das lojas 
	'dashboard'		  				 	=> 'DashboardController/home',

	'dashboard/courses'					=> 'DashboardController/courses',

	'dashboard/users'					=> 'DashboardController/users',

	'dashboard/login'			 	 	=> 'LoginAdminController/login',
	'dashboard/recover-password'	 	=> 'RecoverController/index',

);

// api routes
$commonPost = array(
	'checkLoginAdm'						=> 'LoginAdminController/checkLoginAdm',
	'checkIdAdm'						=> 'LoginAdminController/checkIdAdm',
	'checkEmailAdm'				     	=> 'LoginAdminController/checkEmailAdm',
	'checkPasswordAdm'				 	=> 'LoginAdminController/checkPasswordAdm',
	'saveLogin'						 	=> 'LoginAdminController/saveLogin',
	'logoutAdmin'					 	=> 'LoginAdminController/logoutAdmin',
	'admin/sendRecover'				 	=> 'RecoverController/sendRecover',
	'recoverPasswordAdmin'			 	=> 'RecoverController/recover',
	
	// user
	'checkName'							=> 'LoginController/checkName',
	'checkLogin'				 		=> 'LoginController/checkLogin',
	'loginUser'					 	 	=> 'LoginController/loginUser',
	// 'saveLogin'						    => 'LoginController/saveLogin',
	'logoutUser'					 	=> 'LoginController/logoutUser',

	'checkEmail'				     	=> 'RegisterController/checkEmail',
	'registerUser'				     	=> 'RegisterController/registerUser',

	'saveCourse'						=> 'DashboardController/saveCourse',
	'deleteCourse'						=> 'DashboardController/deleteCourse',
	'addPoints'							=> 'DashboardController/addPoints',
	'passLevel'							=> 'DashboardController/passLevel',


);

return array_merge($commonRoutes, $commonPost);