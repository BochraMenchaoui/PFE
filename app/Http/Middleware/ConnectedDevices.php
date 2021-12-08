<?php

namespace App\Http\Middleware;

use App\Notifications\AdminLoggedInLoggedOutNotification;
use Closure;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Throwable;

class ConnectedDevices
{
    /**
     * Checks if an online user has been cached.
     *
     * @param array $devices
     * @param string $id
     * @return bool
     */
    public function checkIfExists(array $devices, string $id)
    {
        foreach ($devices as $device) {
            if ($device['id'] === $id) {
                return true;
            }
        }
        return false;
    }


    /**
     * Returns the location of a given an ip
     *
     * @param string $ip
     * @return array|false
     */
    public function getLocation(string $ip): bool|array
    {
        try {
            $data = Http::get(Config::get('services.ip_api.host') . $ip)->json();
        } catch (Throwable $e) {
            return false;
        }

        if ($data['status'] === 'fail') {
            return false;
        }

        return [
            'country' => $data['country'],
            'city'    => $data['city'],
        ];
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (Auth::check()) {
            $agent = new Agent();
            $devices = Cache::get('connected-devices');
            if (empty($devices)) {
                Cache::put('connected-devices', [
                    [
                        'id'           => Session::getId(),
                        'ip'           => $request->ip(),
                        'browser'      => $agent->browser(),
                        'platform'     => $agent->platform(),
                        'country'      => $this->getLocation($request->ip()) ? $this->getLocation($request->ip())['country'] : '',
                        'city'         => $this->getLocation($request->ip()) ? $this->getLocation($request->ip())['city'] : '',
                        'connected_at' => now(),
                    ]
                ]);
            } else {
                if (!$this->checkIfExists(devices: $devices, id: Session::getId())) {
                    $devices[] = [
                        'id'           => Session::getId(),
                        'ip'           => $request->ip(),
                        'browser'      => $agent->browser(),
                        'platform'     => $agent->platform(),
                        'country'      => $this->getLocation(ip: $request->ip()) ? $this->getLocation($request->ip())['country'] : '',
                        'city'         => $this->getLocation(ip: $request->ip()) ? $this->getLocation($request->ip())['city'] : '',
                        'connected_at' => now(),
                    ];
                    Cache::put('connected-devices', $devices);
                    auth()->user()->notify(new AdminLoggedInLoggedOutNotification());
                }
            }
        }

        return $next($request);
    }
}
