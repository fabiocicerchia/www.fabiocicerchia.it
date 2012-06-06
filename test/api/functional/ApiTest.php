<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category  Api
 * @package   Api
 * @author    Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright 2012 Fabio Cicerchia. All Rights reserved.
 * @license   TBD <http://www.fabiocicerchia.it>
 * @link      http://www.fabiocicerchia.it
 */

//namespace YourApp\Tests;

require_once realpath(__DIR__ . '/../../../apps/api/silex.phar');

use Silex\WebTestCase;

/**
 * The Application Test Suite.
 *
 * @category   API
 * @package    WebTestCase
 * @subpackage AppTest
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    TBD <http://www.fabiocicerchia.it>
 * @link       http://www.fabiocicerchia.it
 * @backupGlobals disabled
 */
class ApiTest extends WebTestCase
{
    // {{{ createApplication
    /**
     * Return the instance of \Silex\Application.
     *
     * @return \Silex\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../../../apps/api/logic/app.php';

        $app['debug'] = false;

        return $app;
    }
    // }}}

    // {{{ setUpDebug
    /**
     * PHPUnit setUp for setting up the application.
     *
     * Note: Child classes that define a setUp method must call
     * parent::setUp().
     */
    public function setUpDebug()
    {
        $this->app = $this->createDebugApplication();
    }
    // }}}

    // {{{ createDebugApplication
    /**
     * Return the instance of \Silex\Application.
     *
     * @return \Silex\Application
     */
    public function createDebugApplication()
    {
        $app = $this->createApplication();

        $app['debug'] = true;
        unset($app['exception_handler']);

        return $app;
    }
    // }}}

    // {{{ providerInvalidHttpMethods
    /**
     * Return the list of the invalid HTTP Methods.
     *
     * @return array
     */
    public function providerInvalidHttpMethods()
    {
        $methods = [
            'POST',
            'PUT',
            'DELETE',
            'CONNECT',
            'OPTIONS',
            'PATCH',
            'PROPFIND',
            'PROPPATCH',
            'MKCOL',
            'COPY',
            'MOVE',
            'LOCK',
            'UNLOCK'
        ];

        return [$methods];
    }
    // }}}

