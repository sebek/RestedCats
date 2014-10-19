<?php

use Respect\Rest\Router;
use RestedCats\Helpers\Input;
use RestedCats\Helpers\Response;
use RestedCats\Helpers\Validation;
use RestedCats\Repositories\CatsRepository;

// Helper Classes
$input = new Input();
$response = new Response();
$validation = new Validation();

// Repositories
$catsRepository = new CatsRepository();

// Routing
$route = new Router('/index.php/');

/**
 * Find cat by id
 */
$route->get('/cats/*', function ($id) use ($response, $catsRepository) {
    $cat = $catsRepository->find($id);

    if (!empty($cat)) {
        return $response->send($cat);
    }

    return $response->send("Could not find cat with id {$id}", 404);
});

/**
 * Find cat by name
 */
$route->get('/cats/*/byName', function ($name) use ($response, $catsRepository) {
    $cat = $catsRepository->findByName($name);

    if (!empty($cat)) {
        return $response->send($cat);
    }

    return $response->send("Could not find cat with name {$name}", 404);
});

/**
 * Fetch and return every cat in the database
 */
$route->get('/cats/', function () use ($response, $catsRepository) {
    $cats = $catsRepository->all();
    return $response->send($cats);
});

/**
 * Add a new cat to the database
 */
$route->post('/cats/', function () use ($input, $response, $validation, $catsRepository) {

    $fields = $input->all();

    $rules = [
        "name" => ["required"],
        "age" => ["required", "numeric"],
        "color" => ["string"]
    ];

    if ($validation->run($fields, $rules) === false) {
        return $response->send($validation->getErrorMessages(), 400);
    }

    if ($catsRepository->create($fields)) {
        return $response->send("Cat created", 200);
    }

    return $response->send("Unknown error, ask you nearest cat", 500);
});

/**
 * Update a cat
 */
$route->put('/cats/*', function ($id) use ($input, $response, $validation, $catsRepository) {

    $fields = $input->all();

    $rules = [
        "name" => ["required", "string"],
        "age" => ["required", "numeric"],
        "color" => ["string"]
    ];

    if ($validation->run($fields, $rules) === false) {
        return $response->send($validation->getErrorMessages(), 400);
    }

    if ($catsRepository->update($id, $fields)) {
        return $response->send("Cat updated", 200);
    }

    return $response->send("Could not find cat with id {$id}", 404);
});

/**
 * Delete a cat
 */
$route->delete('/cats/*', function ($id) use ($response, $catsRepository) {
    if ($catsRepository->delete($id)) {
        return $response->send("Cat deleted", 200);
    }

    return $response->send("Could not find cat with id {$id}", 404);
});
