<?php

namespace UntangleDev\LaravelEnvMiddleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckEnvironment
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $environments
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $environments)
    {
        $environments = str_getcsv($environments);

        if (!app()->environment(...$environments)) {
            throw new HttpException(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
