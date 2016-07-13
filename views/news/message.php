<?php
/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 11.07.2016
 * Time: 0:50
 */


if (!isset($_SESSION['message']) or empty($_SESSION['message'])) {
	header("Location: http://oopnews/index.php");
} ?>

<h3> <?php echo $_SESSION['message'] ?> </h3>
<?php unset($_SESSION['message']) ?>

<a href="http://oopnews/index.php?ctrl=news&action=All"> Back to main page </a>




