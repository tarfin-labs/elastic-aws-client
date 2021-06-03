<?php

namespace ElasticAwsClient;

use Elasticsearch\Client;
use Orchestra\Testbench\TestCase;

class ServiceProviderTest extends TestCase
{
    /**
     * @test
     *
     * @covers \ElasticAwsClient\ServiceProvider::register
     */
    public function test_client_is_registered(): void
    {
        (new ServiceProvider($this->app))->register();

        $client = $this->app->make(Client::class);
        $connection = $client->transport->getConnection();

        $this->assertInstanceOf(Client::class, $client);
        $this->assertSame('localhost', $connection->getHost());
        $this->assertSame(9200, $connection->getPort());
    }

    /**
     * @test
     *
     * @covers \ElasticAwsClient\ServiceProvider::boot
     */
    public function test_configuration_is_published(): void
    {
        (new ServiceProvider($this->app))->boot();

        $publishes = ServiceProvider::$publishes[ServiceProvider::class];

        $publishFrom = realpath(__DIR__ . '/../../config/elastic-aws-client.php');
        $publishTo = config_path('elastic-aws-client.php');

        $this->assertArrayHasKey($publishFrom, $publishes);
        $this->assertSame($publishTo, $publishes[$publishFrom]);
    }
}