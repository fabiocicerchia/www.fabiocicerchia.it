<?php

/**
 * FABIO CICERCHIA - WEBSITE
 * Copyright (C) 2012. All Rights reserved.
 *
 * PHP Version 5
 *
 * @category API
 * @package  API
 * @author   Fabio Cicerchia <info@fabiocicerchia.it>
 * @license  TBD <http://www.fabiocicerchia.it>
 * @link     http://www.fabiocicerchia.it
 */

// -----------------------------------------------------------------------------
// INIT APPLICATION
// -----------------------------------------------------------------------------
$app = require_once __DIR__ . '/../apps/api/logic/app.php';

// -----------------------------------------------------------------------------
// RUN IT ----------------------------------------------------------------------
// -----------------------------------------------------------------------------
$app['http_cache']->run();
