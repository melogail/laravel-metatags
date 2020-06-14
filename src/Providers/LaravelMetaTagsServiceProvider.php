<?php
/**
 * Author: Mohamed Elogail
 * Email: moh.elogail@gmail.com
 * Date: 14/06/2020
 * Time: 12:39 م
 */

namespace Melogail\LaravelMetaTags\Providers;

use Illuminate\Support\ServiceProvider;
use Melogail\LaravelMetaTags\MetaTagsBuilder;


class LaravelMetaTagsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('MetaTags', function(){
            return new MetaTagsBuilder();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $timestamp = date('Y_m_d_His', time());
        $this->publishes([
            __DIR__ . '/../database/migrations/create_metatags_table.php' => $this->app->databasePath("/migrations/{$timestamp}_create_metatags_table.php")
        ], 'metatags_data');
    }
}