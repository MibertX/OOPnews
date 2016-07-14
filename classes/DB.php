<?php

/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 04.07.2016
 * Time: 15:23
 */
class DB
{
	protected $dbn;
	protected $className = 'stdClass';


	//connecting to database
	public function __construct()
	{
		$dsn = 'mysql:dbname=news_feed; host=localhost';
		$this->dbn = new PDO($dsn, 'root', '');
	}


	//setting a className that called method of this class
	public function setClassName($className)
	{
		$this->className = $className;
	}


	//prepare a sql query, make it, and than return a result(objects or false)
	public function query($sql, $params = [])
	{
		$sth = $this->dbn->prepare($sql);
		$sth->execute($params);
		return $sth->fetchAll(PDO::FETCH_CLASS, $this->className);
	}


	//prepare a sql query, and just return a boolean result of making it (true or false)
	public function exec($sql, $params = [])
	{
		$sth = $this->dbn->prepare($sql);
		return $sth->execute($params);
	}


	//returning id of the last inserted object
	public function lastInsertId()
	{
		return $this->dbh->lastInsertId();
	}
}