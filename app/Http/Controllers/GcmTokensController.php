<?php

namespace Davidmgilo\TodosBackend\Http\Controllers;

use Auth;
use Davidmgilo\TodosBackend\Events\GcmTokenCreated;
use Illuminate\Http\Request;

class GcmTokensController extends ChatBaseController
{
    /**
     * Add gcm token to user.
     */
    public function addToken(Request $request)
    {
        $user = Auth::user();
        $token = $user->gcmTokens()->firstOrCreate([
            'registration_id' => $request->input('registration_id')
        ]);
        //Broadcast
        broadcast(new GcmTokenCreated($user,$token))->toOthers();
        return ['status' => 'Token saved!'];
    }
}
