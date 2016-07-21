<?php

/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 04.07.2016
 * Time: 19:02
 */

class NewsModel
	extends AdminModel
{
	protected static $table = 'news';
	protected static $class = 'NewsModel';


//	//check the existance of news by title and text
//	public function existenceNewsCheck()
//	{
//		$sql = 'SELECT id FROM ' . static::$table . ' WHERE title=:title OR text=:text';
//
//		$db = new DB();
//		return $db->query($sql, [':title' => $this->title, ':text' =>$this->text]);
//	}
}