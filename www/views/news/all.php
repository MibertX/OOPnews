<?php
/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 05.07.2016
 * Time: 21:59
 */

foreach ($this->data as $item) : ?>
	<h2> <?php echo $item->title ?> </h2>
	<p>
		<?php echo $item->text ?>
	</p>
<?php endforeach ?>
