<?php

namespace App\Config;

use App\Providers\RouterProvider;
use App\Providers\ConfigProvider;
use App\Providers\LoaderProvider;
use App\Providers\SessionProvider;

return [
    ConfigProvider::class,
    LoaderProvider::class,
    RouterProvider::class,
    SessionProvider::class
];