<?php

namespace App\Services\AvatarDriver\Pipeline;

use Closure;
use App\Contracts\AvatarRequest;

class ServeLiveAvatar {

    /**
     * Handle the AvatarRequest instance.
     *
     * @param  AvatarRequest $avatarRequest
     * @param  Closure       $next
     * @return Closure
     */
     public function handle(AvatarRequest $avatarRequest, Closure $next) {

        if( ! $avatarRequest->isAvatarUrlCached() )
            $avatarRequest->setAvatarUrl(
                $avatarRequest->getProvider()->getAvatarUrl($avatarRequest->getUsername())
            );

        return $next($avatarRequest);
    }

}
