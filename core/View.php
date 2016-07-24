<?php

/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 05.07.2016
 * Time: 22:08
 */

namespace Aplication\Core;

/**
 * Class View
 * @package Aplication\Core
 * @property $news
 * @property $article
 * @property $logs
 */

class View
{
	const PATH = __DIR__ . DS . '..' . DS . 'views' . DS;

	protected $file;
	protected $data=[];


	//magic methods for setting on fly custom properties for objects of this class
	public function __set($key, $value)
	{
		return $this->data[$key] = $value;
	}
	public function __get($key)
	{
		return $this->data[$key];
	}
	public function __isset($key)
	{
		return isset($this->data[$key]);
	}


	//Rendering the content that will be showed user
	protected function render($filename)
	{
		foreach ($this->data as $key => $value) {
			$$key = $value;
		}
		ob_start();
		$this->file = self::PATH . $filename;
		include self::PATH . 'template.php';
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}


	//display content that was rendering before
	public function display($filename)
	{
		echo $this->render($filename);
	}
}


