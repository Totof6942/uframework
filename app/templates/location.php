<h1><?= $name ?></h1>

<a href="/locations">Locations</a>

<h2>Update this location</h2>

<form action="/locations/<?= $id ?>" method="POST">
	<input type="hidden" name="_method" value="PUT" />
	<input type="text" name="name" value="<?= $name ?>" />
	<input type="submit" value="Update" />
</form>

<form action="/locations/<?= $id ?>" method="POST">
	<input type="hidden" name="_method" value="DELETE" />
	<input type="submit" value="Delete" />
</form>