<?php

/**
 *
 * FABIO CICERCHIA - STYLING EXERCISES JUST FOR FUN
 * Copyright (C) 2012. All Rights reserved.
 *
 */

// -----------------------------------------------------------------------------
// INIT SILEX & SETUP SOME STUFF -----------------------------------------------
// -----------------------------------------------------------------------------
require_once __DIR__ . '/../silex.phar';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app = new Silex\Application();

// -----------------------------------------------------------------------------
// ERROR HANDLING --------------------------------------------------------------
// -----------------------------------------------------------------------------
$app->error(function (\Exception $e, $code) {
    return new Response($e->getMessage(), $code);
});

// -----------------------------------------------------------------------------
// ROUTE SAVE ------------------------------------------------------------------
// -----------------------------------------------------------------------------
$app->get('/', function() use($app) {
})->method('POST')->bind('home');

return $app;
