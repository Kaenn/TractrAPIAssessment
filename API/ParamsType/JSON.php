<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Params Type JSON Class
 */
namespace API\ParamsType;

include_with_check(DOCUMENT_ROOT . '/API/ParamsType/BasicParamsType.php');

class JSON implements BasicParamsType{
	
	public static function validation($value)
	{
		json_decode($value);
		
		return (json_last_error() === JSON_ERROR_NONE);
	}
	
	public static function formatter($value)
	{
		return json_decode($value, true);
	}
}