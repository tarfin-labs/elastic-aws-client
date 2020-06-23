<?php

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
