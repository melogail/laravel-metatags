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

}