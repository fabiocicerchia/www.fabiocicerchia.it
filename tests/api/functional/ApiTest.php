<?php
/**
 * FABIO CICERCHIA - WEBSITE
 *
 * Copyright 2012 Fabio Cicerchia.
 *
 * Permission is hereby granted, free of  charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction,  including without limitation the rights
 * to use,  copy, modify,  merge, publish,  distribute, sublicense,  and/or sell
 * copies  of the  Software,  and to  permit  persons to  whom  the Software  is
 * furnished to do so, subject to the following conditions:
 *
 * The above  copyright notice and this  permission notice shall be  included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE  IS PROVIDED "AS IS",  WITHOUT WARRANTY OF ANY  KIND, EXPRESS OR
 * IMPLIED,  INCLUDING BUT  NOT LIMITED  TO THE  WARRANTIES OF  MERCHANTABILITY,
 * FITNESS FOR A  PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO  EVENT SHALL THE
 * AUTHORS  OR COPYRIGHT  HOLDERS  BE LIABLE  FOR ANY  CLAIM,  DAMAGES OR  OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * PHP Version 5.4
 *
 * @category  Test
 * @package   Api
 * @author    Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright 2012 Fabio Cicerchia.
 * @license   MIT <http://www.opensource.org/licenses/MIT>
 * @link      http://www.fabiocicerchia.it
 * @since     File available since Release 0.1
 */

require_once __DIR__ . '/../../../lib/vendor/autoload.php';

use Silex\WebTestCase;

/**
 * The Application Test Suite.
 *
 * @category   Test
 * @package    Api
 * @subpackage AppTest
 * @author     Fabio Cicerchia <info@fabiocicerchia.it>
 * @copyright  2012 Fabio Cicerchia. All Rights reserved.
 * @license    MIT <http://www.opensource.org/licenses/MIT>
 * @link       http://www.fabiocicerchia.it
 * @since      File available since Release 0.1
 *
 * @backupGlobals disabled
 */
