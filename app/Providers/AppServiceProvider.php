<?php

namespace App\Providers;

use App\Services\Response\ToolJsonResponse;
use App\Services\Response\ToolJsonResponseImpl;
use App\Services\Tools\ServerResponse\ServerResponseToolImpl;
use App\Services\Tools\ServerResponse\ServerResponseTool;
use App\Services\Tools\ServerResponse\View\ServerResponseHtmlViewImpl;
use App\Services\Tools\ServerResponse\View\ServerResponseHtmlView;
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
        $this->app->bind(ServerResponseTool::class, ServerResponseToolImpl::class);
        $this->app->bind(ToolJsonResponse::class, ToolJsonResponseImpl::class);
        $this->app->bind(ServerResponseHtmlView::class, ServerResponseHtmlViewImpl::class);
    }
}
