<?php


namespace Melogail\LaravelMetaTags\Traits;


use Melogail\LaravelMetaTags\Models\MetaTag;

trait MetaTaggable
{
    /**
     * Get all entity meta tags
     *
     * @return mixed
     */
    public function metaTags()
    {
        return $this->morphMany(MetaTag::class, 'model');
    }

    /**
     * Return meta tags who has name attribute.
     * ex: <meta name="keywords" content="laravel, meta tags">
     *
     * @return mixed
     */
    public function name()
    {
        return $this->metaTags()->get(['name', 'content']);
    }

    /**
     * Return meta tags which have property attribute
     * ex: Open Graph -> <meta property="og:author" content="John Doe" >
     *
     * @return mixed
     */
    public function property()
    {
        return $this->metaTags()->get(['property', 'content']);
    }
}