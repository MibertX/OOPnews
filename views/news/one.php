<?php
/**
 * Created by PhpStorm.
 * User: Razo4
 * Date: 06.07.2016
 * Time: 1:10
 */
?>

<h2>
    <?php echo $article->title ?>
</h2>

<?php include __DIR__ . DS . 'control_buttons.php' ?>    <!-- Edit and delete buttons -->

<p>
	<?php echo $article->text ?>
</p>