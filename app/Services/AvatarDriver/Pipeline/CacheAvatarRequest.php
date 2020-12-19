<?php

namespace App\Services\AvatarDriver\Pipeline;

use Closure;
use App\Contracts\AvatarRequest;
use Illuminate\Support\Facades\Cache;

class CacheAvatarRequest {

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
            Cache::put($cachedAvatarKey, $avatarRequest->getAvatarUrl());
        }

        return $next($avatarRequest);
    }

}