    // {{{ testEntrypointRouteCheckStatusCode
    /**
     * Test the route "Entrypoint" to check the HTTP Status Code.
     *
     * @return void
     */
    public function testEntrypointRouteCheckStatusCode()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testEntrypointRouteCheckMimetype
    /**
     * Test the route "Entrypoint" to check the MIME Type.
     *
     * @return void
     */
    public function testEntrypointRouteCheckMimetype()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals('application/vnd.ads+xml;v=1.0', $client->getResponse()->headers->get('Content-Type'));
    }
    // }}}

    // {{{ testEntrypointRouteCheckMimetypeWithDebug
    /**
     * Test the route "Entrypoint" to check the MIME Type with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testEntrypointRouteCheckMimetypeWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals('application/xml', $client->getResponse()->headers->get('Content-Type'));
    }
    // }}}

    // {{{ testEntrypointRouteCheckResponse
    /**
     * Test the route "Entrypoint" to check the Response.
     *
     * @return void
     */
    public function testEntrypointRouteCheckResponse()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals(1, $crawler->filter('service')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{32}$/', $crawler->filter('service > id')->text());
        $this->assertRegExp('/^Fabio Cicerchia API - .+$/', $crawler->filter('service > title')->text());
        $this->assertEquals(1, $crawler->filter('service > link[rel="self"]')->count());
        $this->assertEquals(1, $crawler->filter('service > link[rel="describedby"]')->count());
        $this->assertEquals(1, $crawler->filter('service > link[rel="author"]')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('service > updated')->text());
        $this->assertEquals('Fabio Cicerchia', $crawler->filter('service > author > name')->text());
        $this->assertEquals('http://www.fabiocicerchia.it', $crawler->filter('service > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('service > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('service > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('service > entrypoint')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{32}$/', $crawler->filter('service > entrypoint > id')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('service > entrypoint > title')->count());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('service > entrypoint > link[rel="self"]')->count());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('service > entrypoint > link[rel="service"]')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('service > entrypoint > updated')->text());
    }
    // }}}

    // {{{ testEntrypointRouteCheckResponseWithDebug
    /**
     * Test the route "Entrypoint" to check the Response with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testEntrypointRouteCheckResponseWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals(1, $crawler->filter('service')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{32}$/', $crawler->filter('service > id')->text());
        $this->assertRegExp('/^Fabio Cicerchia API - .+$/', $crawler->filter('service > title')->text());
        $this->assertEquals(1, $crawler->filter('service > link[rel="self"]')->count());
        $this->assertEquals(1, $crawler->filter('service > link[rel="describedby"]')->count());
        $this->assertEquals(1, $crawler->filter('service > link[rel="author"]')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('service > updated')->text());
        $this->assertEquals('Fabio Cicerchia', $crawler->filter('service > author > name')->text());
        $this->assertEquals('http://www.fabiocicerchia.it', $crawler->filter('service > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('service > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('service > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('service > entrypoint')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{24}$/', $crawler->filter('service > entrypoint > id')->text());
        $this->assertEquals(1, $crawler->filter('service > entrypoint > title')->count());
        $this->assertEquals(1, $crawler->filter('service > entrypoint > link[rel="self"]')->count());
        $this->assertEquals(1, $crawler->filter('service > entrypoint > link[rel="service"]')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('service > entrypoint > updated')->text());
    }
    // }}}

    // {{{ testEntrypointRouteCheckCache
    /**
     * Test the route "Entrypoint" to check the Cache.
     *
     * @return void
     */
    public function testEntrypointRouteCheckCache()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/');

        // TODO
    }
    // }}}

    // {{{ testEntrypointRouteCheckCacheWithDebug
    /**
     * Test the route "Entrypoint" to check the Cache with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testEntrypointRouteCheckCacheWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/');

        // TODO
    }
    // }}}

    // {{{ testEntrypointRouteCheckWithoutData
    /**
     * Test the route "Entrypoint" to check without data.
     *
     * @return void
     */
    public function testEntrypointRouteCheckWithoutData()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/');

        // TODO: WHAT?
    }
    // }}}

    // {{{ testEntrypointRouteCheckWrongHttpMethod
    /**
     * Test the route "Entrypoint" to check the Response with a wrong HTTP Method.
     *
     * @param string $httpMethod The invalid HTTP Method.
     *
     * @dataProvider providerInvalidHttpMethods
     * @return void
     */
    public function testEntrypointRouteCheckWrongHttpMethod($httpMethod)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testEntrypointRouteCheckWrongHttpMethodWithDebug
    /**
     * Test the route "Entrypoint" to check the Response with a wrong HTTP Method with Debug flag enabled.
     *
     * @param string $httpMethod The invalid HTTP Method.
     *
     * @dataProvider providerInvalidHttpMethods
     * @depends setUpDebug
     * @return void
     */
    public function testEntrypointRouteCheckWrongHttpMethodWithDebug($httpMethod)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testEntrypointRouteCheckCharset
    /**
     * Test the route "Entrypoint" to check the Charset.
     *
     * @return void
     */
    public function testEntrypointRouteCheckCharset()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals('UTF-8', $client->getResponse()->getCharset());
    }
    // }}}

    // {{{ testInformationRouteCheckStatusCode
    /**
     * Test the route "Information" to check the HTTP Status Code.
     *
     * @return void
     */
    public function testInformationRouteCheckStatusCode()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/information');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testInformationRouteCheckMimetype
    /**
     * Test the route "Information" to check the MIME Type.
     *
     * @return void
     */
    public function testInformationRouteCheckMimetype()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/information');

        $this->assertEquals('application/vnd.ads+xml;v=1.0', $client->getResponse()->headers->get('Content-Type'));
    }
    // }}}

    // {{{ testInformationRouteCheckMimetypeWithDebug
    /**
     * Test the route "Information" to check the MIME Type with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testInformationRouteCheckMimetypeWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/information');

        $this->assertEquals('application/xml', $client->getResponse()->headers->get('Content-Type'));
    }
    // }}}

    // {{{ testInformationRouteCheckResponse
    /**
     * Test the route "Information" to check the Response.
     *
     * @return void
     */
    public function testInformationRouteCheckResponse()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/information');

        $this->assertEquals(1, $crawler->filter('entities')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{32}$/', $crawler->filter('entities > id')->text());
        $this->assertRegExp('/^Fabio Cicerchia API - .+$/', $crawler->filter('entities > title')->text());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="self"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="describedby"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="author"]')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > updated')->text());
        $this->assertEquals('Fabio Cicerchia', $crawler->filter('entities > author > name')->text());
        $this->assertEquals('http://www.fabiocicerchia.it', $crawler->filter('entities > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('entities > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('entities > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{32}$/', $crawler->filter('entities > entity > id')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > title')->text());
        $this->assertRegExp('/^.+$/m', $crawler->filter('entities > entity > summary')->text());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > entity > updated')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity > content')->count());
    }
    // }}}

    // {{{ testInformationRouteCheckResponseWithDebug
    /**
     * Test the route "Information" to check the Response with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testInformationRouteCheckResponseWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/information');

        $this->assertEquals(1, $crawler->filter('entities')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{32}$/', $crawler->filter('entities > id')->text());
        $this->assertRegExp('/^Fabio Cicerchia API - .+$/', $crawler->filter('entities > title')->text());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="self"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="describedby"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="author"]')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > updated')->text());
        $this->assertEquals('Fabio Cicerchia', $crawler->filter('entities > author > name')->text());
        $this->assertEquals('http://www.fabiocicerchia.it', $crawler->filter('entities > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('entities > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('entities > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{24}$/', $crawler->filter('entities > entity > id')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > title')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > summary')->text());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > entity > updated')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity > content')->count());
    }
    // }}}

    // {{{ testInformationRouteCheckCache
    /**
     * Test the route "Information" to check the Cache.
     *
     * @return void
     */
    public function testInformationRouteCheckCache()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/information');

        // TODO
    }
    // }}}

    // {{{ testInformationRouteCheckCacheWithDebug
    /**
     * Test the route "Information" to check the Cache with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testInformationRouteCheckCacheWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/information');

        // TODO
    }
    // }}}

    // {{{ testInformationRouteCheckWithoutData
    /**
     * Test the route "Information" to check without data.
     *
     * @return void
     */
    public function testInformationRouteCheckWithoutData()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/information');

        // TODO: WHAT?
    }
    // }}}

    // {{{ testInformationRouteCheckWrongHttpMethod
    /**
     * Test the route "Information" to check the Response with a wrong HTTP Method.
     *
     * @param string $httpMethod The invalid HTTP Method.
     *
     * @dataProvider providerInvalidHttpMethods
     * @return void
     */
    public function testInformationRouteCheckWrongHttpMethod($httpMethod)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/information');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testInformationRouteCheckWrongHttpMethodWithDebug
    /**
     * Test the route "Information" to check the Response with a wrong HTTP Method with Debug flag enabled.
     *
     * @param string $httpMethod The invalid HTTP Method.
     *
     * @dataProvider providerInvalidHttpMethods
     * @depends setUpDebug
     * @return void
     */
    public function testInformationRouteCheckWrongHttpMethodWithDebug($httpMethod)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/information');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testInformationtRouteCheckCharset
    /**
     * Test the route "Information" to check the Charset.
     *
     * @return void
     */
    public function testInformationRouteCheckCharset()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/information');

        $this->assertEquals('UTF-8', $client->getResponse()->getCharset());
    }
    // }}}

    // {{{ testEducationRouteCheckStatusCode
    /**
     * Test the route "Education" to check the HTTP Status Code.
     *
     * @return void
     */
    public function testEducationRouteCheckStatusCode()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/education');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testEducationRouteCheckMimetype
    /**
     * Test the route "Education" to check the MIME Type.
     *
     * @return void
     */
    public function testEducationRouteCheckMimetype()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/education');

        $this->assertEquals('application/vnd.ads+xml;v=1.0', $client->getResponse()->headers->get('Content-Type'));
    }
    // }}}

    // {{{ testEducationRouteCheckMimetypeWithDebug
    /**
     * Test the route "Education" to check the MIME Type with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testEducationRouteCheckMimetypeWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/education');

        $this->assertEquals('application/xml', $client->getResponse()->headers->get('Content-Type'));
    }
    // }}}

    // {{{ testEducationRouteCheckResponse
    /**
     * Test the route "Education" to check the Response.
     *
     * @return void
     */
    public function testEducationRouteCheckResponse()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/education');

        $this->assertEquals(1, $crawler->filter('entities')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{32}$/', $crawler->filter('entities > id')->text());
        $this->assertRegExp('/^Fabio Cicerchia API - .+$/', $crawler->filter('entities > title')->text());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="self"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="describedby"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="author"]')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > updated')->text());
        $this->assertEquals('Fabio Cicerchia', $crawler->filter('entities > author > name')->text());
        $this->assertEquals('http://www.fabiocicerchia.it', $crawler->filter('entities > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('entities > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('entities > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{24}$/', $crawler->filter('entities > entity > id')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > title')->text());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > entity > updated')->text());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > entity > published')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity > content')->count());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity > content > company')->count());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > content > company > title')->text());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > activities')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > activities > activity')->count());
    }
    // }}}

    // {{{ testEducationRouteCheckResponseWithDebug
    /**
     * Test the route "Education" to check the Response with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testEducationRouteCheckResponseWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/education');

        $this->assertEquals(1, $crawler->filter('entities')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{32}$/', $crawler->filter('entities > id')->text());
        $this->assertRegExp('/^Fabio Cicerchia API - .+$/', $crawler->filter('entities > title')->text());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="self"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="describedby"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="author"]')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > updated')->text());
        $this->assertEquals('Fabio Cicerchia', $crawler->filter('entities > author > name')->text());
        $this->assertEquals('http://www.fabiocicerchia.it', $crawler->filter('entities > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('entities > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('entities > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{24}$/', $crawler->filter('entities > entity > id')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > title')->text());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > entity > updated')->text());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > entity > published')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity > content')->count());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity > content > company')->count());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > content > company/title')->text());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > activities')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > activities/activity')->count());
    }
    // }}}

    // {{{ testEducationRouteCheckCache
    /**
     * Test the route "Education" to check the Cache.
     *
     * @return void
     */
    public function testEducationRouteCheckCache()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/education');

        // TODO
    }
    // }}}

    // {{{ testEducationRouteCheckCacheWithDebug
    /**
     * Test the route "Education" to check the Cache with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testEducationRouteCheckCacheWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/education');

        // TODO
    }
    // }}}

    // {{{ testEducationRouteCheckWithoutData
    /**
     * Test the route "Education" to check without data.
     *
     * @return void
     */
    public function testEducationRouteCheckWithoutData()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/education');

        // TODO: WHAT?
    }
    // }}}

    // {{{ testEducationRouteCheckWrongHttpMethod
    /**
     * Test the route "Education" to check the Response with a wrong HTTP Method.
     *
     * @param string $httpMethod The invalid HTTP Method.
     *
     * @dataProvider providerInvalidHttpMethods
     * @return void
     */
    public function testEducationRouteCheckWrongHttpMethod($httpMethod)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/education');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testEducationRouteCheckWrongHttpMethodWithDebug
    /**
     * Test the route "Education" to check the Response with a wrong HTTP Method with Debug flag enabled.
     *
     * @param string $httpMethod The invalid HTTP Method.
     *
     * @dataProvider providerInvalidHttpMethods
     * @depends setUpDebug
     * @return void
     */
    public function testEducationRouteCheckWrongHttpMethodWithDebug($httpMethod)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/education');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testEducationRouteCheckCharset
    /**
     * Test the route "Education" to check the Charset.
     *
     * @return void
     */
    public function testEducationRouteCheckCharset()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/education');

        $this->assertEquals('UTF-8', $client->getResponse()->getCharset());
    }
    // }}}

    // {{{ testExperienceRouteCheckStatusCode
    /**
     * Test the route "Experience" to check the HTTP Status Code.
     *
     * @return void
     */
    public function testExperienceRouteCheckStatusCode()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/experience');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testExperienceRouteCheckMimetype
    /**
     * Test the route "Experience" to check the MIME Type.
     *
     * @return void
     */
    public function testExperienceRouteCheckMimetype()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/experience');

        $this->assertEquals('application/vnd.ads+xml;v=1.0', $client->getResponse()->headers->get('Content-Type'));
    }
    // }}}

    // {{{ testExperienceRouteCheckMimetypeWithDebug
    /**
     * Test the route "Experience" to check the MIME Type with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testExperienceRouteCheckMimetypeWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/experience');

        $this->assertEquals('application/xml', $client->getResponse()->headers->get('Content-Type'));
    }
    // }}}

    // {{{ testExperienceRouteCheckResponse
    /**
     * Test the route "Experience" to check the Response.
     *
     * @return void
     */
    public function testExperienceRouteCheckResponse()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/experience');

        $this->assertEquals(1, $crawler->filter('entities')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{32}$/', $crawler->filter('entities > id')->text());
        $this->assertRegExp('/^Fabio Cicerchia API - .+$/', $crawler->filter('entities > title')->text());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="self"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="describedby"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="author"]')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > updated')->text());
        $this->assertEquals('Fabio Cicerchia', $crawler->filter('entities > author > name')->text());
        $this->assertEquals('http://www.fabiocicerchia.it', $crawler->filter('entities > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('entities > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('entities > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{24}$/', $crawler->filter('entities > entity > id')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > title')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > summary')->text());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > entity > updated')->text());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > entity > published')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity > content')->count());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity > content > company')->count());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > content > company > title')->text());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > activities')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > activities > activity')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > technologies')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > technologies > technology')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > tools')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > tools > tool')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > techniques')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > techniques > technique')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > methodologies')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > methodologies > methodology')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > title')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > summary')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > role')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > link[rel="related"]')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > updated')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > published')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > activities')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > activities > activity')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > techniques')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > techniques > technique')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > technologies')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > technologies > technology')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > tools')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > tools > tool')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > methodologies')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > methodologies > methodology')->count());
    }
    // }}}

    // {{{ testExperienceRouteCheckResponseWithDebug
    /**
     * Test the route "Experience" to check the Response with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testExperienceRouteCheckResponseWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/experience');

        $this->assertEquals(1, $crawler->filter('entities')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{32}$/', $crawler->filter('entities > id')->text());
        $this->assertRegExp('/^Fabio Cicerchia API - .+$/', $crawler->filter('entities > title')->text());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="self"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="describedby"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="author"]')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > updated')->text());
        $this->assertEquals('Fabio Cicerchia', $crawler->filter('entities > author > name')->text());
        $this->assertEquals('http://www.fabiocicerchia.it', $crawler->filter('entities > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('entities > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('entities > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{24}$/', $crawler->filter('entities > entity > id')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > title')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > summary')->text());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > entity > updated')->text());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > entity > published')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity > content')->count());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity > content > company')->count());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > content > company > title')->text());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > activities')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > activities > activity')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > technologies')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > technologies > technology')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > tools')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > tools > tool')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > techniques')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > techniques > technique')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > methodologies')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > methodologies > methodology')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > title')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > summary')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > role')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > link[rel="related"]')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > updated')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > published')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > activities')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > activities > activity')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > techniques')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > techniques > technique')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > technologies')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > technologies > technology')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > tools')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > tools > tool')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > methodologies')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > projects > project > methodologies > methodology')->count());
    }
    // }}}

    // {{{ testExperienceRouteCheckCache
    /**
     * Test the route "Experience" to check the Cache.
     *
     * @return void
     */
    public function testExperienceRouteCheckCache()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/experience');

        // TODO
    }
    // }}}

    // {{{ testExperienceRouteCheckCacheWithDebug
    /**
     * Test the route "Experience" to check the Cache with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testExperienceRouteCheckCacheWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/experience');

        // TODO
    }
    // }}}

    // {{{ testExperienceRouteCheckWithoutData
    /**
     * Test the route "Experience" to check without data.
     *
     * @return void
     */
    public function testExperienceRouteCheckWithoutData()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/experience');

        // TODO: WHAT?
    }
    // }}}

    // {{{ testExperienceRouteCheckWrongHttpMethod
    /**
     * Test the route "Experience" to check the Response with a wrong HTTP Method.
     *
     * @param string $httpMethod The invalid HTTP Method.
     *
     * @dataProvider providerInvalidHttpMethods
     * @return void
     */
    public function testExperienceRouteCheckWrongHttpMethod($httpMethod)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/experience');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testExperienceRouteCheckWrongHttpMethodWithDebug
    /**
     * Test the route "Experience" to check the Response with a wrong HTTP Method with Debug flag enabled.
     *
     * @param string $httpMethod The invalid HTTP Method.
     *
     * @dataProvider providerInvalidHttpMethods
     * @depends setUpDebug
     * @return void
     */
    public function testExperienceRouteCheckWrongHttpMethodWithDebug($httpMethod)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/experience');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testExperienceRouteCheckCharset
    /**
     * Test the route "Experience" to check the Charset.
     *
     * @return void
     */
    public function testExperienceRouteCheckCharset()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/experience');

        $this->assertEquals('UTF-8', $client->getResponse()->getCharset());
    }
    // }}}

    // {{{ testSkillRouteCheckStatusCode
    /**
     * Test the route "Skill" to check the HTTP Status Code.
     *
     * @return void
     */
    public function testSkillRouteCheckStatusCode()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/skill');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testSkillRouteCheckMimetype
    /**
     * Test the route "Skill" to check the MIME Type.
     *
     * @return void
     */
    public function testSkillRouteCheckMimetype()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/skill');

        $this->assertEquals('application/vnd.ads+xml;v=1.0', $client->getResponse()->headers->get('Content-Type'));
    }
    // }}}

    // {{{ testSkillRouteCheckMimetypeWithDebug
    /**
     * Test the route "Skill" to check the MIME Type with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testSkillRouteCheckMimetypeWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/skill');

        $this->assertEquals('application/xml', $client->getResponse()->headers->get('Content-Type'));
    }
    // }}}

    // {{{ testSkillRouteCheckResponse
    /**
     * Test the route "Skill" to check the Response.
     *
     * @return void
     */
    public function testSkillRouteCheckResponse()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/skill');

        $this->assertEquals(1, $crawler->filter('entities')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{32}$/', $crawler->filter('entities > id')->text());
        $this->assertRegExp('/^Fabio Cicerchia API - .+$/', $crawler->filter('entities > title')->text());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="self"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="describedby"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="author"]')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > updated')->text());
        $this->assertEquals('Fabio Cicerchia', $crawler->filter('entities > author > name')->text());
        $this->assertEquals('http://www.fabiocicerchia.it', $crawler->filter('entities > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('entities > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('entities > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{24}$/', $crawler->filter('entities > entity > id')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > title')->text());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > summary')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > entity > updated')->text());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills > skill')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills > skill > title')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills > skill > level')->count());
    }
    // }}}

    // {{{ testSkillRouteCheckResponseWithDebug
    /**
     * Test the route "Skill" to check the Response with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testSkillRouteCheckResponseWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/skill');

        $this->assertEquals(1, $crawler->filter('entities')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{32}$/', $crawler->filter('entities > id')->text());
        $this->assertRegExp('/^Fabio Cicerchia API - .+$/', $crawler->filter('entities > title')->text());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="self"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="describedby"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="author"]')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > updated')->text());
        $this->assertEquals('Fabio Cicerchia', $crawler->filter('entities > author > name')->text());
        $this->assertEquals('http://www.fabiocicerchia.it', $crawler->filter('entities > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('entities > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('entities > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{24}$/', $crawler->filter('entities > entity > id')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > title')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > summary')->text());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > entity > updated')->text());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills > skill')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills > skill > title')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills > skill > level')->count());
    }
    // }}}

    // {{{ testSkillRouteCheckCache
    /**
     * Test the route "Skill" to check the Cache.
     *
     * @return void
     */
    public function testSkillRouteCheckCache()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/skill');

        // TODO
    }
    // }}}

    // {{{ testSkillRouteCheckCacheWithDebug
    /**
     * Test the route "Skill" to check the Cache with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testSkillRouteCheckCacheWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/skill');

        // TODO
    }
    // }}}

    // {{{ testSkillRouteCheckWithoutData
    /**
     * Test the route "Skill" to check without data.
     *
     * @return void
     */
    public function testSkillRouteCheckWithoutData()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/skill');

        // TODO: WHAT?
    }
    // }}}

    // {{{ testSkillRouteCheckWrongHttpMethod
    /**
     * Test the route "Skill" to check the Response with a wrong HTTP Method.
     *
     * @param string $httpMethod The invalid HTTP Method.
     *
     * @dataProvider providerInvalidHttpMethods
     * @return void
     */
    public function testSkillRouteCheckWrongHttpMethod($httpMethod)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/skill');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testSkillRouteCheckWrongHttpMethodWithDebug
    /**
     * Test the route "Skill" to check the Response with a wrong HTTP Method with Debug flag enabled.
     *
     * @param string $httpMethod The invalid HTTP Method.
     *
     * @dataProvider providerInvalidHttpMethods
     * @depends setUpDebug
     * @return void
     */
    public function testSkillRouteCheckWrongHttpMethodWithDebug($httpMethod)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/skill');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testSkillRouteCheckCharset
    /**
     * Test the route "Skill" to check the Charset.
     *
     * @return void
     */
    public function testSkillRouteCheckCharset()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/skill');

        $this->assertEquals('UTF-8', $client->getResponse()->getCharset());
    }
    // }}}

    // {{{ testLanguageRouteCheckStatusCode
    /**
     * Test the route "Language" to check the HTTP Status Code.
     *
     * @return void
     */
    public function testLanguageRouteCheckStatusCode()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/language');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testLanguageRouteCheckMimetype
    /**
     * Test the route "Language" to check the MIME Type.
     *
     * @return void
     */
    public function testLanguageRouteCheckMimetype()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/language');

        $this->assertEquals('application/vnd.ads+xml;v=1.0', $client->getResponse()->headers->get('Content-Type'));
    }
    // }}}

    // {{{ testLanguageRouteCheckMimetypeWithDebug
    /**
     * Test the route "Language" to check the MIME Type with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testLanguageRouteCheckMimetypeWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/language');

        $this->assertEquals('application/xml', $client->getResponse()->headers->get('Content-Type'));
    }
    // }}}

    // {{{ testLanguageRouteCheckResponse
    /**
     * Test the route "Language" to check the Response.
     *
     * @return void
     */
    public function testLanguageRouteCheckResponse()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/language');

        $this->assertEquals(1, $crawler->filter('entities')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{32}$/', $crawler->filter('entities > id')->text());
        $this->assertRegExp('/^Fabio Cicerchia API - .+$/', $crawler->filter('entities > title')->text());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="self"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="describedby"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="author"]')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > updated')->text());
        $this->assertEquals('Fabio Cicerchia', $crawler->filter('entities > author > name')->text());
        $this->assertEquals('http://www.fabiocicerchia.it', $crawler->filter('entities > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('entities > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('entities > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{24}$/', $crawler->filter('entities > entity > id')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > title')->text());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > summary')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > entity > updated')->text());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills > skill')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills > skill > title')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills > skill > level')->count());
    }
    // }}}

    // {{{ testLanguageRouteCheckResponseWithDebug
    /**
     * Test the route "Language" to check the Response with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testLanguageRouteCheckResponseWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/language');

        $this->assertEquals(1, $crawler->filter('entities')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{32}$/', $crawler->filter('entities > id')->text());
        $this->assertRegExp('/^Fabio Cicerchia API - .+$/', $crawler->filter('entities > title')->text());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="self"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="describedby"]')->count());
        $this->assertEquals(1, $crawler->filter('entities > link[rel="author"]')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > updated')->text());
        $this->assertEquals('Fabio Cicerchia', $crawler->filter('entities > author > name')->text());
        $this->assertEquals('http://www.fabiocicerchia.it', $crawler->filter('entities > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('entities > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('entities > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{24}$/', $crawler->filter('entities > entity > id')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > title')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > summary')->text());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > entity > updated')->text());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills > skill')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills > skill > title')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills > skill > level')->count());
    }
    // }}}

    // {{{ testLanguageRouteCheckCache
    /**
     * Test the route "Language" to check the Cache.
     *
     * @return void
     */
    public function testLanguageRouteCheckCache()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/language');

        // TODO
    }
    // }}}

    // {{{ testLanguageRouteCheckCacheWithDebug
    /**
     * Test the route "Language" to check the Cache with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testLanguageRouteCheckCacheWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/language');

        // TODO
    }
    // }}}

    // {{{ testLanguageRouteCheckWithoutData
    /**
     * Test the route "Language" to check without data.
     *
     * @return void
     */
    public function testLanguageRouteCheckWithoutData()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/language');

        // TODO: WHAT?
    }
    // }}}

    // {{{ testLanguageRouteCheckWrongHttpMethod
    /**
     * Test the route "Language" to check the Response with a wrong HTTP Method.
     *
     * @param string $httpMethod The invalid HTTP Method.
     *
     * @dataProvider providerInvalidHttpMethods
     * @return void
     */
    public function testLanguageRouteCheckWrongHttpMethod($httpMethod)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/language');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testLanguageRouteCheckWrongHttpMethodWithDebug
    /**
     * Test the route "Language" to check the Response with a wrong HTTP Method with Debug flag enabled.
     *
     * @param string $httpMethod The invalid HTTP Method.
     *
     * @dataProvider providerInvalidHttpMethods
     * @depends setUpDebug
     * @return void
     */
    public function testLanguageRouteCheckWrongHttpMethodWithDebug($httpMethod)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/language');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testLanguageRouteCheckCharset
    /**
     * Test the route "Language" to check the Charset.
     *
     * @return void
     */
    public function testLanguageRouteCheckCharset()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/language');

        $this->assertEquals('UTF-8', $client->getResponse()->getCharset());
    }
    // }}}

    // {{{ testApiDefinitionSyntaxRouteCheckStatusCode
    /**
     * Test the route "ApiDefinitionSyntax" to check the HTTP Status Code.
     *
     * @return void
     */
    public function testApiDefinitionSyntaxRouteCheckStatusCode()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/api-definition-syntax');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testApiDefinitionSyntaxRouteCheckMimetype
    /**
     * Test the route "api-definition-syntax" to check the MIME Type.
     *
     * @return void
     */
    public function testApiDefinitionSyntaxRouteCheckMimetype()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/api-definition-syntax');

        $this->assertEquals('text/plain; charset=UTF-8', $client->getResponse()->headers->get('Content-Type'));
    }
    // }}}

    // {{{ testApiDefinitionSyntaxRouteCheckMimetypeWithDebug
    /**
     * Test the route "api-definition-syntax" to check the MIME Type with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testApiDefinitionSyntaxRouteCheckMimetypeWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/api-definition-syntax');

        $this->assertEquals('application/xml', $client->getResponse()->headers->get('Content-Type'));
    }
    // }}}

    // {{{ testApiDefinitionSyntaxRouteCheckResponse
    /**
     * Test the route "api-definition-syntax" to check the Response.
     *
     * @return void
     */
    public function testApiDefinitionSyntaxRouteCheckResponse()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/api-definition-syntax');

        // TODO
    }
    // }}}

    // {{{ testApiDefinitionSyntaxRouteCheckResponseWithDebug
    /**
     * Test the route "api-definition-syntax" to check the Response with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testApiDefinitionSyntaxRouteCheckResponseWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/api-definition-syntax');

        // TODO
    }
    // }}}

    // {{{ testApiDefinitionSyntaxRouteCheckCache
    /**
     * Test the route "api-definition-syntax" to check the Cache.
     *
     * @return void
     */
    public function testApiDefinitionSyntaxRouteCheckCache()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/api-definition-syntax');

        // TODO
    }
    // }}}

    // {{{ testApiDefinitionSyntaxRouteCheckCacheWithDebug
    /**
     * Test the route "api-definition-syntax" to check the Cache with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function testApiDefinitionSyntaxRouteCheckCacheWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/api-definition-syntax');

        // TODO
    }
    // }}}

    // {{{ testApiDefinitionSyntaxRouteCheckWithoutData
    /**
     * Test the route "api-definition-syntax" to check without data.
     *
     * @return void
     */
    public function testApiDefinitionSyntaxRouteCheckWithoutData()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/api-definition-syntax');

        // TODO: WHAT?
    }
    // }}}

    // {{{ testApiDefinitionSyntaxRouteCheckWrongHttpMethod
    /**
     * Test the route "api-definition-syntax" to check the Response with a wrong HTTP Method.
     *
     * @param string $httpMethod The invalid HTTP Method.
     *
     * @dataProvider providerInvalidHttpMethods
     * @return void
     */
    public function testApiDefinitionSyntaxRouteCheckWrongHttpMethod($httpMethod)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/api-definition-syntax');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testApiDefinitionSyntaxRouteCheckWrongHttpMethodWithDebug
    /**
     * Test the route "api-definition-syntax" to check the Response with a wrong HTTP Method with Debug flag enabled.
     *
     * @param string $httpMethod The invalid HTTP Method.
     *
     * @dataProvider providerInvalidHttpMethods
     * @depends setUpDebug
     * @return void
     */
    public function testApiDefinitionSyntaxRouteCheckWrongHttpMethodWithDebug($httpMethod)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/api-definition-syntax');

        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ testApiDefinitionSyntaxRouteCheckCharset
    /**
     * Test the route "ApiDefinitionSyntax" to check the Charset.
     *
     * @return void
     */
    public function testApiDefinitionSyntaxRouteCheckCharset()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/api-definition-syntax');

        $this->assertEquals('UTF-8', $client->getResponse()->getCharset());
    }
    // }}}

    // {{{ test404RouteCheckStatusCode
    /**
     * Test the route "404" to check the HTTP Status Code.
     *
     * @return void
     */
    public function test404RouteCheckStatusCode()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/404');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ test404RouteCheckMimetype
    /**
     * Test the route "404" to check the MIME Type.
     *
     * @return void
     */
    public function test404RouteCheckMimetype()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/404');

        $this->assertEquals('text/html; charset=UTF-8', $client->getResponse()->headers->get('Content-Type'));
    }
    // }}}

    // {{{ test404RouteCheckMimetypeWithDebug
    /**
     * Test the route "404" to check the MIME Type with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function test404RouteCheckMimetypeWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/404');

        $this->assertEquals('application/xml', $client->getResponse()->headers->get('Content-Type'));
    }
    // }}}

    // {{{ test404RouteCheckResponse
    /**
     * Test the route "404" to check the Response.
     *
     * @return void
     */
    public function test404RouteCheckResponse()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/404');

        // TODO
    }
    // }}}

    // {{{ test404RouteCheckResponseWithDebug
    /**
     * Test the route "404" to check the Response with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function test404RouteCheckResponseWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/404');

        // TODO
    }
    // }}}

    // {{{ test404RouteCheckCache
    /**
     * Test the route "404" to check the Cache.
     *
     * @return void
     */
    public function test404RouteCheckCache()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/404');

        // TODO
    }
    // }}}

    // {{{ test404RouteCheckCacheWithDebug
    /**
     * Test the route "404" to check the Cache with Debug flag enabled.
     *
     * @depends setUpDebug
     * @return void
     */
    public function test404RouteCheckCacheWithDebug()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/404');

        // TODO
    }
    // }}}

    // {{{ test404RouteCheckWithoutData
    /**
     * Test the route "404" to check without data.
     *
     * @return void
     */
    public function test404RouteCheckWithoutData()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/404');

        // TODO: WHAT?
    }
    // }}}

    // {{{ test404RouteCheckWrongHttpMethod
    /**
     * Test the route "404" to check the Response with a wrong HTTP Method.
     *
     * @param string $httpMethod The invalid HTTP Method.
     *
     * @dataProvider providerInvalidHttpMethods
     * @return void
     */
    public function test404RouteCheckWrongHttpMethod($httpMethod)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/404');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ test404RouteCheckWrongHttpMethodWithDebug
    /**
     * Test the route "404" to check the Response with a wrong HTTP Method with Debug flag enabled.
     *
     * @param string $httpMethod The invalid HTTP Method.
     *
     * @dataProvider providerInvalidHttpMethods
     * @depends setUpDebug
     * @return void
     */
    public function test404RouteCheckWrongHttpMethodWithDebug($httpMethod)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/404');

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
    // }}}

    // {{{ test404RouteCheckCharset
    /**
     * Test the route "404" to check the Charset.
     *
     * @return void
     */
    public function test404RouteCheckCharset()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/404');

        $this->assertEquals('UTF-8', $client->getResponse()->getCharset());
    }
    // }}}
}
