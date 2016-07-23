<?php
/**
 * Created by PhpStorm.
 * User: Mibert
 * Date: 13.07.2016
 * Time: 0:28
*/
?>
<form action="/news/save/<?php echo $article->id ?>" method="post" enctype="multipart/form-data">

<!-- values in title and text is preloaded from edited article -->
	<label>
		<input type="text" name="title" id="title" value="<?php echo $article->title ?>" >
	</label>
	<br><br>

	<label>
		<textarea name="text" id="text" ><?php echo $article->text ?></textarea>
	</label>
	<br><br>

	<input type="submit">
</form>

