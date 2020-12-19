<?php

namespace App\Registries;

use App\Contracts\AvatarDriver;

class AvatarDriverRegistry {

    /**
     * Registered AvatarDriver Instances.
     *
     * @var array $drivers
     */
    protected $drivers = [];

    public function register($key, AvatarDriver $driver, $override = false) {
        if( $this->has($key) ) {
            $this->drivers[$key] = ($override) ? $driver : $this->get($key);
        }
        else
        {
            $this->drivers[$key] = $driver;
        }
    }

    /**
     * Determine if AvatarDriver with provided key exists.
     *
     * @param  string $key
     * @return bool
     */
    public function has($key) {
        return (bool) isset($this->drivers[$key]);
    }

    /**
     * Get AvatarDriver from the Registry.
     *
     * @param  string $key
     * @return AvatarDriver|null
     */
    public function get($key) {
        if( $this->has($key) ) return $this->drivers[$key];
    }

    /**
     * Get all registered AvatarDriver instances.
     *
     * @return array
     */
    public function all() {
        return $this->drivers;
    }
}
