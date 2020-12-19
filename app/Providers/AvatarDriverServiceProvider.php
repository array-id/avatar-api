<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Registries\AvatarDriverRegistry;
use App\Services\AvatarDriver\AvatarRequest;
use App\Contracts\AvatarRequest as AvatarRequestContract;

class AvatarDriverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AvatarDriverRegistry::class);
        $this->app->bind(
            AvatarRequestContract::class,
            AvatarRequest::class
        );

        $this->discoverAvatarDrivers();
    }

    /**
     * Auto-register AvatarDriver instance.
     *
     * @return void
     */
    protected function discoverAvatarDrivers() {
        $drivers = config('avatar-driver');

        if( ! is_array($drivers) ) return;

        foreach($drivers as $key => $driverNamespace) {
            $this->app->make(AvatarDriverRegistry::class)->register(
                $key, app($driverNamespace)
            );
        }
    }
}
