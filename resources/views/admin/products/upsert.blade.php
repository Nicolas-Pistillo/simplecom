@extends('layouts.dashboards.admin')

@section('title')
    Productos - {{ isset($product) ? 'Editar' : 'Nuevo' }}
@endsection

@section('content')

    @livewire('admin.products.upsert', ['product' => $product ?? false])

@endsection
