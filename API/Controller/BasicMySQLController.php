<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Abstract Class for controler with MySQL request
 */
namespace API\Controller;

include_with_check(DOCUMENT_ROOT . '/API/DB/MySQLConnect.php');
include_with_check(DOCUMENT_ROOT . '/API/Exception/ExceptionHTTP.php');

use \API\DB\MySQLConnect;
use \API\Exception\ExceptionHTTP;

abstract class BasicMySQLController{
	protected $mysql = null;

	function __construct()
	{
		$this->mysql = new MySQLConnect();
	}

	/**
	 * Check if the MySQL is instanciate
	 * @throws ExceptionHTTP
	 * @todo check if mysql still run
	 */
	protected function checkDBInstanciate()
	{
		if($this->mysql === null)
			throw new ExceptionHTTP(\HTTPResult::InternalServerError, 'MySQL not instanciate');
	}
}