<?php

/**
*
* Controller do site.
*
* @author Code Universe
*
**/
class HomeController extends Controller
{

	//home
	public function menu()
	{		
		if(	$this->helpers['UserSession']->has()){

		
			$this->setLayout(
				'site/shared/layout.php',
				'Trash Hunter',
				array(
					'assets/css/site/menu.css',
				),
				array(
					// 'assets/js/game/game.js'
				)
			);
			
			$this->view('site/menu/index.php');
		}else{
			header('LOCATION: '.$this->helpers['URLHelper']->getURL().'/entrar');
		}

	}

	public function game()
	{		
		if(	$this->helpers['UserSession']->has()){

			$this->setLayout(
				'site/shared/layout.php',
				'Trash Hunter',
				array(
					'assets/libs/bootstrap/css/bootstrap.min.css',
					'assets/libs/fontawesome-6.0/css/all.min.css',
					'assets/css/site/game.css',
				),
				array(
					'assets/libs/bootstrap/js/bootstrap.min.js',	
					'assets/js/site/game.js',
				)
			);
			
			$this->view('site/game/index.php');
		}else{
			header('LOCATION: '.$this->helpers['URLHelper']->getURL().'/entrar');
		}

	}

}