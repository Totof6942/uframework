<h1>Locations</h1>

<ul>
	<?php foreach ($parameters as $k => $v) : ?>
		<li><a href="/locations/<?= $k; ?>"><?= $v['name'] ?></a></li>
	<?php endforeach; ?>
</ul>