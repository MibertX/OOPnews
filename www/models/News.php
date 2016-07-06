<?php

/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 04.07.2016
 * Time: 19:02
 */
class News
	extends AbstractModel
{
	protected static $table = 'news';
	protected static $class = 'News';

	public $source;
	public $title;
	public $text;
	public $date;

	public static function actionInsert($array_data)
	{
		$db = new DB;
		$sql = "
			INSERT INTO " . static::$table .
			    "(source, date, title, text)
			VALUES
			    ('" . $array_data['source'] ."', '". $array_data['date'] . "', '" . $array_data['title'] . "',
			        '" . $array_data['text'] ."')";
		return $db->exec($sql);
	}

	public static function actionDelete($id)
	{
		$db = new DB();
		$sql = 'DELETE * FROM ' . static::$table . 'WHERE id=' . $id;
		return $db->exec($sql);
	}

}