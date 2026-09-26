<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class CaptureAttribution
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('GET') && !$request->is('admin*', 'login', 'forgot-password', 'reset-password*', 'up') && !$request->session()->has('attribution')) {
            $data = [];
            foreach (['utm_source','utm_medium','utm_campaign','utm_content','utm_term'] as $key) {
                if (is_string($request->query($key))) $data[$key] = mb_substr($request->query($key), 0, 190);
            }
            $request->session()->put('attribution', $data + ['landing_page' => $request->url()]);
        }
        return $next($request);
    }
}
