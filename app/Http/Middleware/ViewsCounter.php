<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ViewsCounter
{
    /*
        TODO:
            1. rodha ken l published
    */

    /**
     * Checks a user has seen the word yet.
     *
     * @param array $devices
     * @param string $id
     * @return bool
     */
    public function checkIfExists(array $viewsCount, string $ip, string $word_id)
    {
        foreach ($viewsCount as $view) {
            if ($view['ip'] == $ip && $view['word_id'] == $word_id)
                return true;
        }
        return false;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $viewsCount = Cache::get('views-count');
            if (empty($viewsCount)) {
                Cache::put(
                    'views-count',
                    [
                        [
                            'ip'      => $request->ip(),
                            'agent'   => $request->userAgent(),
                            'word_id' => $request->id,
                        ]
                    ],
                    now()->addMonth()
                );
                Word::find($request->id)?->increment('views_count');
                return $next($request);
            }

            if (!$this->checkIfExists($viewsCount, $request->ip(), $request->id)) {
                $viewsCount[] = [
                    'ip'      => $request->ip(),
                    'agent'   => $request->userAgent(),
                    'word_id' => $request->id,
                ];
                Word::find($request->id)?->increment('views_count');
                Cache::put('views-count', $viewsCount, now()->addMonth());
            }
        }

        return $next($request);
    }
}
