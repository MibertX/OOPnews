<?php

/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 04.07.2016
 * Time: 19:02
 */

namespace Aplication\Models;
use Aplication\Core\Model as AdminModel;

/**
 * Class News
 * @package Aplication\Models
 * @property $id
 * @property $title
 * @property $text
 * @property $source
 * @property $date
 */

class News
	extends AdminModel
{
	protected static $table = 'news';
	protected static $class = 'NewsModel';
}