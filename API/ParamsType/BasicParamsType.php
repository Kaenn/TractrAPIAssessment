<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Abstract lcass for all parametres type usable in this Rest API
 */
namespace API\ParamsType;

interface BasicParamsType{
	
	/**
	 * Check if the value is in good format
	 * @param unknown $value
	 * @return boolean
	 */
	public static function validation($value);
	
	/**
	 * Return the value in good format
	 * @param unknown $value
	 * @return Mixed
	 */
	public static function formatter($value);
}