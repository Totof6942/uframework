<h1>City</h1>

<ul>
	<?php foreach ($parameters as $k => $v) : ?>
		<li><?= $k; ?> : <strong><?= $v ?></strong></li>
	<?php endforeach; ?>
</ul>

<a href="/locations">Locations</a>

<h2>Update this location</h2>

<form action="/locations/<?= $id ?>" method="POST">
	<input type="hidden" name="_method" value="PUT" />
	<input type="text" name="name" value="<?= $location ?>" />
	<input type="submit" value="Update" />
</form>
