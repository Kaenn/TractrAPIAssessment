<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Rest Function Class for get all videos
 */
namespace API\REST;

include_with_check(DOCUMENT_ROOT . '/API/REST/BasicRESTFunction.php');
include_with_check(DOCUMENT_ROOT . '/API/Controller/VideosController.php');

use \API\Enum\HTTPMethod;
use \API\Exception\ExceptionHTTP;
use \API\HTTPResult;

class GetVideos extends BasicRESTFunction{
	
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
		
		$videos = $videos_controller->getVideos();
		
		if(empty($videos))
			throw new ExceptionHTTP(HTTPResult::InternalServerError);
		
		return new HTTPResult(
			$videos,
			HTTPResult::OK
		);
	}
}