<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * PHP Version 5.4
 *
 * @category  Test
 * @package   Api
 * @author    Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright 2012 Fabio Cicerchia. All Rights reserved.
 * @license   TBD <http://www.fabiocicerchia.it>
 * @link      http://www.fabiocicerchia.it
 */

require_once realpath(__DIR__ . '/../../../apps/api/silex.phar');

use Silex\WebTestCase;

/**
 * The Application Test Suite.
 *
 * @category   Test
 * @package    Api
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
     * @return void
     */
    public function testEntrypointRouteCheckMimetypeWithDebug()
    {
        $this->setUpDebug();

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
     * @return void
     */
    public function testEntrypointRouteCheckResponseWithDebug()
    {
        $this->setUpDebug();

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
        $this->assertEquals(1, $crawler->filter('service > entrypoint > link[rel="self"]')->count());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('service > entrypoint > link[rel="service"]')->count());
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

        $this->assertEquals('no-cache', $client->getResponse()->headers->get('cache-control'));
    }
    // }}}

    // {{{ testEntrypointRouteCheckCacheWithDebug
    /**
     * Test the route "Entrypoint" to check the Cache with Debug flag enabled.
     *
     * @return void
     */
    public function testEntrypointRouteCheckCacheWithDebug()
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request('GET', '/');

        $this->assertEquals('no-cache', $client->getResponse()->headers->get('cache-control'));
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
     * @expectedException Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
     * @expectedExceptionMessage No route found for
     * @return void
     */
    public function testEntrypointRouteCheckWrongHttpMethodWithDebug($httpMethod)
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/');
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

    // {{{ testEntrypointRouteCheckLanguage
    /**
     * Test the route "Entrypoint" to check the Language.
     *
     * @return void
     */
    public function testEntrypointRouteCheckLanguage()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/', [], [], ['HTTP_ACCEPT_LANGUAGE' => 'it']);

        $this->assertEquals('en', $client->getResponse()->headers->get('Content-Language'));

        $crawler = $client->request('GET', '/', [], [], ['HTTP_ACCEPT_LANGUAGE' => 'en']);

        $this->assertEquals('en', $client->getResponse()->headers->get('Content-Language'));
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
     * @return void
     */
    public function testInformationRouteCheckMimetypeWithDebug()
    {
        $this->setUpDebug();

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
     * @return void
     */
    public function testInformationRouteCheckResponseWithDebug()
    {
        $this->setUpDebug();

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

        $this->assertEquals('max-age=28800, public, s-maxage=28800', $client->getResponse()->headers->get('cache-control'));
        $this->assertRegExp('/^"[0-9a-f]{32}"$/', $client->getResponse()->headers->get('etag'));
        $this->assertRegExp('/^.+$/', $client->getResponse()->headers->get('last-modified'));
    }
    // }}}

    // {{{ testInformationRouteCheckCacheWithDebug
    /**
     * Test the route "Information" to check the Cache with Debug flag enabled.
     *
     * @return void
     */
    public function testInformationRouteCheckCacheWithDebug()
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request('GET', '/information');

        $this->assertEquals('no-cache', $client->getResponse()->headers->get('cache-control'));
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
     * @expectedException Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
     * @expectedExceptionMessage No route found for
     * @return void
     */
    public function testInformationRouteCheckWrongHttpMethodWithDebug($httpMethod)
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/information');
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

    // {{{ testInformationRouteCheckLanguage
    /**
     * Test the route "Information" to check the Language.
     *
     * @return void
     */
    public function testInformationRouteCheckLanguage()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/information', [], [], ['HTTP_ACCEPT_LANGUAGE' => 'it']);

        $this->assertEquals('it', $client->getResponse()->headers->get('Content-Language'));

        $crawler = $client->request('GET', '/information', [], [], ['HTTP_ACCEPT_LANGUAGE' => 'en']);

        $this->assertEquals('en', $client->getResponse()->headers->get('Content-Language'));
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
     * @return void
     */
    public function testEducationRouteCheckMimetypeWithDebug()
    {
        $this->setUpDebug();

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
     * @return void
     */
    public function testEducationRouteCheckResponseWithDebug()
    {
        $this->setUpDebug();

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

        $this->assertEquals('max-age=28800, public, s-maxage=28800', $client->getResponse()->headers->get('cache-control'));
        $this->assertRegExp('/^"[0-9a-f]{32}"$/', $client->getResponse()->headers->get('etag'));
        $this->assertRegExp('/^.+$/', $client->getResponse()->headers->get('last-modified'));
    }
    // }}}

    // {{{ testEducationRouteCheckCacheWithDebug
    /**
     * Test the route "Education" to check the Cache with Debug flag enabled.
     *
     * @return void
     */
    public function testEducationRouteCheckCacheWithDebug()
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request('GET', '/education');

        $this->assertEquals('no-cache', $client->getResponse()->headers->get('cache-control'));
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
     * @expectedException Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
     * @expectedExceptionMessage No route found for
     * @return void
     */
    public function testEducationRouteCheckWrongHttpMethodWithDebug($httpMethod)
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/education');
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

    // {{{ testEducationRouteCheckLanguage
    /**
     * Test the route "Education" to check the Language.
     *
     * @return void
     */
    public function testEducationRouteCheckLanguage()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/education', [], [], ['HTTP_ACCEPT_LANGUAGE' => 'it']);

        $this->assertEquals('it', $client->getResponse()->headers->get('Content-Language'));

        $crawler = $client->request('GET', '/education', [], [], ['HTTP_ACCEPT_LANGUAGE' => 'en']);

        $this->assertEquals('en', $client->getResponse()->headers->get('Content-Language'));
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
     * @return void
     */
    public function testExperienceRouteCheckMimetypeWithDebug()
    {
        $this->setUpDebug();

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
     * @return void
     */
    public function testExperienceRouteCheckResponseWithDebug()
    {
        $this->setUpDebug();

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
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > summary')->count());
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

        $this->assertEquals('max-age=28800, public, s-maxage=28800', $client->getResponse()->headers->get('cache-control'));
        $this->assertRegExp('/^"[0-9a-f]{32}"$/', $client->getResponse()->headers->get('etag'));
        $this->assertRegExp('/^.+$/', $client->getResponse()->headers->get('last-modified'));
    }
    // }}}

    // {{{ testExperienceRouteCheckCacheWithDebug
    /**
     * Test the route "Experience" to check the Cache with Debug flag enabled.
     *
     * @return void
     */
    public function testExperienceRouteCheckCacheWithDebug()
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request('GET', '/experience');

        $this->assertEquals('no-cache', $client->getResponse()->headers->get('cache-control'));
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
     * @expectedException Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
     * @expectedExceptionMessage No route found for
     * @return void
     */
    public function testExperienceRouteCheckWrongHttpMethodWithDebug($httpMethod)
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/experience');
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

    // {{{ testExperienceRouteCheckLanguage
    /**
     * Test the route "Experience" to check the Language.
     *
     * @return void
     */
    public function testExperienceRouteCheckLanguage()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/experience', [], [], ['HTTP_ACCEPT_LANGUAGE' => 'it']);

        $this->assertEquals('it', $client->getResponse()->headers->get('Content-Language'));

        $crawler = $client->request('GET', '/experience', [], [], ['HTTP_ACCEPT_LANGUAGE' => 'en']);

        $this->assertEquals('en', $client->getResponse()->headers->get('Content-Language'));
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
     * @return void
     */
    public function testSkillRouteCheckMimetypeWithDebug()
    {
        $this->setUpDebug();

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
     * @return void
     */
    public function testSkillRouteCheckResponseWithDebug()
    {
        $this->setUpDebug();

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

        $this->assertEquals('max-age=28800, public, s-maxage=28800', $client->getResponse()->headers->get('cache-control'));
        $this->assertRegExp('/^"[0-9a-f]{32}"$/', $client->getResponse()->headers->get('etag'));
        $this->assertRegExp('/^.+$/', $client->getResponse()->headers->get('last-modified'));
    }
    // }}}

    // {{{ testSkillRouteCheckCacheWithDebug
    /**
     * Test the route "Skill" to check the Cache with Debug flag enabled.
     *
     * @return void
     */
    public function testSkillRouteCheckCacheWithDebug()
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request('GET', '/skill');

        $this->assertEquals('no-cache', $client->getResponse()->headers->get('cache-control'));
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
     * @expectedException Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
     * @expectedExceptionMessage No route found for
     * @return void
     */
    public function testSkillRouteCheckWrongHttpMethodWithDebug($httpMethod)
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/skill');
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

    // {{{ testSkillRouteCheckLanguage
    /**
     * Test the route "Skill" to check the Language.
     *
     * @return void
     */
    public function testSkillRouteCheckLanguage()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/skill', [], [], ['HTTP_ACCEPT_LANGUAGE' => 'it']);

        $this->assertEquals('it', $client->getResponse()->headers->get('Content-Language'));

        $crawler = $client->request('GET', '/skill', [], [], ['HTTP_ACCEPT_LANGUAGE' => 'en']);

        $this->assertEquals('en', $client->getResponse()->headers->get('Content-Language'));
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
     * @return void
     */
    public function testLanguageRouteCheckMimetypeWithDebug()
    {
        $this->setUpDebug();

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
     * @return void
     */
    public function testLanguageRouteCheckResponseWithDebug()
    {
        $this->setUpDebug();

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

        $this->assertEquals('max-age=28800, public, s-maxage=28800', $client->getResponse()->headers->get('cache-control'));
        $this->assertRegExp('/^"[0-9a-f]{32}"$/', $client->getResponse()->headers->get('etag'));
        $this->assertRegExp('/^.+$/', $client->getResponse()->headers->get('last-modified'));
    }
    // }}}

    // {{{ testLanguageRouteCheckCacheWithDebug
    /**
     * Test the route "Language" to check the Cache with Debug flag enabled.
     *
     * @return void
     */
    public function testLanguageRouteCheckCacheWithDebug()
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request('GET', '/language');

        $this->assertEquals('no-cache', $client->getResponse()->headers->get('cache-control'));
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
     * @expectedException Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
     * @expectedExceptionMessage No route found for
     * @return void
     */
    public function testLanguageRouteCheckWrongHttpMethodWithDebug($httpMethod)
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/language');
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

    // {{{ testLanguageRouteCheckLanguage
    /**
     * Test the route "Language" to check the Language.
     *
     * @return void
     */
    public function testLanguageRouteCheckLanguage()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/language', [], [], ['HTTP_ACCEPT_LANGUAGE' => 'it']);

        $this->assertEquals('it', $client->getResponse()->headers->get('Content-Language'));

        $crawler = $client->request('GET', '/language', [], [], ['HTTP_ACCEPT_LANGUAGE' => 'en']);

        $this->assertEquals('en', $client->getResponse()->headers->get('Content-Language'));
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
     * @return void
     */
    public function testApiDefinitionSyntaxRouteCheckMimetypeWithDebug()
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request('GET', '/api-definition-syntax');

        $this->assertEquals('text/plain; charset=UTF-8', $client->getResponse()->headers->get('Content-Type'));
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

        $this->assertEquals('no-cache', $client->getResponse()->headers->get('cache-control'));
    }
    // }}}

    // {{{ testApiDefinitionSyntaxRouteCheckCacheWithDebug
    /**
     * Test the route "api-definition-syntax" to check the Cache with Debug flag enabled.
     *
     * @return void
     */
    public function testApiDefinitionSyntaxRouteCheckCacheWithDebug()
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request('GET', '/api-definition-syntax');

        $this->assertEquals('no-cache', $client->getResponse()->headers->get('cache-control'));
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
     * @expectedException Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
     * @expectedExceptionMessage No route found for
     * @return void
     */
    public function testApiDefinitionSyntaxRouteCheckWrongHttpMethodWithDebug($httpMethod)
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/api-definition-syntax');
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

    // {{{ testApiDefinitionSyntaxRouteCheckLanguage
    /**
     * Test the route "ApiDefinitionSyntax" to check the Language.
     *
     * @return void
     */
    public function testApiDefinitionSyntaxRouteCheckLanguage()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/api-definition-syntax', [], [], ['HTTP_ACCEPT_LANGUAGE' => 'it']);

        $this->assertEquals('en', $client->getResponse()->headers->get('Content-Language'));
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
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @expectedExceptionMessage No route found for "GET /404"
     * @return void
     */
    public function test404RouteCheckMimetypeWithDebug()
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request('GET', '/404');
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

        $this->assertEquals('No route found for "GET /404"', $client->getResponse()->getContent());
    }
    // }}}

    // {{{ test404RouteCheckResponseWithDebug
    /**
     * Test the route "404" to check the Response with Debug flag enabled.
     *
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @expectedExceptionMessage No route found for "GET /404"
     * @return void
     */
    public function test404RouteCheckResponseWithDebug()
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request('GET', '/404');
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

        $this->assertEquals('no-cache', $client->getResponse()->headers->get('cache-control'));
    }
    // }}}

    // {{{ test404RouteCheckCacheWithDebug
    /**
     * Test the route "404" to check the Cache with Debug flag enabled.
     *
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @expectedExceptionMessage No route found for "GET /404"
     * @return void
     */
    public function test404RouteCheckCacheWithDebug()
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request('GET', '/404');
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
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @expectedExceptionMessage No route found for
     * @return void
     */
    public function test404RouteCheckWrongHttpMethodWithDebug($httpMethod)
    {
        $this->setUpDebug();

        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, '/404');
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

    // {{{ test404RouteCheckLanguage
    /**
     * Test the route "404" to check the Language.
     *
     * @return void
     */
    public function test404RouteCheckLanguage()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/404', [], [], ['HTTP_ACCEPT_LANGUAGE' => 'it']);

        $this->assertEquals('en', $client->getResponse()->headers->get('Content-Language'));

        $crawler = $client->request('GET', '/404', [], [], ['HTTP_ACCEPT_LANGUAGE' => 'en']);

        $this->assertEquals('en', $client->getResponse()->headers->get('Content-Language'));
    }
    // }}}
}
