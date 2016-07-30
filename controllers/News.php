<?php

/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 05.07.2016
 * Time: 9:24
 */

namespace Aplication\Controllers;
use Aplication\Core\View_Twig;
use Aplication\Models\News as NewsModel;
use Aplication\Core\View;
use Aplication\Exceptions\PageNotFound;
use Aplication\Models\PHPMailer_MyOwn;


class News
{
	//session need in almost all methods for setting a message that need to show user
	public function __construct()
	{
		session_start();
	}


	//display all news
    public function actionAll()
	{
		$view = new View_Twig();
		$view->news = NewsModel::findAll();

		if (isset ($_SESSION['message'])) {
			$view->message = $_SESSION['message'];
			unset($_SESSION['message']);
			session_destroy();
		}

		$view->display('news' . DS . 'all');die;
	}


	//display one news got by id from DB
	public function actionOne()
	{
		if (empty($_GET['id'])) {
			throw new PageNotFound;
		}

		$id = $_GET['id'];

		$view = new View_Twig();
	    $view->article = NewsModel::findOneByPk($id);
		$view->display('news' . DS . 'one');
	}


	//display one news got by column from DB
	public function actionOneByColumn()
	{
		$field = $_GET['field'];    //_GET for test, later - POST
		$value = $_GET['value'];    //_GET for test, later - POST
		$article = new NewsModel();
		$result = $article->findByColumn($field, $value);

		$view = new View_Twig();
		if (!empty($result)) {
			$view->news = $result;
			$view->display('news' . DS . 'all');
		}
		else {
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
			$view = new View();
			$view->display('news'. DS .'message.php');
			exit;
		}

		//No need to publish another the same news
		if(!empty(NewsModel::existenceCheckByColumn('title', $_POST['title'])) ||
			!empty(NewsModel::existenceCheckByColumn('text', $_POST['text'])))
		{
			$_SESSION['message'] = 'News with the same title or text already published';
			header("Location: http://oopnews");
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

			$mail = new PHPMailer_MyOwn();
			$mail->configuration();
			$mail->Subject = 'News added';
			$mail->Body = 'New artocle was added';
			$mail->addAddress('Razo412@gmail.com', 'Mibert');

			if (!$mail->send()) {
				echo 'pizdec';die;
			}
		}
	}


	//update the news
	private function actionUpdate()
	{
		if (empty($_GET['id'])) {
			throw new PageNotFound;
		}

		$article = new NewsModel();
		$article->id = $_GET['id'];
		$article->title = $_POST['title'];
		$article->text = $_POST['text'];
		$article->date = date('Ymd');

		$result = $article->update();

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
			throw new PageNotFound;
		}

		$article = new NewsModel();
		$article->id = $_GET['id'];

		$result = $article->delete();

		if ($result === false) {
			$_SESSION['message'] = 'Cannot delete the news';
		}
		else {
			$_SESSION['message'] = 'Deleting was success';
		}

		header("Location: http://oopnews");
		exit;
	}
	
	
	//display editing page with preloaded info for values in <input>
	public function actionEdit()
	{
		if (empty($_GET['id'])) {
			throw new PageNotFound;
		}

		$id = $_GET['id'];
		
		$view = new View_Twig();
		$view->article = NewsModel::findOneByPk($id);
		$view->display('news'. DS .'edit');
	}


	//public method that decide - is a news a new one - and insert it, or a news is exist - so only update it
	public function actionSave()
	{
		$news = new News();

		if (isset($_GET['id'])) {
			$news->actionUpdate();
		}
		else {
			$news->actionInsert();
		}

		header("Location: http://oopnews");
		exit;
	}
	
	
	public function actionViewLog()
	{
		$logs = explode('|#|', file_get_contents(__DIR__  . DS . '..' . DS . 'log.txt'));
		unset($logs[0]);

		$logs_byString = [];
		foreach ($logs as $log) {
			$logs_byString[] = explode(PHP_EOL, $log);
		}

		$view = new View_Twig();
		$view->logs = $logs_byString;
		$view->display('news'. DS .'viewLog');
	}
}