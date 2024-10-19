@vite(['resources/js/catalogo/expediente.js'])

@extends('layout.plantilla_app')

@section('informacion')
    @livewire('expediente-component')
@endsection