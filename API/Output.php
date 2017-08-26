<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Class for print the result of the request
 */
namespace API;

include_with_check(DOCUMENT_ROOT . '/API/HTTPResult.php');

class Output{
	
	public static function printResult(HTTPResult $result)
	{
		// Clean the output and add an error log if something in
		$previous_output = ob_get_clean();
		$debug = '';
		if($previous_output != '')
			error_log($previous_output);
		
		header(HTTPResult::getHeaderByHTTPCode($result->getHTTPCode()));
		
		$result = $result->getResult();
		if($result !== null && $result !== ""){
			if(DEBUG_MODE && $debug !== null && $debug !== '')
				$result['debug_output'] = $previous_output;
			header('Content-Type: application/json');
			echo json_encode($result);
		}
		exit();
	}
}