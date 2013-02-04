<?php

require __DIR__ . '/../vendor/autoload.php';

use DAL\Connection;
use Exception\HttpException;
use Http\Request;
use Http\Response;
use Http\JsonResponse;
use Model\Locations;


// Config
$debug = true;
$dsn      = 'mysql:host=localhost;dbname=uframework';
$user     = 'uframework';
$password = 'uframework123';

$con = new Connection($dsn, $user, $password);
 
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
$app->get('/locations', function(Request $request) use ($app, $con) {
    $locations = new Locations($con);

    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($locations->findAll());
    }

    return $app->render('locations.php', array(
            'locations' => $locations->findAll(),
        ));
});

/**
 * Get a location by his id
 */
$app->get('/locations/(\d+)', function (Request $request, $id) use ($app, $con) {
    $locations = new Locations($con);

    $location = $locations->findOneById($id);

    if ($location === null) {
        throw new HttpException(404, "Location doesn't exist");
    }
    
    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($location);
    }

   return $app->render('location.php', array(
        'location'  => $location,
    ));

});

/**
 * Post a location
 */
$app->post('/locations', function (Request $request) use ($app) {
    $location = new Locations();
    $id = $location->create($request->getParameter('name'));
        
    if ($request->guessBestFormat() ==='json') {
        return new JsonResponse($id, 201);
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
