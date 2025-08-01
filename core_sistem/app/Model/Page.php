<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Baum\Node;

class Page extends Node
{
    protected $table ="kk_pages";
    protected $orderColumn = 'sort_order';
    protected $guarded = array('id', 'parent_id', 'lidx', 'ridx', 'nesting');

    public function description()
    {
        return $this->hasMany('App\Model\PageDescription', 'page_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Model\Page', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Model\Page', 'parent_id');
    }
}
