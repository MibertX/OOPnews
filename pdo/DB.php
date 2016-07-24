<?php

/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 04.07.2016
 * Time: 15:23
 */

namespace Aplication\PDO;
use Aplication\Exceptions\DB\Connect;
use Aplication\Exceptions\DB\WrongRequest;

//Integrated PHP classes
use PDO;
use PDOException;

class DB
{
	protected $dbn;
	protected $className = 'stdClass';


	//connecting to database
	public function __construct()
	{
		try {
			$opt = array(
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
			
			$dsn = 'mysql:dbname=news_feed; host=localhost;charset=UTF8';
			$this->dbn = new PDO($dsn, 'root', '', $opt);
		}
		catch (PDOException $e) {    //throw exception if can not connect to DB
			throw new Connect($e->getMessage(), $e->getCode(), $e);
		}
	}


	//setting a className that called method of this class
	public function setClassName($className)
	{
		$this->className = $className;
	}


	//prepare a sql query, make it, and than return the object(s) or throw exception
	public function query($sql, $params = [])
	{
		$sth = $this->dbn->prepare($sql);
		
		try {
			$sth->execute($params);
			return $sth->fetchAll(PDO::FETCH_CLASS, $this->className);
		}
		catch (PDOException $e) {
			throw new WrongRequest(null, null, $e);
		}
	}


	//prepare a sql query, make it, return true or throw exception
	public function exec($sql, $params = [])
	{
		$sth = $this->dbn->prepare($sql);
		
		try {
			return $sth->execute($params);
		} 
		catch (PDOException $e) {
			throw new WrongRequest(null, null, $e);
		}
	}


	//returning id of the last inserted object
	public function lastInsertId()
	{
		return $this->dbn->lastInsertId();
	}
}