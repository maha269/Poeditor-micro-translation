<?php

namespace NextApps\PoeditorSync;

use App\Providers\RouteServiceProvider;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use NextApps\PoeditorSync\Commands\DownloadCommand;
use NextApps\PoeditorSync\Commands\UploadCommand;
use NextApps\PoeditorSync\Poeditor\Poeditor;

class PoeditorRouteServiceProvider extends RouteServiceProvider
{
    protected $namespace='NextApps\PoeditorSync\Controllers';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        parent::boot();
        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');

    }
    public function register()
    {
        $this->commands([
            UploadCommand::class,
            DownloadCommand::class
        ]);
    }
    public function map()
    {
        $this->mapWebRoutes();
    }
    protected function mapWebRoutes()
    {
        Route::prefix('PoeditorSync\web')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(__DIR__ . '\..\routes\web.php');
    }

}
