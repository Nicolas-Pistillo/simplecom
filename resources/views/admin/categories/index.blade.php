@extends('layouts.dashboards.admin')

@section('title', 'Categorias - Listado')

@section('head')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
@endsection

@section('content')

    @livewire('admin.categories.upsert')

@endsection
