<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Controller for the Score action
 */
namespace API\Controller;

include_with_check(DOCUMENT_ROOT . '/API/Controller/BasicMySQLController.php');

class DateController{
	
	public function getTimestamp()
	{
		return time();
	}
}