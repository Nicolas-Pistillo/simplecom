@extends('layouts.dashboards.admin')

@section('title', 'Configuraciones')

@section('content')

    <x-tabs tabs="['General', 'Módulos']" current="General">

        <section x-show="current == 'General'">
            @livewire('admin.configurations.ecommerce-data')
        </section>

        <section x-show="current == 'Módulos'">
            @livewire('admin.configurations.modules')
        </section>

    </x-tabs>

@endsection
