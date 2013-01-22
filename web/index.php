<?php

function debug($var)
{
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
}

$app = require __DIR__ . '/../app/app.php';
$app->run();
