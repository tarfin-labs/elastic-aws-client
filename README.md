# Elastic AWS Client

The official PHP Elasticsearch client for AWS Elasticsearch Service integrated with Laravel.

## Contents

* [Compatibility](#compatibility)
* [Installation](#installation) 
* [Configuration](#configuration)
* [Usage](#usage)

## Compatibility

The current version of Elastic AWS Client has been tested with the following configuration:

* PHP 7.3 - 8.0 - 8.1
* Elasticsearch 7.x
* AWS-SDK-PHP ^3.80

## Installation

The library can be installed via Composer:

```bash
composer require tarfin-labs/elastic-aws-client
```

## Configuration

To change the client settings you need to publish the configuration file first:

```bash
php artisan vendor:publish --provider="ElasticAwsClient\ServiceProvider"
```

You can use a bunch of settings supported by [\Elasticsearch\ClientBuilder::fromConfig](https://www.elastic.co/guide/en/elasticsearch/client/php-api/current/configuration.html#_building_the_client_from_a_configuration_hash)
method in the `config/elastic-aws-client.php` file as this factory is used under the hood:

```php
return [
    'hosts' => [
        [
            'host'            => env('ELASTICSEARCH_HOST', 'localhost'),
            'port'            => env('ELASTICSEARCH_PORT', 9200),
            'scheme'          => env('ELASTICSEARCH_SCHEME', null),
            'user'            => env('ELASTICSEARCH_USER', null),
            'pass'            => env('ELASTICSEARCH_PASS', null),

            // AWS
            'aws'             => env('AWS_ELASTICSEARCH_ENABLED', false),
            'aws_region'      => env('AWS_DEFAULT_REGION', ''),
            'aws_key'         => env('AWS_ACCESS_KEY_ID', ''),
            'aws_secret'      => env('AWS_SECRET_ACCESS_KEY', ''),
            'aws_credentials' => null
        ],
    ],
    'sslVerification' => null,
    'retries' => null,
    'sniffOnStart' => false,
    'httpHandler' => null,
    'connectionPool' => null,
    'connectionSelector' => null,
    'serializer' => null,
    'connectionFactory' => null,
    'endpoint' => null,
    'namespaces' => [],
];
``` 

## Usage

Type hint `\Elasticsearch\Client` or use `resolve` function to retrieve the client instance in your code:

```php
namespace App\Console\Commands;

use Elasticsearch\Client;
use Illuminate\Console\Command;

class CreateIndex extends Command
{
    protected $signature = 'create:index {name}';

    protected $description = 'Creates an index';

    public function handle(Client $client)
    {
        $client->indices()->create([
            'index' => $this->argument('name')
        ]);
    }
}
```
