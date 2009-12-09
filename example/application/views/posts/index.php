<p>Here are some posts from my delightful blog:</p>

<?php if ($posts): ?>
	<?php foreach($posts as $post): ?>
		<h3><?=anchor("posts/show/$post", $post->title)?></h3>
		<p><?=$post->body?></p>
	<?php endforeach; ?>
<?php else: ?>
	<p>There are no posts yet!</p>
<?php endif; ?>