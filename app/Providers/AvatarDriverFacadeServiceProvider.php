<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AvatarDriver\Facades\Avatar;

class AvatarDriverFacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('avatar', Avatar::class);
    }

}
