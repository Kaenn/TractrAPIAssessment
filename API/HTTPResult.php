<?php
/**
 * @author Glenn Inizan <glenninizan@gmail.com>
 * 
 * Class for format the HTTPResult
 */
namespace API;

class HTTPResult{
	
	const OK 					= 200; // This response code indicates that the request was successful.
	const Created 				= 201; // This indicates the request was successful and a resource was created. It is used to confirm success of a PUT or POST request.
	const BadRequest 			= 400; // The request was malformed. This happens especially with POST and PUT requests, when the data does not pass validation, or is in the wrong format.
	const Unauthorized 			= 401; // This error indicates that you need to perform authentication before accessing the resource.
	const NotFound 				= 404; // This response indicates that the required resource could not be found. This is generally returned to all requests which point to a URL with no corresponding resource.
	const MethodNotAllowed 		= 405; // The HTTP method used is not supported for this resource.
	const Conflict 				= 409; // This indicates a conflict. For instance, you are using a PUT request to create the same resource twice.
	const InternalServerError	= 500; // When all else fails; generally, a 500 response is used when processing fails due to unanticipated circumstances on the server side, which causes the server to error out.
	
	private $result = null;
	private $http_code = null;
	
	function __construct($result, $http_code)
	{
		$this->result = $result;
		$this->http_code = $http_code;
	}
	
	public function getResult()
	{
		return $this->result;
	}
	
	public function getHTTPCode()
	{
		return $this->http_code;
	}
	
	/**
	 * Get the header of an HTTP code
	 * @param unknown $http_code
	 * @return string
	 */
	public static function getHeaderByHTTPCode($http_code)
	{
		$header = '';
		switch($http_code){
			case 100: $header = 'Continue'; break;
			case 101: $header = 'Switching Protocols'; break;
			case 200: $header = 'OK'; break;
			case 201: $header = 'Created'; break;
			case 202: $header = 'Accepted'; break;
			case 203: $header = 'Non-Authoritative Information'; break;
			case 204: $header = 'No Content'; break;
			case 205: $header = 'Reset Content'; break;
			case 206: $header = 'Partial Content'; break;
			case 300: $header = 'Multiple Choices'; break;
			case 301: $header = 'Moved Permanently'; break;
			case 302: $header = 'Moved Temporarily'; break;
			case 303: $header = 'See Other'; break;
			case 304: $header = 'Not Modified'; break;
			case 305: $header = 'Use Proxy'; break;
			case 400: $header = 'Bad Request'; break;
			case 401: $header = 'Unauthorized'; break;
			case 402: $header = 'Payment Required'; break;
			case 403: $header = 'Forbidden'; break;
			case 404: $header = 'Not Found'; break;
			case 405: $header = 'Method Not Allowed'; break;
			case 406: $header = 'Not Acceptable'; break;
			case 407: $header = 'Proxy Authentication Required'; break;
			case 408: $header = 'Request Time-out'; break;
			case 409: $header = 'Conflict'; break;
			case 410: $header = 'Gone'; break;
			case 411: $header = 'Length Required'; break;
			case 412: $header = 'Precondition Failed'; break;
			case 413: $header = 'Request Entity Too Large'; break;
			case 414: $header = 'Request-URI Too Large'; break;
			case 415: $header = 'Unsupported Media Type'; break;
			case 500: $header = 'Internal Server Error'; break;
			case 501: $header = 'Not Implemented'; break;
			case 502: $header = 'Bad Gateway'; break;
			case 503: $header = 'Service Unavailable'; break;
			case 504: $header = 'Gateway Time-out'; break;
			case 505: $header = 'HTTP Version not supported'; break;
			default : $header = 'Internal Server Error';
					  $http_code = 500;
					  break;
		}
	
		return 'HTTP/1.1 '.$http_code.' '.$header;
	}
}