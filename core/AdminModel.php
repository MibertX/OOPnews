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

		return $db->query($sql);    //returning an array of object or false
	}


	//Get one elements by id from DB
	public static function findOneByPk($id)
	{
		$sql = 'SELECT * FROM ' . static::$table . ' WHERE id=:id';

		$db = new DB();
		$db->setClassName(get_called_class());

		return $db->query($sql, [':id' => $id])[0];    //returning only first element of the array
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

		$params = [];
		foreach ($this->data as $key => $value) {
			$params[':' . $key] = $value;    //the same as array $this->data, except that before keys is a symbol ':'
		}

		$sql = '
			INSERT INTO ' . static::$table . '
			(' . implode(', ', $cols) . ')
			VALUES
			(' . implode(', ', array_keys($params)) . ')    /* the same as :$cols */    
		';

		$db = new DB();
		$db->setClassName(get_called_class());    //The name of every classModel that extend this AdminModel
		$result = $db->exec($sql, $params);

		if (true === $result) {
			$this->id = $db->lastInsertId();
		}

		return $result;
	}


	//updating the element
	public function update()
	{
		$current_news = static::findOneByPk($this->id);    //get the element that need to be updated

		$params = [];    //array with parameters for making sql query
		$params[':id'] = $this->id;
		$ins=[];    //array for inserts in sql query while preparing
		$updates_keys = array_keys($this->data);
		
		//compare current news with updated
		foreach($updates_keys as $property) {
			$property = trim($property);    //delete from both sides all spaces and tabulations
			
			if ($current_news->data[$property] == $this->data[$property]) {    //no need to resave the same data
				continue;
			}
			elseif (empty($this->data[$property])) {    //don't save an empty property
				continue;
			}
				
			$params[':' . $property] = $this->data[$property];
			$ins[] = $property . ' =:' . $property;
		}

		if (!isset($ins) or empty($ins)) {    //if true - there is no need in sql query
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
	public function delete()
	{
		$sql = ' DELETE FROM ' . static::$table . ' WHERE id=:id';

		$db = new DB;
		$db->setClassName(get_called_class());
		return $db->exec($sql, [':id'=>$this->id]);
	}
}