<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Services\SyncTahunAjaranService;

class SyncTahunAjaranMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        SyncTahunAjaranService::sync();

        return $next($request);
    }
}