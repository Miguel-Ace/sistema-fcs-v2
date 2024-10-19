@vite(['resources/js/catalogo/proyectos.js'])

@extends('layout.plantilla_app')

@section('informacion')
    @livewire('proyectos-component')
@endsection