<?php

namespace App\Services\AvatarDriver\Facades;

use Illuminate\Support\Arr;
use App\Contracts\AvatarDriver;
use App\Contracts\AvatarRequest;
use App\Registries\AvatarDriverRegistry;
use App\Exceptions\ProviderNotFoundException;
use App\Services\AvatarDriver\Pipeline\CacheAvatarRequest;
use App\Services\AvatarDriver\Pipeline\ServeCachedAvatar;
use App\Services\AvatarDriver\Pipeline\ServeLiveAvatar;
use Illuminate\Pipeline\Pipeline;

class Avatar {

    /**
     * The AvatarDriverRegistry instance.
     *
     * @var  AvatarDriverRegistry $registry
     */
    protected $registry;

    /**
     * The AvatarDriver instance.
     *
     * @var  AvatarDriver $provider
     */
    protected $provider;

    /**
     * Build the controller instance.
     *
     * @param  AvatarDriverRegistry $registry
     * @return void
     */
    public function __construct(AvatarDriverRegistry $registry)
    {
        $this->registry = $registry;
    }

    /**
     * Set Avatar Provider.
     *
     * @param  string $provider
     * @return self
     * @throws ProviderNotFoundException
     */
    public function provider($provider)
    {
        if( ! $this->registry->has($provider) )
            throw new ProviderNotFoundException($provider);

        $this->provider          = $this->registry->get($provider);
        $this->providerReference = $provider;

        return $this;
    }

    /**
     * Get the avatar URL from the provider.
     *
     * @param  string $username
     * @return string
     */
    public function getAvatarUrl($username) {
        if( ! $this->provider instanceof AvatarDriver ) {
            $this->provider(
                Arr::random(array_keys($this->registry->all()))
            );
        }

        $avatarRequest  = app(AvatarRequest::class)
                            ->setProvider($this->provider)
                            ->setUsername($username);

        $avatarPipeline = app(Pipeline::class)
                            ->send($avatarRequest)
                            ->through([
                                ServeCachedAvatar::class,
                                ServeLiveAvatar::class,
                                CacheAvatarRequest::class,
                            ])
                            ->thenReturn();

        return $avatarPipeline->getAvatarUrl();
    }

    /**
     * Get the avatar url with the provider.
     *
     * @param  string $username
     * @return array
     */
    public function getAvatar($username, $provider = null) {
        if( ! is_null($provider) )
            $this->provider($provider);

        return [
            $this->getAvatarUrl($username),
            $this->providerReference,
            $this->provider
        ];
    }
}

