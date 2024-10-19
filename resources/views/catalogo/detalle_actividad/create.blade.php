@vite(['resources/js/catalogo/evaluacion_medica.js'])

@extends('layout.plantilla_app')

@section('informacion')
    @livewire('create-detalle-actividad-component', ['actividadId' => $id_a])
@endsection