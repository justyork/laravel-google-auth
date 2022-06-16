<?php

namespace JustYork\LaravelGoogleAuth\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \JustYork\LaravelGoogleAuth\LaravelGoogleAuth
 */
class LaravelGoogleAuth extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-google-auth';
    }
}
