<?php

namespace App\Contracts;

interface AvatarDriver {

    /**
     * Retrieve avatar url from provider.
     *
     * @param  string $username
     * @return string
     */
    public function getAvatarUrl($username);
}
