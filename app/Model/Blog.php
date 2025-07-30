<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table ='kk_blogs';
    protected $guarded = [
        'id'
    ];

    public function description()
    {
        return $this->hasMany('App\Model\BlogDescription', 'blog_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    } 
     
}
