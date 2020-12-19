<?php

namespace App\Services\AvatarDriver;

use App\Contracts\AvatarDriver;

class GravatarDriver implements AvatarDriver {

    /**
     * Gravatar URL.
     *
     * @var  string $gravatarUrl
     */
    protected $gravatarUrl = 'https://www.gravatar.com/avatar';

    /**
     * Retrieve avatar url from provider.
     *
     * @param  string $username
     * @return string
     */
    public function getAvatarUrl($username) {
        return sprintf("%s/%s", $this->gravatarUrl, md5($username));
    }

}
