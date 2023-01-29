<?php

namespace App\Providers;

use App\Services\Response\ToolJsonResponseInterface;
use App\Services\Response\ToolJsonResponse;
use App\Services\Tools\ServerResponse\ServerResponseTool;
use App\Services\Tools\ServerResponse\ServerResponseToolInterface;
use App\Services\Tools\ServerResponse\View\ServerResponseHtmlView;
use App\Services\Tools\ServerResponse\View\ServerResponseHtmlViewInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // DI
        $this->app->bind(ServerResponseToolInterface::class, ServerResponseTool::class);
        $this->app->bind(ToolJsonResponseInterface::class, ToolJsonResponse::class);
        $this->app->bind(ServerResponseHtmlViewInterface::class, ServerResponseHtmlView::class);
    }
}
