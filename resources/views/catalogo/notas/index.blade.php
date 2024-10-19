@vite(['resources/js/catalogo/notas.js'])

@extends('layout.plantilla_app')

@section('informacion')
    @livewire('notas-component')
@endsection