<?php

/**
*
* Arquivo onde são definidos os helpers
*
* @author Emprezaz.com
*
**/

define('LOCAL_URL', '/trashunters/');

return array(
	'URLHelper' => new URLHelper(),
	'date'      => new DateConverter(),
	'AdmSession'		=> new AdmSession,
	'UserSession'		=> new UserSession,
	'DateConverter'		=> new DateConverter,
);