<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Exception HTTP
 */
namespace API\Exception;

class ExceptionHTTP extends \Exception{
	
	private $http_code = null;
	
	function __construct($http_code, $message = '')
	{
		$this->http_code = $http_code;
		parent::__construct($message);
	}
	
	public function getHTTPCode()
	{
		return $this->http_code;
	}
}