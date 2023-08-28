<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     * These middleware are run during every request to your application.
     */
    protected $middleware = [
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\ApplyCspRules::class,
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \App\Http\Middleware\PreventAuthenticatedResponseCaching::class,
            \App\Http\Middleware\CheckEmailConfirmed::class,
            \App\Http\Middleware\RunThemeActions::class,
            \App\Http\Middleware\Localization::class,
        ],
        'api' => [
            \App\Http\Middleware\ThrottleApiRequests::class,
            \App\Http\Middleware\EncryptCookies::class,
            \App\Http\Middleware\StartSessionIfCookieExists::class,
            \App\Http\Middleware\ApiAuthenticate::class,
            \App\Http\Middleware\PreventAuthenticatedResponseCaching::class,
            \App\Http\Middleware\CheckEmailConfirmed::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'       => \App\Http\Middleware\Authenticate::class,
        'can'        => \App\Http\Middleware\CheckUserHasPermission::class,
        'guest'      => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'   => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'guard'      => \App\Http\Middleware\CheckGuard::class,
        'mfa-setup'  => \App\Http\Middleware\AuthenticatedOrPendingMfa::class,
    ];
}
