<?php

/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 05.07.2016
 * Time: 9:24
 */
class NewsController
{
	//display all news
    public function actionAll()
	{
		$view = new Views();
		$view->news = NewsModel::getAll();
		$view->display('news/all.php');
	}


	//display one news got by id from DB
	public function actionOne()
	{
		$id = $_GET['id'];
		$view = new Views();
		$view->one_news = NewsModel::getOne($id);
		$view->display('news/one.php');
	}




	//all this will be updated with PDO
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