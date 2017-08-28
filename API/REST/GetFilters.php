<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Rest Function Class for get video filters
 */
namespace API\REST;

include_with_check(DOCUMENT_ROOT . '/API/REST/BasicRESTFunction.php');
include_with_check(DOCUMENT_ROOT . '/API/Controller/VideosController.php');

use \API\Enum\HTTPMethod;
use \API\Exception\ExceptionHTTP;
use \API\HTTPResult;

class GetFilters extends BasicRESTFunction{
	
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
		$videos_controller = new \API\Controller\VideosController();
		
		$filters = $videos_controller->getFilters();
		
		if(empty($filters))
			throw new ExceptionHTTP(HTTPResult::InternalServerError);
		
		return new HTTPResult(
			$filters,
			HTTPResult::OK
		);
	}
}