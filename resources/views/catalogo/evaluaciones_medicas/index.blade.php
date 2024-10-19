@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
    @livewire('evaluaciones-medicas-component')
@endsection