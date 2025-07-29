<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBanner extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_id',
        'title',
        'description',
        'href',
        'button',
        'image_desktop',
        'image_mobile',
    ];

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }

    public static function getList($banner_id)
    {
        return self::where('banner_id', $banner_id)->get();
    }
}
