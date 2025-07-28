<?php declare(strict_types=1);

namespace JoeCianflone\ModelProperties;

use Illuminate\Support\ServiceProvider;

class ModelPropertiesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/ModelProperties.php' => config_path('modelproperties.php'),
        ]);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/modelproperties.php', 'modelproperties'
        );
    }
}
