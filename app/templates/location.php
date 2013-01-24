<h1><?= $parameters[1] ?></h1>

<a href="/locations">Locations</a>

<h2>Update this location</h2>

<form action="/locations/<?= $id ?>" method="POST">
	<input type="hidden" name="_method" value="PUT" />
	<input type="text" name="name" value="<?= $parameters[1] ?>" />
	<input type="submit" value="Update" />
</form>
