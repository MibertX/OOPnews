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
		$view->news = NewsModel::findAll();    //get an array of objects-news
		$view->display('news/all.php');        //and display them
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
	public function actionOneByColumn()
	{
		//without view now, its for search
		//$id = $_GET['id'];

		$field = 'source';    //_GET
		$value = 'Mibert';    //_GET
		$article = new NewsModel();
		$result = $article->findByColumn($field, $value);

		$view = new Views();
		if ($result === true) {
			$view->one_news = $result;
			$view->display('news/one.php');
		}
		else {
			session_start();
			$_SESSION['message'] = 'No search result';
			$view->display('news/message.php');
		}
	}


	//insert new article into
	public function actionInsert()
	{
		$article = new NewsModel();
		$article->title = 'PDO title';
		$article->text = 'PDO text';
		$article->source = 'PDO Mibert';    //will be update when reg. and auth. will be working
		$article->date = date('Y.m.d.');
		$result = $article->insert();

		session_start();
		if ($result === false) {
			$_SESSION['message'] = 'Cannot insert the news';
		}
		else {
			$_SESSION['message'] = 'Inserting was success';
		}

		$view = new Views();
		$view->display('news/message.php');
	}


	//update the news
	private function actionUpdate()
	{
		$news = new NewsModel();
		$news->id = $_GET['id'];
		$news->title = $_POST['title'];
		$news->text = $_POST['text'];
		$news->date = date('Ymd');

		$result = $news->update();

		session_start();
		if ($result === false) {
			$_SESSION['message'] = 'Cannot update the news';
		}
		else {
			$_SESSION['message'] = 'Updating was success';
		}

		$view = new Views();
		$view->display('news/message.php');
	}


	//delete the news
	private function actionDelete()
	{
		$news = new NewsModel();
		$news->id = $_GET['id'];

		$result = $news->delete();

		session_start();
		if ($result === false) {
			$_SESSION['message'] = 'Cannot delete the news';
		}
		else {
			$_SESSION['message'] = 'Deleting was success';
		}

		$view = new Views();
		$view->display('news/message.php');
	}
	
	
	//display editing page with preloaded info for values in <input>
	public function actionEdit()
	{
		$id = $_GET['id'];
		
		$view = new Views();
		$view->one_news = NewsModel::findOneByPk($id);
		$view->display('news/edit.php');
	}


	public function actionSave()
	{
		if (isset($_POST) && !empty($_POST)) {
			$news = new NewsController();
			$news->actionUpdate();
		}
		elseif (!isset($_POST) || empty($_POST)) {
			$news = new NewsController();
			$news->actionDelete();
		}
		else {
			session_start();
			$_SESSION['message'] = 'Wrong operation';
			$view = new Views();
			$view->display('news/message.php');
		}
	}
}
