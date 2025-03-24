@extends('layouts.ecommerce')

@section('content')
    @livewire('ecommerce.customer.order-detail', compact('order'))
@endsection