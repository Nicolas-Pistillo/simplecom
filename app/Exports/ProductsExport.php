<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithMapping, WithHeadings
{
    protected $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->products;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Código',
            'Descripción breve',
            'Descripción',
            'Categoría',
            'Precio',
            '% Descuento',
            'Stock',
            'Venta mínima',
            'Venta máxima',
            'Dimensiones',
            'Peso (kg)'
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->code,
            $product->short_description,
            $product->description,
            $product->category->name,
            $product->price,
            "%$product->discount_percent",
            $product->stock,
            $product->min_selling,
            $product->max_selling,
            "$product->width x $product->height x $product->length",
            $product->weight
        ];
    }
}
