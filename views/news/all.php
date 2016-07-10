<?php
/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 05.07.2016
 * Time: 21:59
 */

foreach ($news as $article) : ?>
	<h2> <a href="../../index.php?ctrl=News&action=One&id=<?php echo $article->id ?>"> <?php echo $article->title ?> </a></h2>
	<p>
		<?php echo $article->text ?>
	</p>
<?php endforeach ?>