class ApiTest extends WebTestCase
{
    // {{{ Methods - Public ====================================================
    // {{{ Method: createApplication -------------------------------------------
    /**
     * Return the instance of Silex\Application.
     *
     * ### General Information #################################################
     *
     * @since Version 0.1
     *
     * @return Silex\Application
     */
    public function createApplication()
    {
        $app = include TEST_ROOT_PATH . 'apps/api/logic/app.php';

        return $app;
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: provideUrl --------------------------------------------------
    /**
     * Data Provider to return a list of url.
     *
     * ### General Information #################################################
     *
     * @return array
     */
    public function provideUrl()
    {
        return [
            // Set #0 ----------------------------------------------------------
            ['/'],
            // Set #1 ----------------------------------------------------------
            ['/information'],
            // Set #2 ----------------------------------------------------------
            ['/education'],
            // Set #3 ----------------------------------------------------------
            ['/experience'],
            // Set #4 ----------------------------------------------------------
            ['/skill'],
            // Set #5 ----------------------------------------------------------
            ['/language'],
            // Set #6 ----------------------------------------------------------
            ['/api-definition-syntax'],
            // Set #7 ----------------------------------------------------------
            ['/404'],
        ];
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: provideStatusCode -------------------------------------------
    /**
     * Data Provider to return a list of URL and its status code.
     *
     * ### General Information #################################################
     *
     * @return array
     */
    public function provideStatusCode()
    {
        return [
            // Set #0 ----------------------------------------------------------
            ['/', 200],
            // Set #1 ----------------------------------------------------------
            ['/information', 200],
            // Set #2 ----------------------------------------------------------
            ['/education', 200],
            // Set #3 ----------------------------------------------------------
            ['/experience', 200],
            // Set #4 ----------------------------------------------------------
            ['/skill', 200],
            // Set #5 ----------------------------------------------------------
            ['/language', 200],
            // Set #6 ----------------------------------------------------------
            ['/api-definition-syntax', 200],
            // Set #7 ----------------------------------------------------------
            ['/404', 404],
        ];
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: provideMimeType ---------------------------------------------
    /**
     * Data Provider to return a list of URL and its mime type.
     *
     * ### General Information #################################################
     *
     * @return array
     */
    public function provideMimeType()
    {
        return [
            // Set #0 ----------------------------------------------------------
            ['/', 'application/vnd.ads+xml;v=1.0'],
            // Set #1 ----------------------------------------------------------
            ['/information', 'application/vnd.ads+xml;v=1.0'],
            // Set #2 ----------------------------------------------------------
            ['/education', 'application/vnd.ads+xml;v=1.0'],
            // Set #3 ----------------------------------------------------------
            ['/experience', 'application/vnd.ads+xml;v=1.0'],
            // Set #4 ----------------------------------------------------------
            ['/skill', 'application/vnd.ads+xml;v=1.0'],
            // Set #5 ----------------------------------------------------------
            ['/language', 'application/vnd.ads+xml;v=1.0'],
            // Set #6 ----------------------------------------------------------
            ['/api-definition-syntax', 'text/plain; charset=UTF-8'],
            // Set #7 ----------------------------------------------------------
            ['/404', 'text/html; charset=UTF-8'],
        ];
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: provideCache ------------------------------------------------
    /**
     * Data Provider to return a list of URL and its cache-control value.
     *
     * ### General Information #################################################
     *
     * ### General Information #################################################
     *
     * @return array
     */
    public function provideCache()
    {
        return [
            // Set #0 ----------------------------------------------------------
            ['/', 'no-cache'],
            // Set #1 ----------------------------------------------------------
            ['/information', 'max-age=28800, public, s-maxage=28800'],
            // Set #2 ----------------------------------------------------------
            ['/education', 'max-age=28800, public, s-maxage=28800'],
            // Set #3 ----------------------------------------------------------
            ['/experience', 'max-age=28800, public, s-maxage=28800'],
            // Set #4 ----------------------------------------------------------
            ['/skill', 'max-age=28800, public, s-maxage=28800'],
            // Set #5 ----------------------------------------------------------
            ['/language', 'max-age=28800, public, s-maxage=28800'],
            // Set #6 ----------------------------------------------------------
            ['/api-definition-syntax', 'no-cache'],
            // Set #7 ----------------------------------------------------------
            ['/404', 'no-cache'],
        ];
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: provideUrlLanguages -----------------------------------------
    /**
     * Data Provider to return a list of URL and its language value.
     *
     * ### General Information #################################################
     *
     * @return array
     */
    public function provideUrlLanguages()
    {
        return [
            // Set #0 ----------------------------------------------------------
            ['/', 'en'],
            // Set #1 ----------------------------------------------------------
            ['/information', 'it'],
            // Set #2 ----------------------------------------------------------
            ['/education', 'it'],
            // Set #3 ----------------------------------------------------------
            ['/experience', 'it'],
            // Set #4 ----------------------------------------------------------
            ['/skill', 'it'],
            // Set #5 ----------------------------------------------------------
            ['/language', 'it'],
            // Set #6 ----------------------------------------------------------
            ['/api-definition-syntax', 'en'],
        ];
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: provideInvalidHttpMethods -----------------------------------
    /**
     * Data Provider to return a list of URL and its cache-control value for
     * each HTTP method.
     *
     * ### General Information #################################################
     *
     * @return array
     */
    public function provideInvalidHttpMethods()
    {
        $httpMethods = [
            'POST',     'PUT',          'DELETE',
            'CONNECT',  'OPTIONS',      'PATCH',
            'PROPFIND', 'PROPPATCH',    'MKCOL',
            'COPY',     'MOVE',         'LOCK',
            'UNLOCK'
        ];

        $url = [
            // Set #0 ----------------------------------------------------------
            ['/', 405],
            // Set #1 ----------------------------------------------------------
            ['/information', 405],
            // Set #2 ----------------------------------------------------------
            ['/education', 405],
            // Set #3 ----------------------------------------------------------
            ['/experience', 405],
            // Set #4 ----------------------------------------------------------
            ['/skill', 405],
            // Set #5 ----------------------------------------------------------
            ['/language', 405],
            // Set #6 ----------------------------------------------------------
            ['/api-definition-syntax', 405],
            // Set #7 ----------------------------------------------------------
            ['/404', 404],
        ];

        $data = [];

        foreach ($httpMethods as $httpMethod) {
            foreach ($url as $elements) {
                $data[] = [$elements[0], $httpMethod, $elements[1]];
            }
        }

        return $data;
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testEveryRouteCheckStatusCode -------------------------------
    /**
     * Test all the routes to check the HTTP Status Code.
     *
     * ### General Information #################################################
     *
     * @param string  $url    The URL to be checked.
     * @param integer $status The HTTP status code.
     *
     * @dataProvider provideStatusCode
     *
     * @since Version 0.1
     *
     * @medium
     * @return void
     */
    public function testEveryRouteCheckStatusCode($url, $status)
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', $url);

        print_r($client->getResponse()->getContent());

        $this->assertEquals($status, $client->getResponse()->getStatusCode());
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testEveryRouteCheckMimetype ---------------------------------
    /**
     * Test all the routes to check the MIME Type.
     *
     * ### General Information #################################################
     *
     * @param string $url       The URL to be checked.
     * @param string $mime_type The MIME-Type to be checked.
     *
     * @dataProvider provideMimeType
     *
     * @since Version 0.1
     *
     * @return void
     */
    public function testEveryRouteCheckMimetype($url, $mime_type)
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', $url);

        $this->assertEquals($mime_type, $client->getResponse()->headers->get('Content-Type'));
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testEveryRouteCheckResponse ---------------------------------
    /**
     * Test all the routes to check the Response.
     *
     * ### General Information #################################################
     *
     * @medium
     * @since Version 0.1
     *
     * @return void
     */
    public function testEveryRouteCheckResponse()
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
        $this->assertEquals('http://localhost', $crawler->filter('service > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('service > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('service > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('service > entrypoint')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{32}$/', $crawler->filter('service > entrypoint > id')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('service > entrypoint > title')->count());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('service > entrypoint > link[rel="self"]')->count());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('service > entrypoint > link[rel="service"]')->count());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('service > entrypoint > updated')->text());
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testEveryRouteCheckCache ------------------------------------
    /**
     * Test all the routes to check the Cache.
     *
     * ### General Information #################################################
     *
     * @param string $url   The URL to be checked.
     * @param string $cache The cache value to be checked.
     *
     * @dataProvider provideCache
     *
     * @since Version 0.1
     *
     * @return void
     */
    public function testEveryRouteCheckCache($url, $cache)
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', $url);

        $this->assertEquals($cache, $client->getResponse()->headers->get('cache-control'));

        $etag = $client->getResponse()->headers->get('etag');
        if ($etag !== null) {
            $this->assertRegExp('/^"[0-9a-f]{32}"$/', $etag);
        }

        $last_modified = $client->getResponse()->headers->get('last-modified');
        if ($last_modified !== null) {
            $this->assertRegExp('/^.+$/', $last_modified);
        }
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testEveryRouteCheckWrongHttpMethod --------------------------
    /**
     * Test all the routes to check the Response with a wrong HTTP Method.
     *
     * ### General Information #################################################
     *
     * @param string  $url        The URL to be checked.
     * @param string  $httpMethod The invalid HTTP Method.
     * @param integer $status     The HTTP status code.
     *
     * @dataProvider provideInvalidHttpMethods
     * @since        Version 0.1
     *
     * @return void
     */
    public function testEveryRouteCheckWrongHttpMethod($url, $httpMethod, $status)
    {
        $client  = $this->createClient();
        $crawler = $client->request($httpMethod, $url);

        $this->assertEquals($status, $client->getResponse()->getStatusCode());
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testEveryRouteCheckCharset ----------------------------------
    /**
     * Test all the routes to check the Charset.
     *
     * ### General Information #################################################
     *
     * @param string $url The URL to be checked.
     *
     * @dataProvider provideUrl
     * @since Version 0.1
     *
     * @return void
     */
    public function testEveryRouteCheckCharset($url)
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', $url);

        $this->assertEquals('UTF-8', $client->getResponse()->getCharset());
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testEveryRouteCheckLanguage ---------------------------------
    /**
     * Test all the routes to check the Language.
     *
     * ### General Information #################################################
     *
     * @param string $url  The URL to be checked.
     * @param string $lang The language value to be checked.
     *
     * @dataProvider provideUrlLanguages
     *
     * @since Version 0.1
     *
     * @return void
     */
    public function testEveryRouteCheckLanguage($url, $lang)
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', $url, [], [], ['HTTP_ACCEPT_LANGUAGE' => 'it']);

        $this->assertEquals($lang, $client->getResponse()->headers->get('Content-Language'));

        $crawler = $client->request('GET', $url, [], [], ['HTTP_ACCEPT_LANGUAGE' => 'en']);

        $this->assertEquals('en', $client->getResponse()->headers->get('Content-Language'));
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testInformationRouteCheckResponse ---------------------------
    /**
     * Test the route "Information" to check the Response.
     *
     * ### General Information #################################################
     *
     * @medium
     * @since Version 0.1
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
        $this->assertEquals('http://localhost', $crawler->filter('entities > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('entities > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('entities > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{32}$/', $crawler->filter('entities > entity > id')->text());
        $this->assertRegExp('/^.+$/m', $crawler->filter('entities > entity > title')->text());
        $this->assertRegExp('/^.+$/m', $crawler->filter('entities > entity > summary')->text());
        $this->assertRegExp('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $crawler->filter('entities > entity > updated')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity > content')->count());
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testEducationRouteCheckResponse -----------------------------
    /**
     * Test the route "Education" to check the Response.
     *
     * ### General Information #################################################
     *
     * @medium
     * @since Version 0.1
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
        $this->assertEquals('http://localhost', $crawler->filter('entities > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('entities > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('entities > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{24}$/', $crawler->filter('entities > entity > id')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > title')->text());
        $this->assertRegExp('/^\s*\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z\s*$/m', $crawler->filter('entities > entity > updated')->text());
        $this->assertRegExp('/^\s*\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z\s*$/m', $crawler->filter('entities > entity > published')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity > content')->count());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity > content > company')->count());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > content > company > title')->text());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > activities')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > activities > activity')->count());
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testExperienceRouteCheckResponse ----------------------------
    /**
     * Test the route "Experience" to check the Response.
     *
     * ### General Information #################################################
     *
     * ### General Information #################################################
     *
     * @medium
     * @since Version 0.1
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
        $this->assertEquals('http://localhost', $crawler->filter('entities > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('entities > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('entities > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{24}$/', $crawler->filter('entities > entity > id')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > title')->text());
        $this->assertRegExp('/^\s*\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z\s*$/m', $crawler->filter('entities > entity > updated')->text());
        $this->assertRegExp('/^\s*\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z\s*$/m', $crawler->filter('entities > entity > published')->text());
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
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testSkillRouteCheckResponse ---------------------------------
    /**
     * Test the route "Skill" to check the Response.
     *
     * ### General Information #################################################
     *
     * @medium
     * @since Version 0.1
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
        $this->assertEquals('http://localhost', $crawler->filter('entities > author > uri')->text());
        $this->assertEquals('info@fabiocicerchia.it', $crawler->filter('entities > author > email')->text());
        $this->assertEquals('Copyright (c) 2012, Fabio Cicerchia', $crawler->filter('entities > rights')->text());
        $this->assertGreaterThanOrEqual(1, $crawler->filter('entities > entity')->count());
        $this->assertRegExp('/^urn:uuid:[0-9a-f]{24}$/', $crawler->filter('entities > entity > id')->text());
        $this->assertRegExp('/^.+$/', $crawler->filter('entities > entity > title')->text());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > summary')->count());
        $this->assertRegExp('/^\s*\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z\s*$/m', $crawler->filter('entities > entity > updated')->text());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills > skill')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills > skill > title')->count());
        $this->assertGreaterThanOrEqual(0, $crawler->filter('entities > entity > content > skills > skill > level')->count());
    }
    // }}} ---------------------------------------------------------------------

    // {{{ Method: testLanguageRouteCheckResponse ------------------------------
    /**
     * Test the route "Language" to check the Response.
     *
     * ### General Information #################################################
     *
     * @medium
     * @since Version 0.1
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
        $this->assertEquals('http://localhost', $crawler->filter('entities > author > uri')->text());
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
    // }}} ---------------------------------------------------------------------

    // {{{ Method: test404RouteCheckResponse -----------------------------------
    /**
     * Test the route "404" to check the Response.
     *
     * ### General Information #################################################
     *
     * @since Version 0.1
     *
     * @return void
     */
    public function test404RouteCheckResponse()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/404');

        $this->assertEquals('Error, you are unauthorised to know more about this.', $client->getResponse()->getContent());
    }
    // }}} ---------------------------------------------------------------------
    // }}} =====================================================================
}