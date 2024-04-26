@extends('layouts.dashboards.admin')

@section('title', 'Contenidos - Banners')

@section('head')
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
    <style>
        .flickity-page-dots {
            bottom: -35px;
        }
    </style>
@endsection

@section('content')

    @livewire('admin.contents.banners')

@endsection