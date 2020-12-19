<?php

namespace App\Contracts;

use App\Contracts\AvatarDriver;

interface AvatarRequest {

    /**
     * Set avatar provider.
     *
     * @param  AvatarDriver $provider
     * @return self
     */
    public function setProvider(AvatarDriver $provider);

    /**
     * Get avatar provider.
     *
     * @return AvatarDriver|null
     */
    public function getProvider();

    /**
     * Set username.
     *
     * @param  string $username
     * @return self
     */
    public function setUsername($username);

    /**
     * Get username.
     *
     * @return string|null
     */
    public function getUsername();

    /**
     * Set the avatar url.
     *
     * @param  string $url
     * @return self
     */
    public function setAvatarUrl($url);

    /**
     * Get the avatar url.
     *
     * @return self
     */
    public function getAvatarUrl();

    /**
     * Set the cached avatar url.
     *
     * @param  string $url
     * @return self
     */
    public function setCachedAvatarUrl($url);

    /**
     * Get cached avatar url.
     *
     * @return string|null
     */
    public function getCachedAvatarUrl();

    /**
     * Determine if the cached avatar url exists.
     *
     * @return bool
     */
    public function isAvatarUrlCached();
}
