<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Avatar extends Facade {

    /**
     * Return the container binding for this facade.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'avatar';
    }
}
