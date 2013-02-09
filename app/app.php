<?php

require __DIR__ . '/../vendor/autoload.php';

use Exception\HttpException;

use Http\Request;
use Http\Response;
use Http\JsonResponse;

use Model\CommentFinder;
use Model\Connection;
use Model\Location;
use Model\LocationFinder;
use Model\LocationDataMapper;

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
    $locations = new LocationFinder($con);

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
    $locations = new LocationFinder($con);

    $location = $locations->findOneById($id);

    if ($location === null) {
        throw new HttpException(404, "Location doesn't exist");
    }

    $location->setComments((new CommentFinder($con))->findAllForLocation($location));
    
    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($location);
    }

   return $app->render('location.php', array(
        'location'  => $location,
        'comments'  => $location->getComments(),
    ));

});

/**
 * Post a location
 */
$app->post('/locations', function (Request $request) use ($app, $con) {
    $name = trim($request->getParameter('name'));
    
    if (empty($name)) {
        throw new HttpException(404, "Location's name are empty.");
    }

    $location = new Location($name);
    $mapper = new LocationDataMapper($con);
    $id = $mapper->persist($location);

    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($id, 201);
    }

    $app->redirect('/locations');
});

/**
 * Modify a location
 */
$app->put('/locations/(\d+)', function (Request $request, $id) use ($app, $con) {
    $name = trim($request->getParameter('name'));
    
    if (empty($name)) {
        throw new HttpException(404, "Location's name are empty.");
    }

    $locations = new LocationFinder($con);
    $location = $locations->findOneById($id);

    $location->setName($name);

    $mapper = new LocationDataMapper($con);
    $mapper->persist($location);

   $app->redirect('/locations/'.$id);
});

/**
 * Delete a location
 */
$app->delete('/locations/(\d+)', function (Request $request, $id) use ($app, $con) {
    $locations = new LocationFinder($con);
    $location = $locations->findOneById($id);
    
    $mapper = new LocationDataMapper($con);
    $mapper->remove($location);

    $app->redirect('/locations');
});

/**
 * Get all comments for a location
 */
$app->get('/locations/(\d+)/comments', function(Request $request, $id) use ($app, $con) {
    if ($request->guessBestFormat() !== 'json') {
        $app->redirect('/locations/'.$id);
    }

    $locations = new LocationFinder($con);

    $location = $locations->findOneById($id);

    if ($location === null) {
        throw new HttpException(404, "Location doesn't exist");
    }

    $location->setComments((new CommentFinder($con))->findAllForLocation($location));

    return new JsonResponse($location->getComments());
});

return $app;
