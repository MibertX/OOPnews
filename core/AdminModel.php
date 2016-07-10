<?php

/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 04.07.2016
 * Time: 19:05
 */

abstract class AdminModel
{
	protected static $table;
	protected static $class;
	protected $data;


	//magic methods for setting on fly custom properties for objects of this class
	public function __set($key, $value)
	{
		return $this->data[$key] = $value;
	}
	public function __get($key)
	{
		return $this->data[$key];
	}


	//Get all elements from DB
	public static function findAll()
	{
		$sql = 'SELECT * FROM ' . static::$table;

		$db = new DB();
		$db->setClassName(get_called_class());

		return $db->query($sql);
	}


	//Get one elements by id from DB
	public static function findOneByPk($id)
	{
		$sql = 'SELECT * FROM ' . static::$table . ' WHERE id=:id';

		$db = new DB();
		$db->setClassName(get_called_class());

		return $db->query($sql, [':id' => $id])[0];    // returning only first element of the array
	}


	//Get one element by column
	public static function findByColumn($field, $value)
	{
		$sql = 'SELECT * FROM ' . static::$table . ' WHERE ' . $field .'=:' . $field;
		var_dump($sql);

		$db = new DB();
		$db->setClassName(get_called_class());

		return $db->query($sql, [':'. $field => $value]);    // returning only first element of the array
	}


	//Inserting the element into the db
	public function insert()
	{
		$cols = array_keys($this->data);    //get an array of keys, which belong another array  ($this->data)

		$data = [];
		foreach ($cols as $col) {
			$data[':' . $col] =  $this->data[$col];    //the same as array $cols, "кроме" that before keys is ':'
		}

		$sql = '
			INSERT INTO ' . static::$table . '
			(' . implode(', ', $cols) . ')
			VALUES
			(' . implode(', ', array_keys($data)) . ')
		';

		$db = new DB();
		$db->setClassName(get_called_class());    //The name of every classModel that extend this AdminModel
		return $db->exec($sql, $data);
	}


	//updating the element
	public function update($id, $updates)
	{
		$current_news = static::findOneByPk($id);    //get the element that need to be updated

		$params = [];    //array with parameters for making sql query
		$params[':id'] = $id;
		$ins=[];    //array for inserts in sql query while preparing
		$updates_keys = array_keys($updates);

		foreach($updates_keys as $property) {
			if ($current_news->data[$property] == $updates[$property]) {
				continue;
			}
			$params[':' . $property] =  $updates[$property];
			$ins[] = $property . " =:" . $property;
		}

		if (!isset($ins) or empty($ins)) {    //if true - there is no need in sql query
			echo'false';//test'
			return false;
		}

		$sql = "UPDATE " . static::$table .
			   " SET " . implode(', ', $ins) .
			   " WHERE id=:id";

		$db = new DB();
		$db->setClassName(get_called_class());
		return $db->exec($sql, $params);
	}


	//delete the element
	public function delete($id)
	{
		$sql = ' DELETE FROM ' . static::$table . ' WHERE id=:id';

		$db = new DB;
		$db->setClassName(get_called_class());
		return $db->exec($sql, [':id'=>$id]);
	}
}