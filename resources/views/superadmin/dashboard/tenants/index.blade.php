@extends('layouts.dashboards.superadmin')

@section('title', 'Tenants')

@section('head')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
@endsection

@section('content')
    
    @if ($tenants->isEmpty())

        <div class="text-center mt-8">
          
            <x-icon code="create_new_folder" class="text-gray-400" fontSize="48px" />
            
            <h3 class="mt-2 text-sm font-semibold text-gray-900 mb-5">Aún no hay tenants en simplecom</h3>

            <x-button>
                Crear uno ahora
            </x-button>
      </div>
    @else
        
    @endif

@endsection