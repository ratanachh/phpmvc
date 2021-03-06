<?php

namespace App\Config;

use App\Providers\LanguageProvider;
use App\Providers\RouterProvider;
use App\Providers\ConfigProvider;
use App\Providers\CookieProvider;
use App\Providers\LoaderProvider;
use App\Providers\SecurityProvider;
use App\Providers\SessionProvider;

return [
    ConfigProvider::class,
    SecurityProvider::class,
    LoaderProvider::class,
    RouterProvider::class,
    SessionProvider::class,
    CookieProvider::class,
    LanguageProvider::class
];