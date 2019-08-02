<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;

class SocialController extends Controller
{
    /**
     * Create a redirect method to social
     *
     * @param $provider
     * @return void
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Return a callback method from social
     *
     * @param $provider
     * @return callback URL from social
     */
    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        $user = $this->createUser($getInfo,$provider);
        auth()->login($user);
        return redirect()->to('/home');
    }

    /**
     * @param $getInfo
     * @param $provider
     * @return mixed
     */
    function createUser($getInfo,$provider){
        $user = User::where('provider_id', $getInfo->id)->orwhere('email', $getInfo->email)->first();
        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'avatar' => !empty($getInfo->avatar) ? $getInfo->avatar : NULL,
            ]);
        } elseif (empty($user->avatar)) {
            $user->update([
                'avatar' => !empty($getInfo->avatar) ? $getInfo->avatar : NULL,
            ]);
        }

        return $user;
    }
}
