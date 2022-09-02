<?php

namespace App\Http\Middleware;

use App\Http\Utility\ResponseFactory;
use App\Infrastructure\Jwt\Exception\JwtException;
use App\Infrastructure\Jwt\JwtService;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\App;

class Authenticate extends Middleware
{
    /**
     * @throws JwtException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        /** @var ResponseFactory $responseFactory */
        $responseFactory = App::make(ResponseFactory::class);
        /** @var JwtService $jwtService */
        $jwtService      = App::make(JwtService::class);

        /** @var string|null $token */
        $token = $request->header('Authorization');
        if (!is_string($token)) {
            return $responseFactory->error('Invalid token');
        }

        if (!preg_match('~Bearer (\w+)~', $token)) {
            return $responseFactory->error('Invalid token');
        }

        $token = substr($token, 8);
        $user  = $jwtService->decode($token);

        return $next($request);
    }
}
