<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Company extends Model
{
    use Sluggable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 
        'banner', 
        'logo', 
        'name', 
        'address', 
        'information', 
        'keyword', 
        'description', 
        'lat', 
        'lng', 
        'youtube_link', 
        'site_url', 
        'show_master', 
        'slug'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function products(){
        return $this->hasMany('App\Product');
    }
}
