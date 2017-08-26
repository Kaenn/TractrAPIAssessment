<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * MySQL connection Class
 */
namespace API\DB;

include_with_check(DOCUMENT_ROOT . '/API/Exception/ExceptionHTTP.php');
include_with_check(DOCUMENT_ROOT . '/API/HTTPResult.php');

use \API\Exception\ExceptionHTTP;
use \API\HTTPResult;

class MySQLConnect extends \PDO{
	
	function __construct()
	{
		try{
			parent::__construct(
				'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_NAME . ';charset=utf8', 
				MYSQL_USER, MYSQL_PASS, 
				[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
			);
		}catch(\Excetpion $e){
			throw new ExceptionHTTP(HTTPResult::InternalServerError, 'Can\'t connect to MySQL');
		}
	}
}