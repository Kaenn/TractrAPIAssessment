<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * File for add basic useful php function
 */

// Include a file with Exception if not exist
function include_with_check($filepath)
{
	if (
		((!defined('DEBUG_MODE') || !DEBUG_MODE) && !@include_once( $filepath )) || // Warning disable
		((defined('DEBUG_MODE') && DEBUG_MODE) && !include_once( $filepath )) // Warning enable
	){
		// Return an Internal Exception
		throw new \Exception('File not found - '.$filepath);
	}
}


/**
 * Catch Fatal error for log
 */
register_shutdown_function("fatal_handler");
function fatal_handler() 
{
	$errfile = "unknown file";
	$errstr = "shutdown";
	$errno = E_CORE_ERROR;
	$errline = 0;

	$error = error_get_last();
	$error_message = 'Undefined internal error';
	if( $error !== NULL){
		$errno = $error["type"];
		$errfile = $error["file"];
		$errline = $error["line"];
		$errstr = $error["message"];
		
		$error_message = 'Error : '.$errno.' - '.$errstr.', in file '.$errfile.' on line '.$errline;
		
		error_log($error_message);
	}
}