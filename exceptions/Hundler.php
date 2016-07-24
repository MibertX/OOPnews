<?php
/**
 * Created by PhpStorm.
 * User: Mibert
 * Date: 17.07.2016
 * Time: 21:42
 */

namespace Aplication\Exceptions;

class Hundler
{
	protected $message;
	protected $code;
	protected $caught_except;

	public function __construct($e)
	{
		$this->caught_except = $e;
		
		//need to get a classname without namespaces, only filename of the class
		$exceptParts = explode('\\', get_class($e));
		$except_class = array_pop($exceptParts);    //the last element of exceptParts is the exception's filename
		
		//select message and code of error to show them user, cases is the filename of exception
		switch ($except_class) {
			case ('Connect'):
				$this->message = 'Can not connect to database.';
				$this->code = 403;
				break;

			case('WrongRequest'):
				$this->message = 'Some database error. Sorry, try please later';
				$this->code = 403;
				break;

			case('PageNotFound'):
				$this->message = 'Page not found. Maybe it was deleted.';
				$this->code = 404;
				break;

			case ('PDOException'):
				$this->message = 'Some database error. Try please later.';
				$this->code = 403;
				break;

			default:
				$this->message = 'Unexpected error. Try please later.';
				$this->code = 404;
				break;
		}
	}


	public function getCustomExceptMessage()
	{
		return $this->message;
	}


	public function getCustomExcaptCode()
	{
		return $this->code;
	}


	public function logExcept()
	{
		//create an array with data that need be loged
		$log_data = [];
		$log_data['file'] = $this->caught_except->getFile();
		$log_data['line'] = $this->caught_except->getLine();
		$log_data['trace'] = $this->caught_except->getTraceAsString();

		//need to save an original error code and message(for example - PDOException) if it exists
		if (!empty($this->caught_except->getCode())) {
			$log_data['code'] = $this->caught_except->getCode();
		}else {
			$log_data['code'] = $this->getCustomExcaptCode() . ' (custom)';
		}
		if (!empty($this->caught_except->getMessage()))  {
			$log_data['message'] = $this->caught_except->getMessage();
		}else {
			$log_data['message'] = $this->getCustomExceptMessage() . ' (custom)';
		}

		//create a string that will be loged from (array)$log_data, also this string include a date
		date_default_timezone_set('UTC+2');
		$str =
			//|#|-for separating logs in file
			PHP_EOL . '|#| !!! NEW EXCEPTION ' . date('\o\n d-m-Y \a\t h:i:s a') . PHP_EOL .
			'Message: ' . $log_data['message'] . PHP_EOL .
			'Code: ' . $log_data['code'] . PHP_EOL .
			'File: ' . $log_data['file'] . PHP_EOL .
			'Line: ' . $log_data['line'] . PHP_EOL .
			'Trace: ' . $log_data['trace'] . PHP_EOL;

		//log an exception
		file_put_contents ( __DIR__ . DS . '..' . DS . 'log.txt', $str . PHP_EOL, FILE_APPEND );
	}
}