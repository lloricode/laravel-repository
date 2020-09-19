<?php

namespace Lloricode\LaravelRepository;

use Illuminate\Support\Facades\Facade;

/**
 * @mix \Lloricode\LaravelRepository\LaravelRepository
 */
class LaravelRepositoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-repository';
    }
}
