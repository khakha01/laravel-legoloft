<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoryArticle_id',
        'title',
        'image',
        'description_short',
        'description',
        'status',
        'admin_id'
    ];

    public function countArticleAdmin($admin_id)
    {
        return $this->where('admin_id', $admin_id)->count();
    }
    public function administration()
    {
        return $this->belongsTo(Administration::class, 'admin_id');
    }

    public function category()
    {
        return $this->belongsTo(CategoryArticle::class, 'categoryArticle_id');
    }
    public function categoryArticle()
    {
        return $this->belongsTo(CategoryArticle::class, 'categoryArticle_id');
    }

    public function articleAll()
    {
        return $this->where('status', '=', 1)->orderBy('id', 'desc')->limit(4)->inRandomOrder()->get();
    }

    public function articleById($categoryArticle_id)
    {
        return $this->where('categoryArticle_id', $categoryArticle_id)->orderBy('id', 'desc')->get();
    }

    public function countArticleAll()
    {
        return $this->count();
    }

    public function articalByAdmin($admin_id = null)
    {
        $query =  $this->orderBy('id', 'desc');
        if ($admin_id) {
            $query = $this->where('admin_id', $admin_id)->orderBy('id', 'desc');
        }
        return $query->paginate(8);
    }
}
