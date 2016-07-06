<?php

/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 05.07.2016
 * Time: 22:08
 */
class Views
{
	public $file;
	public $head_title;
	public $data;

	public function __construct($file, $head_title='News_Feed', $data = null)
	{
		$this->file = $file;
		$this->data = $data;
		if (isset($data->title)) {
			$this->head_title = $data->title;
		}else {
			$this->head_title = $head_title;
		}


	}

	public function display()
	{
		include __DIR__ . DS . 'template.php';
	}
}

