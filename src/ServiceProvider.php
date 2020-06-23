<?php
declare(strict_types=1);

namespace ElasticAwsClient;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider as AbstractServiceProvider;

final class ServiceProvider extends AbstractServiceProvider
{
    /**
     * @var string
     */
    private $configPath;

    /**
     * Constructor.
     *
     * @param $app
     */
    public function __construct($app)
    {
        parent::__construct($app);

        $this->configPath = realpath(__DIR__ . '/../config/elastic-aws-client.php');
    }

    /**
     * {@inheritDoc}
     */
    public function register()
    {
        $this->mergeConfigFrom(
            $this->configPath,
            basename($this->configPath, '.php')
        );

        $this->app->singleton(Client::class, function () {
            $config = config('elastic-aws-client');
            return (new Factory())->make($config);
        });
    }

    /**
     * Boot.
     */
    public function boot()
    {
        $this->publishes([
            $this->configPath => config_path(basename($this->configPath))
        ]);
    }
}
