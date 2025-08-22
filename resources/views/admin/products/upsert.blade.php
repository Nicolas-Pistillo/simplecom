@extends('layouts.dashboards.admin')

@section('title')
    Productos - {{ isset($product) ? 'Editar' : 'Nuevo' }}
@endsection

@section('head')
    <link rel="stylesheet" href="//unpkg.com/jodit@4.1.16/es2021/jodit.min.css">
    <script src="//unpkg.com/jodit@4.1.16/es2021/jodit.min.js"></script>
@endsection

@section('content')

    @livewire('admin.products.upsert', ['product' => $product ?? false])

@endsection