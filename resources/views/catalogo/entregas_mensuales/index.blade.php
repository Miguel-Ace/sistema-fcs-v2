@vite(['resources/js/catalogo/entrega_mensual.js'])

@extends('layout.plantilla_app')

@section('informacion')
    @livewire('entrega-mensual-component')
@endsection