<?php
/**
 * Author: Mohamed Elogail
 * Email: moh.elogail@gmail.com
 * Date: 16/01/2020
 * Time: 03:13 م
 */

namespace Melogail\LaravelMetaTags\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return $query->get(['name', 'content'])->count() > 0;
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
        return $query->get(['property', 'content'])->count() > 0;
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
     * @return mixedex
     */
    public function scopeProperty($query, $property)
    {
        return $query->where('property', $property)->first();
    }


    /**
     * Update meta data
     *
     * @param $query
     * @param object $model
     * @param array $metaTags
     * @return mixed
     * @throws \Exception
     */
    public function scopeUpdateMetaTags($query, object $model, array $metaTags )
    {
        if (!is_object($model)) {
            throw new \Exception('$model must be an object of model class, ' . gettype($metaTags) . ' is given!');
        }

        if (!is_array($metaTags)) {
            throw new \Exception('$metaTags must be an array, ' . gettype($metaTags) . ' is given!');
        }

        // Create new metatags if not present
        if ($model->metaTags()->get()->count() == 0 ) {
            return $model->metaTags()->createMany($metaTags);
        }

        // If there is meta tags
        foreach ($metaTags as $metaTag) {

            if (isset($metaTag['name'])) {
                DB::table('metatags')->where(['name' => $metaTag['name'], 'model_type' => get_class($model), 'model_id' => $model->id])->update(['content' => $metaTag['content']]);

            } elseif ($metaTag['property']) {
                DB::table('metatags')->where(['name' => $metaTag['name'], 'model_type' => get_class($model), 'model_id' => $model->id])->update(['content' => $metaTag['content']]);

            } else {
                throw new \Exception('Data is now in proper format, Please revice your data!');
            }
        }
    }

}
