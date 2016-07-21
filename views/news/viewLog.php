<?php
/**
 * Created by PhpStorm.
 * User: Mibert
 * Date: 21.07.2016
 * Time: 22:59
 */

//bug fixed - the first (or last if dubl PHP_EOL is separate in explode) element is always empty, need to repare later
unset($logs[0]);    
?>

<h1> TOTAL - <?php echo count($logs)?> EXCEPTIONS </h1>
<?php $i = 1;

foreach ($logs as $log): ?>
	<h5> Exception <?php echo $i ?> </h5>
	<p>

	<?php $log = explode(PHP_EOL, $log);
	foreach ($log as $line): ?>
		<p> <?php echo $line ?> </p>
	<?php endforeach; ?>

	</p>
	<br><br>

	<?php $i++?>
<?php endforeach;?>