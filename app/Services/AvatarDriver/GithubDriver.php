<?php

namespace App\Services\AvatarDriver;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use App\Contracts\AvatarDriver;

class GithubDriver implements AvatarDriver {

    /**
     * Github API Base URI.
     *
     * @var string $githubBaseUri
     */
    protected $githubBaseUri = 'https://api.github.com/';

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
            'base_uri' => $this->githubBaseUri,
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
            sprintf('users/%s', $username)
        );

        $parsedLookupResponse = json_decode($lookupResponse->getBody()->getContents(), true);

        return Arr::get($parsedLookupResponse, 'avatar_url');
    }
}
