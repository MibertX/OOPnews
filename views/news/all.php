<?php
/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 05.07.2016
 * Time: 21:59
 */

include __DIR__ . DS . 'viewLog_button.php';

include __DIR__ . DS . 'add.php';

foreach ($news as $article) : ?>
	<h2>
		<a href="../../index.php?ctrl=News&action=One&id=<?php echo $article->id ?>"> <?php echo $article->title ?> </a>
	</h2>

	<?php include __DIR__ . DS . 'control_buttons.php' ?>

	<p>
		<?php echo $article->text ?>
	</p>
	<br><br>
<?php endforeach ?>
