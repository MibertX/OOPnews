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
		$view->news = NewsModel::findAll();
		$view->display('news/all.php');
}


	//display one news got by id from DB
	public function actionOne()
	{
		$id = $_GET['id'];
		$view = new Views();
		$view->one_news = NewsModel::findOneByPk($id);
		$view->display('news/one.php');
	}


	//display one news got by column from DB
	public function actionAllByColumn()
	{
		//without view now, its for search
		//$id = $_GET['id'];

		$field = 'source';
		$value = 'Mibert';
		$article = new NewsModel();
		$article->findByColumn($field, $value);

		//$view = new Views();
		//$view->one_news = NewsModel::findOneByPk($id);
		//$view->display('news/one.php');
	}


	//insert new article into
	public function actionInsert()
	{
		$article = new NewsModel();
		$article->title = 'PDO title';
		$article->text = 'PDO text';
		$article->source = 'PDO Mibert';
		$article->date = date('Y.m.d.');
		$article->insert();

		//message
		$view = new Views();
		$view->news = NewsModel::findAll();
		$view->display('news/all.php');
	}


	//update the news
	public function actionUpdate()
	{
		$id = $_GET['id'];

		$updates=[];
		$updates['title'] = 'Updated title 3';
		$updates['text'] = 'Updated text 2';
		$updates['date'] = 'Updated date 2';

		$news = new NewsModel();
		$news->update($id, $updates);

		$view = new Views();
		$view->news = NewsModel::findAll();
		$view->display('news/all.php');
	}


	//delete the news
	public function actionDelete()
	{
		$id = $_GET['id'];

		$news = new NewsModel();
		$news->delete($id);

		$view = new Views();
		$view->news = NewsModel::findAll();
		$view->display('news/all.php');
	}
}
