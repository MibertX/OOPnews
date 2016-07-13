<?php
/**
 * Created by PhpStorm.
 * User: Mibert
 * Date: 13.07.2016
 * Time: 0:28
 */
?>
<form action="/index.php?ctrl=news&action=save&id=<?php echo $one_news->id?>"
	  method="post" enctype="multipart/form-data">
	<label>
		<input type="text" name="title" id="title" value="<?php echo $one_news->title ?>" >
	</label>

	<label>
		<textarea name="text" id="text" > <?php echo $one_news->text ?> </textarea>
	</label>

	<input type="submit">
</form>

