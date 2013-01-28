<h1>Locations</h1>

<ul>
	<?php foreach ($locations as $location) : ?>
		<li><a href="/locations/<?= $location->getId(); ?>"><?= $location->getName(); ?></a></li>
	<?php endforeach; ?>
</ul>

<h2>Create new location</h2>

<form action="/locations" method="POST">
	<label for="name">Name:</label>
	<input type="text" name="name" id="name" />

	<input type="submit" value="Add New" />
</form>