<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractWebTestCase extends WebTestCase
{
    /**
     * @param mixed[] $payload
     */
    protected function postRequest(string $uri, array $payload): Response
    {
        $client = static::createClient();

        $client->request(
            'POST',
            $uri,
            [],
            [],
            [
                'CONTENT_TYPE'          => 'application/json',
                'HTTP_ACCEPT'           => 'application/json',
            ],
            (string) \json_encode($payload, JSON_THROW_ON_ERROR)
        );

        return $client->getResponse();
    }
}
