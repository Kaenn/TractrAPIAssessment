<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Abstract Class for all Rest function
 */
namespace API\REST;

include_with_check(DOCUMENT_ROOT . '/API/HTTPResult.php');
include_with_check(DOCUMENT_ROOT . '/API/Enum/HTTPMethod.php');
include_with_check(DOCUMENT_ROOT . '/API/Exception/ExceptionHTTP.php');

use \API\Exception\ExceptionHTTP;
use \API\HTTPResult;

abstract class BasicRESTFunction{
	
	protected $params = null;
	
	/**
	 * Launch the action of this Rest function
	 */
	abstract protected function doAction();
	
	/**
	 * Get the Method expected for this Rest function
	 * @return HTTPMethod
	 */
	abstract protected function getMethodNeed();
	
	/**
	 * Get the Parametres Specification (the type of the parametres) expected for this Rest function
	 * @return array
	 */
	abstract protected function getParamsSpecification();
	
	/**
	 * Resolve the request
	 * @param unknown $http_method The request method
	 * @param unknown $params Parametres receive in the request
	 * @throws ExceptionHTTP
	 * @return unknown
	 */
	public function resolve($http_method,$params)
	{
		if(!$this->requestRespectMethod($http_method))
			throw new ExceptionHTTP(405);
		
		$this->params = $params;
		// Sanitize not necessary params 
		$this->sanitizeParams();
		
		// Validate the params format
		if(!$this->paramsValidation())
			throw new ExceptionHTTP(HTTPResult::BadRequest);
		
		// Get the params in good format
		$this->paramsFormatter();

		return $this->doAction();
	}
	
	/**
	 * Check if the request use the expected method
	 * @param unknown $http_method
	 * @return boolean
	 */
	private function requestRespectMethod($http_method)
	{
		return ($http_method === $this->getMethodNeed());
	}
	
	/**
	 * Check if the request has the expected parametres and types
	 * @return boolean
	 */
	private function paramsValidation()
	{
		$params_specification = $this->getParamsSpecification();
		
		$validation = true;
		foreach($params_specification as $name => $validator){
			// Check if the param
			// 				- is in request
			// 				- have the good format
			if(!isset($this->params[$name]) || !$validator::validation($this->params[$name]))
				$validation = false;
		}
		
		return $validation;
	}
	
	/**
	 * Format the parametres in function of his type
	 */
	private function paramsFormatter()
	{
		$params_specification = $this->getParamsSpecification();
	
		foreach($params_specification as $name => $validator){
			// Get the param in good format
			$this->params[$name] = $validator::formatter($this->params[$name]);
		}
	}
	
	
	/**
	 * Sanitize all parametres not expected
	 * Security rules - Please don't remove
	 */
	public function sanitizeParams()
	{
		$params_specification = $this->getParamsSpecification();
		
		if(!empty($this->param)){
			foreach($this->params as $name => $value){
				if(!isset($params_specification[$name]))
					unset($this->params[$name]);
			}
		}
	}
}