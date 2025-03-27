<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AvailableLink
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userLink = $request->route('userLink');

        if (!$userLink || $userLink->isDeleted() || $userLink->isExpired()) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return $next($request);
    }
}
