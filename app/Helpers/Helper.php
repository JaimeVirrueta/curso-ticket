<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;

/**
 * Valida si la ruta actuva está siendo en uso
 * @param string $route
 * @param string #class
 * @return string
 */
function isRouteActive($route, $class = 'active')
{
    if ( Str::contains(Route::currentRouteName(), $route) ) {
        return $class;
    }

    return null;
}
