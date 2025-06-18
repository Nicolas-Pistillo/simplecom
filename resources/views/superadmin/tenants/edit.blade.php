@extends('layouts.dashboards.superadmin')

@section('title', 'Comercios - Nuevo')
    
@section('content')
    @livewire('superadmin.tenants.upsert', compact('tenant'))
@endsection