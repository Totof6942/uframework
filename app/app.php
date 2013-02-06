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

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

// Config
$debug = true;
$dsn      = 'mysql:host=localhost;dbname=uframework';
$user     = 'uframework';
$password = 'uframework123';

$con = new Connection($dsn, $user, $password);

$encoders = array(new XmlEncoder(), new JsonEncoder());
$normalizers = array(new GetSetMethodNormalizer());
$serializer = new Serializer($normalizers, $encoders);
 
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
$app->get('/locations', function(Request $request) use ($app, $con, $serializer) {
    $locations = new LocationFinder($con);

    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($serializer->serialize($locations->findAll(), 'json'));
    }

    return $app->render('locations.php', array(
            'locations' => $locations->findAll(),
        ));
});

/**
 * Get a location by his id
 */
$app->get('/locations/(\d+)', function (Request $request, $id) use ($app, $con, $serializer) {
    $locations = new LocationFinder($con);

    $location = $locations->findOneById($id);

    if ($location === null) {
        throw new HttpException(404, "Location doesn't exist");
    }
    
    if ($request->guessBestFormat() === 'json') {
        return new JsonResponse($serializer->serialize($location, 'json'));
    }

    $location->setComments((new CommentFinder($con))->findAllForLocation($location));

   return $app->render('location.php', array(
        'location'  => $location,
        'comments'  => $location->getComments(),
    ));

});

/**
 * Post a location
 */
$app->post('/locations', function (Request $request) use ($app, $con) {
    $location = new Location(null, $request->getParameter('name'));
    $mapper = new LocationDataMapper($con);
    $id = $mapper->persist($location);

    if ($request->guessBestFormat() ==='json') {
        return new JsonResponse($id, 201);
    }

    $app->redirect('/locations');
});

/**
 * Modify a location
 */
$app->put('/locations/(\d+)', function (Request $request, $id) use ($app, $con) {
    $locations = new LocationFinder($con);
    $location = $locations->findOneById($id);

    $location->setName($request->getParameter('name'));

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
$app->get('/locations/(\d+)/comments', function(Request $request, $id) use ($app, $con, $serializer) {
    if ($request->guessBestFormat() !== 'json') {
        $app->redirect('/locations/'.$id);
    }

    $locations = new LocationFinder($con);

    $location = $locations->findOneById($id);

    if ($location === null) {
        throw new HttpException(404, "Location doesn't exist");
    }

    $location->setComments((new CommentFinder($con))->findAllForLocation($location));

    return new JsonResponse($serializer->serialize($location->getComments(), 'json'));
});

return $app;
