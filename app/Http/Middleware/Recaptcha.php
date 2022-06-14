<?php

namespace App\Http\Middleware;

use ReCaptcha\ReCaptcha as GoogleRecaptcha;
use Closure;
use Illuminate\Http\Request;

class Recaptcha
{
    public function handle($request, Closure $next)
    {
        $response = (new GoogleRecaptcha(env('RECAPTCHA_SECRET_KEY')))
            ->verify($request->input('g-recaptcha-response'), $request->ip());

        if (!$response->isSuccess()) {
            return redirect()->back()->with('status', 'Recaptcha failed. Please try again.');
        }

        return $next($request);
    }
}
