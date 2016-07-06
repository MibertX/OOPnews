<?php

/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 05.07.2016
 * Time: 9:24
 */
class NewsController
{
    public function actionAll()
	{
		$view = new Views('all', 'All news', News::getAll());
		$view->display();
	}

	public function actionOne()
	{
		$id = $_GET['id'];
		$view = new Views('one', News::getOne($id));
		$view->display();
	}

	public function actionDelete()
	{
		$id = $_GET['id'];
		News::deleteOne($id);
		//
	}

	public function actionInsert($data)
	{
		News::insertOne($data);
		//
	}


}