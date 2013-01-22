<?php

require __DIR__ . '/../autoload.php';

use Model\Location;
use Http\Request;

// Config
$debug = true;

$app = new \App(new View\TemplateEngine(
    __DIR__ . '/templates/'
), $debug);

/**
 * Index
 */
$app->get('/', function () use ($app) {
    return $app->render('index.php');
});

/**
 * Get all locations
 */
$app->get('/locations', function(Request $request) use ($app) {
	$location = new Location();
	return $app->render('locations.php', $location->findAll());
});

/**
 * Get a location by his id
 */
$app->get('/locations/(\d+)', function (Request $request, $id) use ($app) {
	$location = new Location();
	return $app->render('location.php', $location->findOneById($id));
});

/**
 * Post a location
 */
$app->post('/locations', function (Request $request) use ($app) {

});

/**
 * Modify a location
 */
$app->put('/locations/(\d+)', function (Request $request, $id) use ($app) {

});

/**
 * Delete a location
 */
$app->delete('/locations/(\d+)', function (Request $request, $id) use ($app) {

});

return $app;
