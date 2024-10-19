@vite(['resources/js/catalogo/padrino.js'])

@extends('layout.plantilla_app')

@section('informacion')
    @livewire('padrino-component')
@endsection