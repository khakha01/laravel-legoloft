<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{

    public function collection()
    {
        return Product::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'slug',
            'price',
            'image',
            'description',
        ];
    }
}
