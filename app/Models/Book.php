<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author',
        'descrip_1',
        'descrip_2',
        'descrip_3',
        'title_image',
        'image',
        'sort_order',
        'status'
    ];
}
