<?php
/**
 * Created by PhpStorm.
 * User: Mibert
 * Date: 14.07.2016
 * Time: 1:31
 */
?>

<!--action to NewsController, method actionSave-->
<form action="/news/save" method="post" enctype="multipart/form-data">
	<label>
		<input type="text" name="title" id="title" placeholder="Enter title here" required>
	</label>
	<br><br>
	
	<textarea name="text" id="text" placeholder="Enter text here" required></textarea>
	<br><br>
	
	<input type="submit" value="Publish">
</form>
