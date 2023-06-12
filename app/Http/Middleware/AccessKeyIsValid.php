<?php

namespace App\Http\Middleware;

use App\Managers\AccessKeyManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessKeyIsValid
{
    /**
     * @var AccessKeyManager $accessKeyManager
     */
    private $accessKeyManager;

    public function __construct(AccessKeyManager $accessKeyManager)
    {
        $this->accessKeyManager = $accessKeyManager;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->validate(['key'=>'required|string']);
        /**
         * @var string $key
         */
        $key = $request->input('key');

        if (!$key){
            return response()->json(['message'=>'Key is not passed'], 400);
        }

        $isKeyAlive = $this->accessKeyManager->isKeyAlive($key);
        if ($isKeyAlive){
            return $next($request);
        }
        return response()->json(['message'=>'Access key error'], 400);
    }
}
