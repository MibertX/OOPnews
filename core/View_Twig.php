<?php
/**
 * Created by PhpStorm.
 * User: Mibert
 * Date: 28.07.2016
 * Time: 1:53
 */

namespace Aplication\Core;


/**
 * Class View_Twig
 * @package Aplication\Core
 * @property $news
 * @property $article
 * @property $logs
 * @property $message
 * 
 * @property $error_code
 * @property $error_msg
 */


class View_Twig
{
	protected $template;
	protected $params =[];

	public function __set($key, $value)
	{
		return $this->params[$key] = $value;
	}
	public function __get($key)
	{
		return $this->params[$key];
	}
	public function __isset($key)
	{
		return isset($this->params[$key]);
	}


	public function __construct($template_file = 'main.html')
	{
		$loader = new \Twig_Loader_Filesystem(__DIR__ . DS . '..' . DS . 'templates');
		$twig = new \Twig_Environment($loader);

		$this->template = $twig->loadTemplate($template_file . '.twig');
	}

	
	protected function setHeaderTitle()
	{
		switch (str_replace('.html.twig', '', $this->params['include'])) {
			case 'news' . DS . 'all':
				$this->params['title'] = 'All news';
				break;

			case 'news' . DS . 'edit':
			case 'news' . DS . 'one':
				if (isset($this->params['article'])) {
					$this->params['title'] = $this->params['article']->title;
					break;
				}else {
					$this->params['title'] = 'News not found';
					break;
				}

			case 'message':
				$this ->params['title'] = 'Message';
				break;

			default:
				//var_dump(str_replace('.html.twig', '', $this->params['include']));die;
				$this->params['title'] = 'OOPNews';
		}
	}


	protected function rendering($template_includes = null)
	{
		if (isset($template_includes)) {
			$this->params['include'] = $template_includes . '.html.twig';
		}

		$this->setHeaderTitle();

		 return $this->template->render($this->params);
	}


	public function display($template_includes = null)
	{
		echo $this->rendering($template_includes);
	}
	
}