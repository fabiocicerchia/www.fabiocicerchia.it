<?php

/**
 *
 * FABIO CICERCHIA - WEBSITE
 * Copyright (C) 2012. All Rights reserved.
 *
 */

require_once __DIR__ . '/../../apps/api/silex.phar';

use Silex\WebTestCase;

class AppTest extends WebTestCase
{
    public function createApplication()
    {
        return require __DIR__ . '/../../apps/api/logic/app.php';
    }

    public function testHomepage()
    {
        $client = $this->createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
