<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCheck
{
    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     *
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->is_admin == true) {
            return $next($request);
        }

        return redirect()->route('auction.index')
            ->with('success', 'Nie masz dostępu do żądanej strony');
    }
}
