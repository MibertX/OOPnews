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
		$view->display('news' . DS .'all.php');        //and display them
	}


	//display one news got by id from DB
	public function actionOne()
	{
		if (empty($_GET['id'])) {
			throw new PageNotFoundException;
		}

		$id = $_GET['id'];
		
		$view = new Views();
	    $view->one_news = NewsModel::findOneByPk($id);
		
		$view->display('news' . DS .'one.php');
	}


	//display one news got by column from DB
	public function actionOneByColumn()
	{
		$field = $_GET['field'];    //_GET for test, later - POST
		$value = $_GET['value'];    //_GET for test, later - POST
		$article = new NewsModel();
		$result = $article->findByColumn($field, $value);

		$view = new Views();
		if (!empty($result)) {
			$view->news = $result;
			$view->display('news' . DS .'all.php');
		}
		else {
			session_start();
			$_SESSION['message'] = 'No search result';
			$view->display('news' . DS . 'message.php');
		}
	}


	//insert new article into DB
	private function actionInsert()
	{
		//if html <require> does not work
		if (empty($_POST['title']) || empty($_POST['text']))
		{
			$_SESSION['message'] = 'You must enter title and text before';
			$view = new Views();
			$view->display('news'. DS .'message.php');
			exit;
		}

		//No need to publish another the same news
		if(!empty(NewsModel::existenceCheckByColumn('title', $_POST['title'])) ||
			!empty(NewsModel::existenceCheckByColumn('text', $_POST['text'])))
		{
			$_SESSION['message'] = 'News with the same title or text already published';
			$view = new Views();
			$view->display('news'. DS .'message.php');
			exit;
		}

		//if all checks succeed - create object article with entered by user data and insert it into database
		$article = new NewsModel();
		$article->title = $_POST['title'];
		$article->text = $_POST['text'];
		$article->source = 'PDO Mibert';    //will be update when reg. and auth. will be working
		$article->date = date('Y.m.d.');

		$result = $article->insert();

		if ($result === false) {
			$_SESSION['message'] = 'Cannot insert the news';
		}
		else {
			$_SESSION['message'] = 'Inserting was success';
		}
	}


	//update the news
	private function actionUpdate()
	{
		if (empty($_GET['id'])) {
			throw new PageNotFoundException;
		}

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
	}


	//delete the news
	public function actionDelete()
	{
		if (empty($_GET['id'])) {
			throw new PageNotFoundException;
		}

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
		$view->display('news'. DS .'message.php');
	}
	
	
	//display editing page with preloaded info for values in <input>
	public function actionEdit()
	{
		if (empty($_GET['id'])) {
			throw new PageNotFoundException;
		}

		$id = $_GET['id'];
		
		$view = new Views();
		$view->one_news = NewsModel::findOneByPk($id);
		$view->display('news'. DS .'edit.php');
	}


	//public method that decide - is a news a new one - and insert it, or a news is exist - so only update it
	public function actionSave()
	{
		$news = new NewsController();

		if (isset($_GET['id'])) {
			$news->actionUpdate();
		}
		else {
			$news->actionInsert();
		}

		$view = new Views();
		$view->display('news'. DS .'message.php');
	}
	
	
	public function actionViewLog()
	{
		$view = new Views();
		$view->logs = explode('|#|', file_get_contents(__DIR__  . DS . '..' . DS . 'log.txt'));
		$view->display('news'. DS .'viewLog.php');
	}
}
