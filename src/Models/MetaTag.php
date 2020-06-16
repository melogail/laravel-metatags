<?php
/**
 * Author: Mohamed Elogail
 * Email: moh.elogail@gmail.com
 * Date: 16/01/2020
 * Time: 03:13 م
 */

namespace Melogail\LaravelMetaTags\Models;

use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{

    /**
     * Targeted table
     *
     * @var string
     */
    protected $table = 'metatags';


    /**
     * Mass assignment attributes
     *
     * @var array
     */
    protected $fillable = ['name', 'content', 'property'];


    /**
     * Casting dates attributes
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];


    /**
     * Guarded fields from mass assignment check
     *
     * @var array
     */
    protected $guarded = ['id', 'create_at', 'updated_at'];


    /**
     * Polymorphic relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * Return meta tags who has name attribute.
     * ex: <meta name="keywords" content="laravel, meta tags">
     *
     * @param $query
     * @return mixed
     */
    public function scopeHasName($query)
    {
        return $query->get(['name', 'content']);
    }

    /**
     * Return meta tags which have property attribute
     * ex: Open Graph -> <meta property="og:author" content="John Doe" >
     *
     * @param $query
     * @return mixed
     */
    public function scopeHasProperty($query)
    {
        return $query->get(['property', 'content']);
    }

    /**
     * Return specific name attribute for entity
     *
     * @param $query
     * @param $name
     * @return mixed
     */
    public function scopeName($query, $name)
    {
        return $query->where('name', $name)->first();
    }


    /**
     * Return specific property attribute for entity
     *
     * @param $query
     * @param $property
     * @return mixed
     */
    public function scopeProperty($query, $property)
    {
        return $query->where('property', $property)->first();
    }

}