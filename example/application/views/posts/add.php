<h2>New Post</h2>

<?=form_open('posts/create')?>

	<p>Title: 
		<input type="text" name="post[title]" value="" id="post[title]" /></p>
	<p>Body: 
		<textarea name="post[body]" rows="8" cols="40"></textarea></p>
	<p><input type="submit" name="submit" value="Create Post!" /></p>

<?=form_close()?>