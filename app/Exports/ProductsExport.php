<?php

namespace App\Exports;

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
            'Descripción',
            'Categoría',
            'Etiquetas',
            'Precio',
            'Descuento',
            'Stock',
            'Venta mínima',
            'Venta máxima',
            'Dimensiones (ancho x largo x alto)',
            'Peso (gramos)'
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->code,
            $product->description,
            $product->category->name,
            $product->tags->pluck('name')->implode(','),
            "$". priceFormat($product->price),
            $product->discount_percent ? "%$product->discount_percent" : "-",
            $product->stock,
            $product->min_sale,
            $product->max_sale ?? '-',
            "$product->width x $product->height x $product->length",
            $product->weight
        ];
    }
}
