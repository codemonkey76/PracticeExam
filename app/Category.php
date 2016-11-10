<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id'];
    //protected $with = ['parent', 'sub_categories'];

    public function sub_categories()
    {
        // return $this->hasMany('App\Category','parent_id');
        // return $this->hasMany('App\Category', 'parent_id', 'id');
    }
    public function all_sub_categories()
    {
        // return $this->sub_categories()->with('all_sub_categories');
    }
    public function scopeRootCategories($q)
    {
        $q->has('parent_id','=',null);
    }
    public function parent()
    {
        // return $this->belongsTo('App\Category', 'parent_id');
    }
    // public function parent_rec()
    // {
    //     return $this->parent()->with('parent_rec');
    // }
    public static function level($category)
    {
        if ($category->parent_id==null)
            return 1;

        return Category::level(
            Category::findOrFail($category->parent_id))+1;
    }
}
