<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class UserActivity {

    public function handle($request, Closure $next) {
        if (Auth::check()) {
            $expiresAt = Carbon::now()->addMinutes(5);
            Cache::put('user-is-online-' . Auth::id(), true, $expiresAt);
            UserProfile::find(Auth::id())->update(['offline_at' => Carbon::now()]);
        }

        return $next($request);
    }
}