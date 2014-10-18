<?php

use Respect\Rest\Router;

$input = new \RestedCats\Helpers\Input();
$response = new \RestedCats\Helpers\Response();
$validation = new \RestedCats\Helpers\Validation();
$catsRepository = new \RestedCats\Repositories\CatsRepository();

$route = new Router('/index.php/');

$route->get('/cats/*', function ($id) {

});

$route->get('/cats/*/byName', function ($id) {

});

$route->get('/cats/', function () use ($response, $catsRepository) {
    $cats = $catsRepository->all();
    return $response->send($cats);
});

$route->post('/cats/', function () use ($input, $response, $validation) {

    $fields = $input->all();

    $rules = [
        "name" => ["required"],
        "age" => ["required", "numeric"]
    ];

    if ($validation->run($fields, $rules) === false) {
        return $response->send($validation->getErrorMessages(), 400);
    }

});

$route->put('/cats/*', function ($id) use ($input) {

});