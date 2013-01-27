<?php

require __DIR__ . '/../vendor/autoload.php';

use Model\Locations;
use Http\Request;
use Http\Response;
use Exception\HttpException;

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
    $locations = new Locations();

    if ($request->guessBestFormat() === 'json') {
        return new Response(json_encode($locations->findAll()), 200, array('Content-Type' => 'application/json'));
    }

    return $app->render('locations.php', array(
            'locations' => $locations->findAll(),
        ));
});

/**
 * Get a location by his id
 */
$app->get('/locations/(\d+)', function (Request $request, $id) use ($app) {
    $locations = new Locations();

    $location = $locations->findOneById($id);

    if ($location === null) {
        throw new HttpException(404, "Location doesn't exist");
    }
    
    if ($request->guessBestFormat() === 'json') {
        return new Response(json_encode($location[$id]), 200, array('Content-Type' => 'application/json'));
    }

   return $app->render('location.php', array(
        'id'    => $id, 
        'name'  => $location[$id]
    ));

});

/**
 * Post a location
 */
$app->post('/locations', function (Request $request) use ($app) {
    $location = new Locations();
    $id = $location->create($request->getParameter('name'));
        
    if ($request->guessBestFormat() ==='json') {
        return new Response(json_encode($id), 201, array('Content-Type' => 'application/json'));
    }

    $app->redirect('/locations');
});

/**
 * Modify a location
 */
$app->put('/locations/(\d+)', function (Request $request, $id) use ($app) {
    $location = new Locations();
    $location->update($id, $request->getParameter('name'));
    $app->redirect('/locations/'.$id);
});

/**
 * Delete a location
 */
$app->delete('/locations/(\d+)', function (Request $request, $id) use ($app) {

    $location = new Locations();
    $location->delete($id);
    $app->redirect('/locations');
});

return $app;
