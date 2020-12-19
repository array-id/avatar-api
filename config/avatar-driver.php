<?php

/**
 * Discover all available AvatarDriver.
 *
 * @return array
 */

return [
    'twitter'  => App\Services\AvatarDriver\TwitterDriver::class,
    'github'   => App\Services\AvatarDriver\GithubDriver::class,
    'gravatar' => App\Services\AvatarDriver\GravatarDriver::class,
];
