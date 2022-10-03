<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test sign up of the API
 */
class SignUpTest extends WebTestCase
{
    /**
     * @dataProvider contentProvider
     */
    public function testSignUp($content, $requestedHttpCode): void
    {
        $client = static::createClient();
        // https://stackoverflow.com/questions/41713684/how-to-pass-json-in-post-method-with-phpunit-testing
        $crawler = $client->jsonRequest('POST', '/api/users', $content);
        
        $this->assertResponseStatusCodeSame($requestedHttpCode);
    }

    public function contentProvider()
    {
        return [
            // check if user will be registred with all the fields fulfilled correctly
            [ ["firstname" => "firstname",
               "lastname" => "lastname",
               "email" => "test@email.com",
               "password" => "password",
               "city"=> 6 ], 
            201 ],
            // check if user won't be registered with the non existent city id
            [ ["firstname" => "firstname",
               "lastname" => "lastname",
               "email" => "test2@email.com",
               "password" => "password",
               "city"=> 7 ], 
            400 ],
            // check if user won't be registered if email already exist in the db
            [ ["firstname" => "firstname",
               "lastname" => "lastname",
               "email" => "test@email.com",
               "password" => "password",
               "city"=> 1 ], 
            400 ],
            // check if user won't be registered without lastname
            [ ["firstname" => "firstname",
               "email" => "test3@email.com",
               "password" => "password",
               "city"=> 1 ], 
            400 ],
            // check if user won't be registered without firstname
            [ ["lastname" => "lastname",
               "email" => "test4@email.com",
               "password" => "password",
               "city"=> 1 ], 
            400 ],
            // check if user won't be registered without password
            [ ["firstname" => "firstname",
               "lastname" => "lastname",
               "email" => "test5@email.com",
               "city"=> 1 ], 
            400 ],
            // check if user won't be registered without password
            [ ["firstname" => "firstname",
               "lastname" => "lastname",
               "email" => "test6@email.com",
               "password" => "password"], 
            400 ],

        ];
    }
}

