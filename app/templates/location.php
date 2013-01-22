<h1>City</h1>

<ul>
	<?php foreach ($parameters as $k => $v) : ?>
		<li><?= $k; ?> : <strong><?= $v ?></strong></li>
	<?php endforeach; ?>
</ul>

<a href="/locations">Locations</a>
