<?php

namespace App\Models;

use App\Models\SubBanner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'href',
        'button',
        'description2',
        'description3',
        'description4',
        'description5',
        'image_desktop',
        'image_mobile',
    ];

    public function subBanners()
    {
        return $this->hasMany(SubBanner::class);
    }

    public static function getList($banner_id)
    {
        return self::where('id', $banner_id)->get();
    }
}
