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

}