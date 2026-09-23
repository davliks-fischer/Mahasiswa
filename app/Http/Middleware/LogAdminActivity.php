<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class LogAdminActivity
{
    /**
     * Route yang udah dicatet lebih detail (before/after) sama ActivityLogObserver,
     * jadi ga usah dicatet ulang di sini biar ga dobel.
     */
    private array $sudahDiobserve = [
        'admin.dosen.store',
        'admin.dosen.update',
        'admin.mapel.store',
        'admin.mapel.plot',
    ];

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            $routeName = optional($request->route())->getName();

            if ($routeName && $routeName !== 'logout' && !in_array($routeName, $this->sudahDiobserve)) {
                $data = $request->except(['_token', '_method', 'password', 'password_confirmation']);

                $routeParams = $request->route()->parameters();
                if (!empty($routeParams)) {
                    $data['_route_params'] = $routeParams;
                }

                ActivityLog::create([
                    'user_id'    => Auth::id(),
                    'aksi'       => $this->generateLabel($routeName, $request->method()),
                    'route'      => $routeName,
                    'detail'     => !empty($data) ? $data : null,
                    'ip_address' => $request->ip(),
                ]);
            }
        }

        return $response;
    }

    private function generateLabel(string $routeName, string $method): string
    {
        $map = [
            // isi di sini kalau nanti ada route admin lain (yang modelnya BELUM di-observe)
            // dan lu mau kasih label custom yang lebih manusiawi
        ];

        return $map[$routeName] ?? ucfirst(strtolower($method)) . ' — ' . $routeName;
    }
}