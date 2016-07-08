<?php

/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 04.07.2016
 * Time: 19:02
 */
class NewsModel extends AdminModel
{
	protected static $table = 'news';
	protected static $class = 'NewsModel';

	public $source;
	public $text;
	public $date;
	public $title;

	//inserting data into DB
	public static function insertOne($array_data)
	{
		$db = new DB;

		$sql = "
			INSERT INTO " . static::$table .
			    "(source, date, title, text)
			VALUES
			    ('" . $array_data['source'] ."',
			    	'". $array_data['date'] . "',
			    	'" . $array_data['title'] . "',
			        '" . $array_data['text'] ."')";

		return $db->exec($sql);
	}

	//delete data from DB
	public static function deleteOne($id)
	{
		$db = new DB();
		$sql = 'DELETE * FROM ' . static::$table . 'WHERE id=' . $id;
		return $db->exec($sql);
	}
}