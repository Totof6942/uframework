<h1><?= $location->getName(); ?></h1>

<a href="/locations">Locations</a>

<h2>Comments</h2>

<?php if (!empty($comments)) : ?>
	<ul>
		<?php foreach ($comments as $comment) : ?>
			<li><strong><?= $comment->getUsername(); ?></strong> : <?= $comment->getBody(); ?></li>
		<?php endforeach; ?>
	</ul>
<?php else : ?>
	No comment.
<?php endif; ?>

<h2>Update this location</h2>

<form action="/locations/<?= $location->getId(); ?>" method="POST">
    <input type="hidden" name="_method" value="PUT" />
    <input type="text" name="name" value="<?= $location->getName(); ?>" />
    <input type="submit" value="Update" />
</form>

<form action="/locations/<?= $location->getId(); ?>" method="POST">
    <input type="hidden" name="_method" value="DELETE" />
    <input type="submit" value="Delete" />
</form>