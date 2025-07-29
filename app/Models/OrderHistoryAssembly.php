<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistoryAssembly extends Model
{
    use HasFactory;
    protected $fillable = [
        'assembly_id',
        'status_name',
        'admin_id',
    ];

    public function administration()
    {
        return $this->belongsTo(Administration::class, 'admin_id');
    }

    public function orderHistoryAssembly($assembly_id)
    {
        return $this->where('assembly_id', $assembly_id)->orderBy('id', 'desc')->get();
    }
}