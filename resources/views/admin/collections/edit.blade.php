@extends('layouts.dashboards.admin')

@section('content')
    @livewire('admin.collections.upsert', compact('collection'))
@endsection