<?php

use function src\jwtAuth;
use function src\slimConfiguration;
use App\Controllers\AdminUsers\AdminUsersController;
use App\Controllers\Auth\AuthController;
use App\Controllers\Production\ProductionController;
use App\Controllers\AwaitingRelease\AwaitingReleaseController;
use App\Controllers\AwaitingShipment\AwaitingShipmentController;
use App\Controllers\Dispatched\DispatchedController;
use App\Controllers\ProductionReport\ProductionReportController;
use App\Controllers\Stock\StockController;
use App\Middlewares\adminConference;
use App\Middlewares\jwtDateTime;



$app = new \Slim\App(slimConfiguration()); 

$app = new \Slim\App(slimConfiguration()); 

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

// ================= Login ========================

$app -> post('/login' , AuthController::class . ':login');

$app -> post('/refresh-token' , AuthController::class . ':refreshToken');

$app -> get('/decodfy' , function($request , $response) {
    $response = $response->withJson($request -> getAttribute('jwt'));
}) -> add(new jwtDateTime())
-> add(jwtAuth());

// ================================================


// ================== Production ==================


$app -> post('/production' , ProductionController::class . ':Productsinproduction')
-> add(new jwtDateTime())
-> add(jwtAuth());

// =================================================


// ================== Awaiting release =============

$app -> get('/awaiting-release' , AwaitingReleaseController::class . ':AwaitingRelease')
-> add(new jwtDateTime())
-> add(jwtAuth());

// ==================================================


// ================== Awaiting shipment =============

$app -> get('/awaiting-shipment' , AwaitingShipmentController::class . ':AwaitingShipment')
-> add(new jwtDateTime())
-> add(jwtAuth());
// ==================================================

// ================== Awaiting dispached =============

$app -> get('/dispatched' , DispatchedController::class . ':Dispatched')
-> add(new jwtDateTime())
-> add(jwtAuth());
// ==================================================

// ================== Production Report =============

$app -> post('/production-report' , ProductionReportController::class . ':ProductionReport')
-> add(new jwtDateTime())
-> add(jwtAuth());

// ==================================================

// ================== Stock =============

$app -> post('/stock' , StockController::class . ':StockFilter')
-> add(new jwtDateTime())
-> add(jwtAuth());

// ==================================================

// ================== Users =============

$app -> post('/users' , AdminUsersController::class . ':createUsers')
-> add(new adminConference()) 
-> add(new jwtDateTime())
-> add(jwtAuth());

$app -> put('/users' , AdminUsersController::class . ':editUsers')
-> add(new adminConference()) 
-> add(new jwtDateTime())
-> add(jwtAuth());

$app -> delete('/users/{id}' , AdminUsersController::class . ':deleteUsers')
-> add(new adminConference()) 
-> add(new jwtDateTime())
-> add(jwtAuth());

$app -> post('/confirmEmail' , AdminUsersController::class . ':emailVerification')
-> add(new adminConference()) 
-> add(new jwtDateTime())
-> add(jwtAuth());

$app -> post('/searchUser' , AdminUsersController::class . ':UserSearchEmail') 
-> add(new adminConference()) 
-> add(new jwtDateTime())
-> add(jwtAuth());


$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});


// ==================================================


$app -> run();
