<?php

use Illuminate\Support\Str;

/**
 * Session configuration options.
 *
 * Changes to these config files are not supported by App and may break upon updates.
 * Configuration should be altered via the `.env` file or environment variables.
 * Do not edit this file unless you're happy to maintain any changes yourself.
 */

return [

    // Default session driver
    // Options: file, cookie, database, redis, memcached, array
    'driver' => env('SESSION_DRIVER', 'file'),

    // Session lifetime, in minutes
    'lifetime' => env('SESSION_LIFETIME', 120),

    // Expire session on browser close
    'expire_on_close' => false,

    // Encrypt session data
    'encrypt' => false,

    // Location to store session files
    'files' => storage_path('framework/sessions'),

    // Session Database Connection
    // When using the "database" or "redis" session drivers, you can specify a
    // connection that should be used to manage these sessions. This should
    // correspond to a connection in your database configuration options.
    'connection' => null,

    // Session database table, if database driver is in use
    'table' => 'sessions',

    // Session Cache Store
    // When using the "apc" or "memcached" session drivers, you may specify a
    // cache store that should be used for these sessions. This value must
    // correspond with one of the application's configured cache stores.
    'store' => null,

    // Session Sweeping Lottery
    // Some session drivers must manually sweep their storage location to get
    // rid of old sessions from storage. Here are the chances that it will
    // happen on a given request. By default, the odds are 2 out of 100.
    'lottery' => [2, 100],

    // Session Cookie Name
    // Here you may change the name of the cookie used to identify a session
    // instance by ID. The name specified here will get used every time a
    // new session cookie is created by the framework for every driver.
    'cookie' => env('SESSION_COOKIE_NAME', 'bookstack_session'),

    // Session Cookie Path
    // The session cookie path determines the path for which the cookie will
    // be regarded as available. Typically, this will be the root path of
    // your application but you are free to change this when necessary.
    'path' => '/' . (explode('/', env('APP_URL', ''), 4)[3] ?? ''),

    // Session Cookie Domain
    // Here you may change the domain of the cookie used to identify a session
    // in your application. This will determine which domains the cookie is
    // available to in your application. A sensible default has been set.
    'domain' => env('SESSION_DOMAIN', null),

    // HTTPS Only Cookies
    // By setting this option to true, session cookies will only be sent back
    // to the server if the browser has a HTTPS connection. This will keep
    // the cookie from being sent to you if it can not be done securely.
    'secure' => env('SESSION_SECURE_COOKIE', null)
        ?? Str::startsWith(env('APP_URL', ''), 'https:'),

    // HTTP Access Only
    // Setting this value to true will prevent JavaScript from accessing the
    // value of the cookie and the cookie will only be accessible through the HTTP protocol.
    'http_only' => true,

    // Same-Site Cookies
    // This option determines how your cookies behave when cross-site requests
    // take place, and can be used to mitigate CSRF attacks. By default, we
    // do not enable this as other CSRF protection services are in place.
    // Options: lax, strict, none
    'same_site' => 'lax',
];
