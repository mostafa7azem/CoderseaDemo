<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;

return [
    'logo' => [
        'normal' => 'dashboard-assets/images/logo.png',
        'large'  => 'dashboard-assets/images/logo.png',
    ],

    'default_image_path' => 'dashboard-assets/images/default.png',

    'user_model' => \App\Models\User::class,
    'user_table' => 'users',

    'routes' => [
        'login'  => 'dashboard.login',
        'home'   => 'dashboard.home',
        'logout' => 'dashboard.logout',
    ],

    'middlewares' => [
        'web',
    ],

    'auth-middlewares' => [
        'dashboard-auth'  => Authenticate::class,
        'dashboard-guest' => RedirectIfAuthenticated::class,
    ],

    'guard' => 'admins',
];
