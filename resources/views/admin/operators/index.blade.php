@extends('layouts.dashboards.admin')

@section('title', 'Operadores - Listado')
    
@section('content')

    @livewire('admin.operators.upsert')

@endsection