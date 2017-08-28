<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Rest Function Class for get one video 
 */
namespace API\REST;

include_with_check(DOCUMENT_ROOT . '/API/REST/BasicRESTFunction.php');
include_with_check(DOCUMENT_ROOT . '/API/Controller/VideosController.php');
include_with_check(DOCUMENT_ROOT . '/API/ParamsType/StringP.php');

use \API\Enum\HTTPMethod;
use \API\Exception\ExceptionHTTP;
use \API\HTTPResult;

class GetVideo extends BasicRESTFunction{
	
	protected function getMethodNeed()
	{
		return HTTPMethod::GET;
	}
	
	protected function getParamsSpecification()
	{
		return [
			'id' => \API\ParamsType\StringP::class
		];
	}
	
	public function doAction()
	{
		$videos_controller = new \API\Controller\VideosController();
		
		$video = $videos_controller->getVideo($this->params['id']);
		
		if(empty($video))
			throw new ExceptionHTTP(HTTPResult::InternalServerError);
		
		return new HTTPResult(
			$video,
			HTTPResult::OK
		);
	}
}