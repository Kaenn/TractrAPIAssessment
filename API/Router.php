<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Class for redirect request to the good REST function
 */
namespace API;

include_with_check(DOCUMENT_ROOT . '/API/Exception/ExceptionHTTP.php');

use \API\Exception\ExceptionHTTP;

class Router{
	
	public static function resolve($request_url)
	{
		$function_filename = realpath(DOCUMENT_ROOT . '/API/REST' . $request_url . '.php');
		
		// Check if file
		//		- exist
		//  	- is a file
		// 		- is realy in REST directory (for security)
		if(!file_exists($function_filename) || is_dir($function_filename) || strpos($function_filename, DOCUMENT_ROOT.'/API/REST/') !== 0)
			throw new ExceptionHTTP(404);
		
		include_with_check($function_filename);
		
		// Get Classname and add namespace
		$function_filename_explode = explode('/', $request_url);
		$function_classname = '\\API\\REST\\' . array_pop($function_filename_explode);
		
		return new $function_classname();
	}
}