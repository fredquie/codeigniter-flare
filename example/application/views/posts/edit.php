<h2>New Post</h2>

<?=form_open("posts/update/$post")?>

	<p>Title: 
		<input type="text" name="post[title]" value="<?=$post->title?>" id="post[title]" /></p>
	<p>Body: 
		<textarea name="post[body]" rows="8" cols="40"><?=$post->body?></textarea></p>
	<p><input type="submit" name="submit" value="Update Post!" /></p>

<?=form_close()?>