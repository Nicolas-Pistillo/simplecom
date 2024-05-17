@extends('layouts.ecommerce')

@section('content')
    @livewire('ecommerce.product-detail', compact('product'))
@endsection
