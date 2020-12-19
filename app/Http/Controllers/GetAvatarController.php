<?php

namespace App\Http\Controllers;

use Avatar;
use Illuminate\Http\Request;

class GetAvatarController extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if( ! $request->has('username') )
            return response()->json(['message' => 'Please Provide Username.'], 400, [], JSON_PRETTY_PRINT);

        $provider = $request->provider;

        [$avatarUrl, $providerReference, $provider ] = Avatar::getAvatar($request->username, $provider);

        return response()->json([
            'avatar_url' => $avatarUrl,
            'provider'   => $providerReference
        ], 200, [], JSON_PRETTY_PRINT);
    }
}
