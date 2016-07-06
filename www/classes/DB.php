<?php

/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 04.07.2016
 * Time: 15:23
 */
class DB
{
	//connecting to database, all data can be set by constructor
	public function __construct($database='news_feed', $host='localhost', $login='root', $pass='')
	{
		$link = mysql_connect($host, $login, $pass);
		if (!$link) {
			die('ERROR: cannot connect to database');
		}

		$selected_db = mysql_select_db($database);
		if (!$selected_db) {
			die('ERROR: selected database does not exists');
		}
	}

    // Make a request to database and get a result as an array of objects or (bool)false
	public function queryAll($sql, $class='stdClass')
	{
		$res = mysql_query($sql);
		if(false === $res) {
			return false;
		}

		$items=[];
		while ($item = mysql_fetch_object($res, $class)) {
			$items[] = $item;
		}
		return $items;
	}

	// Get only one object by id
	public function queryOne($sql, $class='stdClass')
	{
		return $this->queryAll($sql, $class)[0];
	}

	// Just make a request and return a boolean result(for INSERT and DELETE requests)
	public function exec($sql)
	{
		return $res = mysql_query($sql);
	}
}

$test = new DB('news_feed');
