<?php

/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 04.07.2016
 * Time: 19:05
 */
class AbstractModel
{
	protected static $table;
	protected static $class;

	public static function actionGetAll()
	{
		$db = new DB();
		$sql = 'SELECT * FROM ' . static::$table;
		return $db->queryAll($sql, static::$class);
	}

	public static function actionGetOne($id)
	{
		$db = new DB();
		$sql = 'SELECT * FROM ' . static::$table . 'WHERE id=' . $id;
		return $db->queryOne($sql, static::$class);
	}
}