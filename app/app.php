<?php

require __DIR__ . '/../vendor/autoload.php';

use Model\Location;
use Http\Request;
use Http\Response;

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

    $ret = $request->guessBestFormat();

    if ($ret == 'json') {
        return new Response(json_encode($location->findAll()), 200, array('Content-Type' => 'application/json'));
    }

    return $app->render('locations.php', array(
            'locations' => $location->findAll(),
        ));
});

/**
 * Get a location by his id
 */
$app->get('/locations/(\d+)', function (Request $request, $id) use ($app) {
    $location = new Location();
    
    $ret = $request->guessBestFormat();

    if ($ret == 'json') {
        return new Response(json_encode($location->findOneById($id)), 200, array('Content-Type' => 'application/json'));
    }

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
    $id = $location->create($request->getParameter('name'));
    
    $ret = $request->guessBestFormat();
    
    if ($ret == 'json') {
        return new Response(json_encode($id), 201, array('Content-Type' => 'application/json'));
    }

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
