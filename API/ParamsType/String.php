<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Params Type String Class
 */
namespace API\ParamsType;

include_with_check(DOCUMENT_ROOT . '/API/ParamsType/BasicParamsType.php');

class String implements BasicParamsType{
	
	public static function validation($value)
	{
		return !is_array($value);
	}
	
	public static function formatter($value)
	{
		return $value;
	}
}