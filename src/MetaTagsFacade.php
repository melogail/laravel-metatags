<?php


namespace Melogail\LaravelMetaTags;

use Illuminate\Support\Facades\Facade;


class MetaTagsFacade extends Facade
{

    /**
     * Get a registered name of the component
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'MetaTags';
    }

}