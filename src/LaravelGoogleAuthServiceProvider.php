<?php

namespace JustYork\LaravelGoogleAuth;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use JustYork\LaravelGoogleAuth\Commands\LaravelGoogleAuthCommand;

class LaravelGoogleAuthServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-google-auth')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-google-auth_table')
            ->hasCommand(LaravelGoogleAuthCommand::class);
    }
}
