<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * This file is the unique input of the api
 * It redirect and resolve the request
 */

use \API\Exception\ExceptionHTTP;
use \API\HTTPResult;
use \API\Output;
use \API\Router;

try{
	try{
		DEFINE('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
		
		// Include the file with basic function if exist
		$basic_function_filename = DOCUMENT_ROOT.'/API/basic_function.php';
		if (! @include_once($basic_function_filename)){ // @ - to suppress warnings
			// Return an Internal Exception
			throw new \Exception('File not found - ' . $basic_function_filename);
		}
		
		include_with_check(DOCUMENT_ROOT . '/config/config.php');
		include_with_check(DOCUMENT_ROOT . '/API/Router.php');
		include_with_check(DOCUMENT_ROOT . '/API/Enum/HTTPMethod.php');
		include_with_check(DOCUMENT_ROOT . '/API/Exception/ExceptionHTTP.php');
		include_with_check(DOCUMENT_ROOT . '/API/Output.php');
		
		$params_raws = file_get_contents('php://input');
		$json_params = json_decode($params_raws, true);
		if($params_raws !== '' && json_last_error() !== JSON_ERROR_NONE)
			throw new ExceptionHTTP(HTTPResult::BadRequest);
		
		// Research the function class
		$function_class = Router::resolve($_SERVER['REQUEST_URI']);
		
		// Resolve the request
		$result = $function_class->resolve($_SERVER['REQUEST_METHOD'], $json_params, $_GET);
	}catch(ExceptionExternal $e){
		$result = new \HTTPResult($e->getResult(), $e->getHTTPCode());
	}catch(ExceptionHTTP $e){
		if(DEBUG_MODE)
			echo $e->getMessage();
		
		$result = new HTTPResult('', $e->getHTTPCode());
	}catch(Exception $e){
		$result = new HTTPResult('', HTTPResult::InternalServerError);
	}
	
	// Print the output
	Output::printResult($result);
}catch(Exception $e){
	ob_clean();
	header('HTTP/1.1 500 Internal Server Error');
	if(DEBUG_MODE)
		echo $e->getMessage();
	exit();
}