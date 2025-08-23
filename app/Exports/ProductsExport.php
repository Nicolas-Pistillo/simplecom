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
            'Código',
            'Nombre',
            'Categoría',
            'Marca',
            'Descripción',
            'Etiquetas',
            'Precio',
            'Descuento',
            'Stock',
            'Compra mínima',
            'Compra máxima',
            'Dimensiones (ancho x alto x largo)',
            'Peso (gramos)'
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->code,
            $product->name,
            $product->category->name ?? '-',
            $product->brand->name ?? '-',
            strip_tags($product->description),
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
