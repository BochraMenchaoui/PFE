<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

trait CacheUpdate
{
    /**
     * Updates cache when a user logout.
     *
     * @return void
     */
    public function updateCache()
    {
        $devices = Cache::get('connected-devices');
        $users   = Cache::get('online-users');

        foreach ((array)$devices as $key => $device) {
            if ($device['id'] === Session::getId()) {
                unset($devices[$key]);
            }
        }

        foreach ((array)$users as $key => $user) {
            if ($user['id'] === Auth::user()->id) {
                unset($users[$key]);
            }
        }

        Cache::put('online-users', $users, now()->addMinutes(10)); // TODO: fix, zeyed el addMinutes
        Cache::put('connected-devices', $devices);
    }

    public function getDevice()
    {
        $devices = Cache::get('connected-devices');
        foreach ((array)$devices as $key => $device) {
            if ($device['id'] === Session::getId()) {
                return $devices[$key];
            }
        }
    }
}
