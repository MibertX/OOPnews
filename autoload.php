<?php
/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 05.07.2016
 * Time: 1:33
 */

function __autoload ($class)
{
	if (file_exists(__DIR__ . DS . 'controllers' . DS . $class . '.php')) {
		require __DIR__ . DS . 'controllers' . DS . $class . '.php';

	} elseif (file_exists(__DIR__ . DS . 'models' . DS . $class . '.php')) {
		require __DIR__ . DS . 'models' . DS . $class . '.php';

	} elseif (file_exists(__DIR__ . DS . 'classes' . DS . $class . '.php')) {
		require __DIR__ . DS . 'classes' . DS . $class . '.php';

 	} elseif (file_exists(__DIR__ . DS . 'views' . DS . $class . '.php')) {
		require __DIR__ . DS . 'views' . DS . $class . '.php';

	} elseif (file_exists(__DIR__ . DS . 'core' . DS . $class . '.php')) {
		require __DIR__ . DS . 'core' . DS . $class . '.php';

	} elseif (file_exists(__DIR__ . DS . 'exeptions' . DS . $class . '.php')) {
		require __DIR__ . DS . 'exeptions' . DS . $class . '.php';
	}
}