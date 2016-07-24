<?php
/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 05.07.2016
 * Time: 1:33
 */

function __autoload ($class)
{
	$classParts = explode('\\', $class);
	$classParts[0] = __DIR__;    //Aplication
	$path = implode(DIRECTORY_SEPARATOR, $classParts) . '.php';    //DS - is a DIRECTORY_SEPARATOR (congig.php)

	if (file_exists($path)) {
		require $path;
	}else {
		throw new Aplication\Exceptions\PageNotFound;
	}
}