<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next, $status)
    {
        $user = session('user');
        if (!$user || $user->status !== $status) {
            return redirect('/login')->with('error', "Anda harus login sebagai $status untuk mengakses halaman ini.");
        }
        return $next($request);
    }
}
