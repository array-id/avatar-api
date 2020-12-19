<?php

namespace App\Services\AvatarDriver;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use App\Contracts\AvatarDriver;

class TwitterDriver implements AvatarDriver {

    /**
     * Twitter API Base URI.
     *
     * @var string $twitterBaseUri
     */
    protected $twitterBaseUri = 'https://api.twitter.com/2/';

    /**
     * The Client instance.
     *
     * @var Client $client
     */
    protected $client;

    /**
     * Build the driver instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $this->twitterBaseUri,
            'headers' => [
                'Authorization' => 'Bearer ' . config('services.twitter.bearer_token')
            ]
        ]);
    }

    /**
     * Retrieve avatar url from provider.
     *
     * @param  string $username
     * @return string
     */
    public function getAvatarUrl($username) {

        $lookupResponse = $this->client->get(
            sprintf('users/by/username/%s?user.fields=profile_image_url', $username)
        );

        $parsedLookupResponse = json_decode($lookupResponse->getBody()->getContents(), true);

        return Arr::get($parsedLookupResponse, 'data.profile_image_url');
    }

}
