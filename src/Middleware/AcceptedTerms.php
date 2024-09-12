<?php

namespace Agencetwogether\TermsConditions\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;

class AcceptedTerms
{
    public function handle(Request $request, Closure $next)
    {
        //return $next($request);

        if (
            auth()->check() &&
            ! auth()->user()->hasAcceptedTerms() &&
            ! in_array($request->path(), config('terms-conditions.excluded_paths'))
        ) {
            $panel ??= Filament::getCurrentPanel()->getId();

            return redirect()->route("filament.{$panel}.terms");
        }

        return $next($request);
    }
}
