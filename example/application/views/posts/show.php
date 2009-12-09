<h2><?=$post->title?></h2>

<p><?=$post->body?></p>

<p><?=anchor("posts/edit/$post", "Edit")?> | <?=anchor("posts/delete/$post", "Delete")?> | <?=anchor('posts', 'Back')?></p>