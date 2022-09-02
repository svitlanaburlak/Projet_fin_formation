<?php

namespace App\Tests;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SmokeTest extends WebTestCase
{
    /**
     * @dataProvider httpUrlProvider
     */
    public function testSomething($url, $requestedHttpCode): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);

        $this->assertResponseStatusCodeSame($requestedHttpCode);
    }

    public function httpUrlProvider()
    {
        return [
            ['/login', 200],
            ['/admin', 302],
            ['/api/categories', 200],
            ['/api/posts', Response::HTTP_OK],
            ['/api/posts/1', Response::HTTP_OK],
            ['/api/cities', Response::HTTP_OK],
            ['/api/cities/2', Response::HTTP_OK],
            ['/api/cities/10', Response::HTTP_NOT_FOUND],
        ];
    }


}
