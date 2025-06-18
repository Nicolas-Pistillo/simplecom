@extends('layouts.dashboards.admin')

@section('title', 'Detalle de mensaje')

@section('content')
    @livewire('admin.messages.show', compact('message'))
@endsection
