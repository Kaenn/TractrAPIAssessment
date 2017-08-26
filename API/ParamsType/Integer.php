<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Params Type Integer Class
 */
namespace API\ParamsType;

include_with_check(DOCUMENT_ROOT . '/API/ParamsType/BasicParamsType.php');

class Integer implements BasicParamsType{
	
	public static function validation($value)
	{
		return filter_var($value, FILTER_VALIDATE_INT) !== FALSE;
	}
	
	public static function formatter($value)
	{
		return intval($value);
	}
}