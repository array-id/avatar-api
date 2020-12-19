<?php

namespace App\Exceptions;

use Exception;

class ProviderNotFoundException extends Exception
{
    /**
     * Build the Exception class.
     *
     * @param  string $provider
     * @return Exception
     */
    public function __construct($provider)
    {
        return parent::__construct(
            sprintf("Avatar Provider with key [%s] doesn't exists.", $provider)
        );
    }

}
