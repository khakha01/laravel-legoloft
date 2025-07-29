<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'image',
        'image_2',
        'image_3',
        'slug',
        'description',
        'sort_order',
        'status',
        'parent_id',
        'status_section'
    ];

    public function categories_children()
    {
        return $this->hasMany(Categories::class, 'parent_id');
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'category_id')->where('status', 1);
    }

    public function categoryAll()
    {
        return $this->orderBy('id', 'desc')->get();
    }

    public function categoryTotal()
    {
        return $this->whereNotNull('parent_id')->where('status', 1)->orderBy('id', 'desc')->get();
    }

    public function categoryChoose()
    {
        return $this->where('choose', 1)->orderBy('id', 'desc')->inRandomOrder()->limit(3)->get();
    }

    public function searchCategory($filter_name, $filter_category_id)
    {
        $query = $this->query();

        if (!is_null($filter_name)) {
            $query->where('name', 'LIKE', "%{$filter_name}%");
        }

        if (!is_null($filter_category_id)) {
            $query->where('id', '=', (int)$filter_category_id);
        }

        return $query->paginate(10);
    }

    public function countCategoryAll()
    {
        return $this->count();
    }

    public function categoryDad($id)
    {
        return $this->where('parent_id', $id)->count();
    }
}
