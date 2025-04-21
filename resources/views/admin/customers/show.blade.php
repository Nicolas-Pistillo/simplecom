@extends('layouts.dashboards.admin')

@section('content')
    @livewire('admin.customers.show', compact('customer'))  
@endsection