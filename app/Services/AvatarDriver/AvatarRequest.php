<?php

namespace App\Services\AvatarDriver;

use App\Contracts\AvatarDriver;
use App\Contracts\AvatarRequest as AvatarRequestContract;

class AvatarRequest implements AvatarRequestContract {

    /**
     * Requested Avatar provider.
     *
     * @var  string $provider
     */
    protected $provider;

    /**
     * Requested Username.
     *
     * @var  string $username
     */
    protected $username;

    /**
     * Generated Avatar URL.
     *
     * @var  string $avatarUrl
     */
    protected $avatarUrl;

    /**
     * Cached Avatar URL.
     *
     * @var  string $cachedAvatarUrl
     */
    protected $cachedAvatarUrl;

    /**
     * Set avatar provider.
     *
     * @param  AvatarDriver $provider
     * @return self
     */
    public function setProvider(AvatarDriver $provider) {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get avatar provider.
     *
     * @return AvatarDriver|null
     */
    public function getProvider() {
        return $this->provider;
    }

    /**
     * Set username.
     *
     * @param  string $username
     * @return self
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string|null
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set the avatar url.
     *
     * @param  string $url
     * @return self
     */
    public function setAvatarUrl($url) {
        $this->avatarUrl = $url;

        return $this;
    }

    /**
     * Get the avatar url.
     *
     * @return self
     */
    public function getAvatarUrl() {
        return $this->avatarUrl;
    }

    /**
     * Set the cached avatar url.
     *
     * @param  string $url
     * @return self
     */
    public function setCachedAvatarUrl($url) {
        $this->cachedAvatarUrl = $url;

        return $this;
    }

    /**
     * Get cached avatar url.
     *
     * @return string|null
     */
    public function getCachedAvatarUrl() {
        return $this->cachedAvatarUrl;
    }

    /**
     * Determine if the cached avatar url exists.
     *
     * @return bool
     */
    public function isAvatarUrlCached() {
        return ! is_null($this->cachedAvatarUrl);
    }
}
