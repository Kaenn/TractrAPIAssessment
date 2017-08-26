<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Class for Exception need to be show in the return of request
 */
namespace API\Exception;

include_with_check(DOCUMENT_ROOT . '/API/Exception/ExceptionHTTP.php');

class ExceptionExternal extends ExceptionHTTP{
	
	public function getResult()
	{
		return [
			'Error' => true,
			'ErrorMessage' => $this->getMessage()
		];
	}
}