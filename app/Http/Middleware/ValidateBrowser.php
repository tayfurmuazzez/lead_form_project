<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;

class ValidateBrowser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $isDesktop = Agent::isDesktop();
        $browser = Agent::browser();
        $version = Agent::version($browser);
        $versionExplode = explode(".",$version);

        if($isDesktop){
            if(in_array($browser,["Chrome","Safari"])){
                if(($browser == "Chrome" && ($versionExplode[0] ?? 0) >= 108) ||
                    ($browser == "Safari" && ($versionExplode[0] ?? 0) >= 15)){
                    return $next($request);
                }else{
                    return response()->json('Lead Form not Support this '.$browser.' Version. Please Update your Browser');
                }
            }else{
                return response()->json('Lead Form not Support '.$browser.' Browser');
            }
        }else{
            return response()->json('Lead Form Support only Desktop Browser');
        }
    }
}
