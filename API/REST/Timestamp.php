<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Rest Function Class for get timestamp
 */
namespace API\REST;

include_with_check(DOCUMENT_ROOT . '/API/REST/BasicRESTFunction.php');
include_with_check(DOCUMENT_ROOT . '/API/Controller/DateController.php');

use \API\Enum\HTTPMethod;
use \API\Exception\ExceptionHTTP;
use \API\HTTPResult;

class Timestamp extends BasicRESTFunction{
	
	protected function getMethodNeed()
	{
		return HTTPMethod::GET;
	}
	
	protected function getParamsSpecification()
	{
		return [];
	}
	
	public function doAction()
	{
		$date_controller = new \API\Controller\DateController();
		
		$timestamp = $date_controller->getTimestamp();
		
		if(empty($timestamp))
			throw new ExceptionHTTP(HTTPResult::InternalServerError);
		
		return new HTTPResult(
			['Timestamp' => $timestamp],
			HTTPResult::OK
		);
	}
}