<?php

require __DIR__ . '/../vendor/autoload.php';

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
    $test = $request->guessBestFormat();
    debug($test);
    return $app->render('locations.php', array(
            'locations' => $location->findAll(),
        ));
});

/**
 * Get a location by his id
 */
$app->get('/locations/(\d+)', function (Request $request, $id) use ($app) {
    $location = new Location();
    return $app->render('location.php', array(
            'id'    => $id, 
            'name'  => $location->findOneById($id)
        ));
});

/**
 * Post a location
 */
$app->post('/locations', function (Request $request) use ($app) {
    $location = new Location();
    $location->create($request->getParameter('name'));
    $app->redirect('/locations');
});

/**
 * Modify a location
 */
$app->put('/locations/(\d+)', function (Request $request, $id) use ($app) {
    $location = new Location();
    $location->update($id, $request->getParameter('name'));
    $app->redirect('/locations/'.$id);
});

/**
 * Delete a location
 */
$app->delete('/locations/(\d+)', function (Request $request, $id) use ($app) {

    $location = new Location();
    $location->delete($id);
    $app->redirect('/locations');
});

return $app;
