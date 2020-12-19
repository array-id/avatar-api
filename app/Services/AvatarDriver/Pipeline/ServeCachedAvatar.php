<?php

namespace App\Services\AvatarDriver\Pipeline;

use Closure;
use App\Contracts\AvatarRequest;
use Illuminate\Support\Facades\Cache;

class ServeCachedAvatar {

    /**
     * Handle the AvatarRequest instance.
     *
     * @param  AvatarRequest $avatarRequest
     * @param  Closure       $next
     * @return Closure
     */
     public function handle(AvatarRequest $avatarRequest, Closure $next) {

        $cachedAvatarKey = md5(
            sprintf("%s.%s", get_class($avatarRequest->getProvider()), $avatarRequest->getUsername())
        );

        if( ! $avatarRequest->isAvatarUrlCached() ) {

            if( Cache::has($cachedAvatarKey) ) {
                $avatarRequest->setCachedAvatarUrl(Cache::get($cachedAvatarKey))
                              ->setAvatarUrl(Cache::get($cachedAvatarKey));
            }
        }

        return $next($avatarRequest);
    }

}
