<?php
/**
 * Created by PhpStorm.
 * User: Mibert
 * Date: 17.07.2016
 * Time: 21:42
 */

class ExceptHundler
{
	protected $message;
	protected $code;

	public function __construct($e)
	{
		switch (get_class($e)) {
			case ('DbConnectException'):
				$this->message = 'Can not connect to database.';
				$this->code = 403;
				break;
			case ('DbDeleteException'):
				$this->message = 'Can not delete data. Database error. Try please later.';
				$this->code = 403;
				break;
			case ('DbInsertException'):
				$this->message = 'Cat not insert new data. Database error. Try please later.';
				$this->code = 403;
				break;
			case ('DbUpdateException'):
				$this->message = 'Can not update selected data. Database error. Try please later.';
				$this->code = 403;
				break;
			case ('PageNotFoundException'):
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
}