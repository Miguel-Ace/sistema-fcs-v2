<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\catalogo\CatalogoController;
use Illuminate\Support\Facades\Route;

// Auntenticación
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'store']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Home
    Route::get('/', [CatalogoController::class, 'expediente_index']);

    // Rol
    Route::post('/rol/{user}', [CatalogoController::class, 'user_rol_create']);

    // Usuario
    Route::get('/user', [CatalogoController::class, 'user_index'])->name('user');
    Route::get('/user/create', [CatalogoController::class, 'user_create']);
    Route::get('/user/view/{id}', [CatalogoController::class, 'user_view']);
    Route::get('/user/edit/{id}', [CatalogoController::class, 'user_edit']);
    Route::post('/user', [CatalogoController::class, 'user_store']);
    Route::patch('/user/{id}', [CatalogoController::class, 'user_update']);

    // Expediente
    Route::get('/expedientes/buscador', [CatalogoController::class, 'expediente_buscador_index']);
    Route::get('/expedientes', [CatalogoController::class, 'expediente_index']);
    Route::get('/expedientes/create', [CatalogoController::class, 'expediente_create']);
    Route::get('/expedientes/view/{id}', [CatalogoController::class, 'expediente_view']);
    Route::get('/expedientes/edit/{id}', [CatalogoController::class, 'expediente_edit']);
    Route::post('/expedientes', [CatalogoController::class, 'expediente_store']);
    Route::patch('/expedientes/{id}', [CatalogoController::class, 'expediente_update']);

    // Padrino
    Route::get('/padrinos/buscador', [CatalogoController::class, 'padrino_buscador_index']);
    Route::get('/padrinos', [CatalogoController::class, 'padrino_index']);
    Route::get('/padrinos/create', [CatalogoController::class, 'padrino_create']);
    Route::get('/padrinos/view/{id}', [CatalogoController::class, 'padrino_view']);
    Route::get('/padrinos/edit/{id}', [CatalogoController::class, 'padrino_edit']);
    Route::post('/padrinos', [CatalogoController::class, 'padrino_store']);
    Route::patch('/padrinos/{id}', [CatalogoController::class, 'padrino_update']);
    
    // Evaluaciones medicas
    Route::get('/evaluaciones_medicas/buscador', [CatalogoController::class, 'evaluacion_medica_buscador_index']);
    Route::get('/evaluaciones_medicas', [CatalogoController::class, 'evaluacion_medica_index']);
    Route::get('/evaluaciones_medicas/create', [CatalogoController::class, 'evaluacion_medica_create']);
    Route::get('/evaluaciones_medicas/view/{id}', [CatalogoController::class, 'evaluacion_medica_view']);
    Route::get('/evaluaciones_medicas/edit/{id}', [CatalogoController::class, 'evaluacion_medica_edit']);
    Route::post('/evaluaciones_medicas', [CatalogoController::class, 'evaluacion_medica_store']);
    Route::patch('/evaluaciones_medicas/{id}', [CatalogoController::class, 'evaluacion_medica_update']);

    // Detalle evaluaciones medicas
    Route::get('/evaluaciones_medicas/detalle_evaluaciones_medicas/{id_em}', [CatalogoController::class, 'detalle_evaluacion_medica_index']);
    Route::get('/evaluaciones_medicas/detalle_evaluaciones_medicas/create/{id_em}', [CatalogoController::class, 'detalle_evaluacion_medica_create']);
    Route::get('/evaluaciones_medicas/detalle_evaluaciones_medicas/view/{id}/{id_em}', [CatalogoController::class, 'detalle_evaluacion_medica_view']);
    Route::get('/evaluaciones_medicas/detalle_evaluaciones_medicas/{id_em}/edit/{id}', [CatalogoController::class, 'detalle_evaluacion_medica_edit']);
    Route::post('/evaluaciones_medicas/detalle_evaluaciones_medicas/{id_em}', [CatalogoController::class, 'detalle_evaluacion_medica_store']);
    Route::patch('/evaluaciones_medicas/detalle_evaluaciones_medicas/{id}/{id_em}', [CatalogoController::class, 'detalle_evaluacion_medica_update']);

    // Enfermedades
    Route::get('/evaluaciones_medicas/enfermedades/{id_em}', [CatalogoController::class, 'enfermedad_index']);
    Route::get('/evaluaciones_medicas/enfermedades/create/{id_em}', [CatalogoController::class, 'enfermedad_create']);
    Route::get('/evaluaciones_medicas/enfermedades/view/{id}/{id_em}', [CatalogoController::class, 'enfermedad_view']);
    Route::get('/evaluaciones_medicas/enfermedades/{id_em}/edit/{id}', [CatalogoController::class, 'enfermedad_edit']);
    Route::post('/evaluaciones_medicas/enfermedades/{id_em}', [CatalogoController::class, 'enfermedad_store']);
    Route::patch('/evaluaciones_medicas/enfermedades/{id}/{id_em}', [CatalogoController::class, 'enfermedad_update']);

    // Entregas mensuales
    Route::get('/entregas_mensuales/buscador', [CatalogoController::class, 'entrega_mensual_buscador_index']);
    Route::get('/entregas_mensuales', [CatalogoController::class, 'entrega_mensual_index']);
    Route::get('/entregas_mensuales/create', [CatalogoController::class, 'entrega_mensual_create']);
    Route::get('/entregas_mensuales/view/{id}', [CatalogoController::class, 'entrega_mensual_view']);
    Route::get('/entregas_mensuales/edit/{id}', [CatalogoController::class, 'entrega_mensual_edit']);
    Route::post('/entregas_mensuales', [CatalogoController::class, 'entrega_mensual_store']);
    Route::patch('/entregas_mensuales/{id}', [CatalogoController::class, 'entrega_mensual_update']);

    // Detalle Entregas mensuales
    Route::get('/entregas_mensuales/detalle_entregas_mensuales/{id_em}', [CatalogoController::class, 'detalle_entrega_mensual_index']);
    Route::get('/entregas_mensuales/detalle_entregas_mensuales/create/{id_em}', [CatalogoController::class, 'detalle_entrega_mensual_create']);
    Route::get('/entregas_mensuales/detalle_entregas_mensuales/view/{id}/{id_em}', [CatalogoController::class, 'detalle_entrega_mensual_view']);
    Route::get('/entregas_mensuales/detalle_entregas_mensuales/{id_em}/edit/{id}', [CatalogoController::class, 'detalle_entrega_mensual_edit']);
    Route::post('/entregas_mensuales/detalle_entregas_mensuales/{id_em}', [CatalogoController::class, 'detalle_entrega_mensual_store']);
    Route::patch('/entregas_mensuales/detalle_entregas_mensuales/{id}/{id_em}', [CatalogoController::class, 'detalle_entrega_mensual_update']);

    // Cumpleaños
    Route::get('/cumpleaños/buscador', [CatalogoController::class, 'cumpleaño_buscador_index']);
    Route::get('/cumpleaños', [CatalogoController::class, 'cumpleaño_index']);
    Route::get('/cumpleaños/create', [CatalogoController::class, 'cumpleaño_create']);
    Route::get('/cumpleaños/view/{id}', [CatalogoController::class, 'cumpleaño_view']);
    Route::get('/cumpleaños/edit/{id}', [CatalogoController::class, 'cumpleaño_edit']);
    Route::post('/cumpleaños', [CatalogoController::class, 'cumpleaño_store']);
    Route::patch('/cumpleaños/{id}', [CatalogoController::class, 'cumpleaño_update']);
    
    // Notas
    Route::get('/notas/buscador', [CatalogoController::class, 'nota_buscador_index']);
    Route::get('/notas', [CatalogoController::class, 'nota_index']);
    Route::get('/notas/create', [CatalogoController::class, 'nota_create']);
    Route::get('/notas/view/{id}', [CatalogoController::class, 'nota_view']);
    Route::get('/notas/edit/{id}', [CatalogoController::class, 'nota_edit']);
    Route::post('/notas', [CatalogoController::class, 'nota_store']);
    Route::patch('/notas/{id}', [CatalogoController::class, 'nota_update']);

    // Insumos
    Route::get('/insumos/buscador', [CatalogoController::class, 'insumo_buscador_index']);
    Route::get('/insumos', [CatalogoController::class, 'insumo_index']);
    Route::get('/insumos/create', [CatalogoController::class, 'insumo_create']);
    Route::get('/insumos/view/{id}', [CatalogoController::class, 'insumo_view']);
    Route::get('/insumos/edit/{id}', [CatalogoController::class, 'insumo_edit']);
    Route::post('/insumos', [CatalogoController::class, 'insumo_store']);
    Route::patch('/insumos/{id}', [CatalogoController::class, 'insumo_update']);

    // Bancos
    Route::get('/bancos/buscador', [CatalogoController::class, 'banco_buscador_index']);
    Route::get('/bancos', [CatalogoController::class, 'banco_index']);
    Route::get('/bancos/create', [CatalogoController::class, 'banco_create']);
    Route::get('/bancos/view/{id}', [CatalogoController::class, 'banco_view']);
    Route::get('/bancos/edit/{id}', [CatalogoController::class, 'banco_edit']);
    Route::post('/bancos', [CatalogoController::class, 'banco_store']);
    Route::patch('/bancos/{id}', [CatalogoController::class, 'banco_update']);

    // Becas
    Route::get('/becas/buscador', [CatalogoController::class, 'beca_buscador_index']);
    Route::get('/becas', [CatalogoController::class, 'beca_index']);
    Route::get('/becas/create', [CatalogoController::class, 'beca_create']);
    Route::get('/becas/view/{id}', [CatalogoController::class, 'beca_view']);
    Route::get('/becas/edit/{id}', [CatalogoController::class, 'beca_edit']);
    Route::post('/becas', [CatalogoController::class, 'beca_store']);
    Route::patch('/becas/{id}', [CatalogoController::class, 'beca_update']);

    // Centro educativo
    Route::get('/centros_educativos/buscador', [CatalogoController::class, 'centro_educativo_buscador_index']);
    Route::get('/centros_educativos', [CatalogoController::class, 'centro_educativo_index']);
    Route::get('/centros_educativos/create', [CatalogoController::class, 'centro_educativo_create']);
    Route::get('/centros_educativos/view/{id}', [CatalogoController::class, 'centro_educativo_view']);
    Route::get('/centros_educativos/edit/{id}', [CatalogoController::class, 'centro_educativo_edit']);
    Route::post('/centros_educativos', [CatalogoController::class, 'centro_educativo_store']);
    Route::patch('/centros_educativos/{id}', [CatalogoController::class, 'centro_educativo_update']);

    // Clinica
    Route::get('/clinicas/buscador', [CatalogoController::class, 'clinica_buscador_index']);
    Route::get('/clinicas', [CatalogoController::class, 'clinica_index']);
    Route::get('/clinicas/create', [CatalogoController::class, 'clinica_create']);
    Route::get('/clinicas/view/{id}', [CatalogoController::class, 'clinica_view']);
    Route::get('/clinicas/edit/{id}', [CatalogoController::class, 'clinica_edit']);
    Route::post('/clinicas', [CatalogoController::class, 'clinica_store']);
    Route::patch('/clinicas/{id}', [CatalogoController::class, 'clinica_update']);

    // Comunidades
    Route::get('/comunidades/buscador', [CatalogoController::class, 'comunidad_buscador_index']);
    Route::get('/comunidades', [CatalogoController::class, 'comunidad_index']);
    Route::get('/comunidades/create', [CatalogoController::class, 'comunidad_create']);
    Route::get('/comunidades/view/{id}', [CatalogoController::class, 'comunidad_view']);
    Route::get('/comunidades/edit/{id}', [CatalogoController::class, 'comunidad_edit']);
    Route::post('/comunidades', [CatalogoController::class, 'comunidad_store']);
    Route::patch('/comunidades/{id}', [CatalogoController::class, 'comunidad_update']);

    // Especialidades
    Route::get('/especialidades/buscador', [CatalogoController::class, 'especialidad_buscador_index']);
    Route::get('/especialidades', [CatalogoController::class, 'especialidad_index']);
    Route::get('/especialidades/create', [CatalogoController::class, 'especialidad_create']);
    Route::get('/especialidades/view/{id}', [CatalogoController::class, 'especialidad_view']);
    Route::get('/especialidades/edit/{id}', [CatalogoController::class, 'especialidad_edit']);
    Route::post('/especialidades', [CatalogoController::class, 'especialidad_store']);
    Route::patch('/especialidades/{id}', [CatalogoController::class, 'especialidad_update']);

    // Grado escolar
    Route::get('/grados_escolares/buscador', [CatalogoController::class, 'grado_escolar_buscador_index']);
    Route::get('/grados_escolares', [CatalogoController::class, 'grado_escolar_index']);
    Route::get('/grados_escolares/create', [CatalogoController::class, 'grado_escolar_create']);
    Route::get('/grados_escolares/view/{id}', [CatalogoController::class, 'grado_escolar_view']);
    Route::get('/grados_escolares/edit/{id}', [CatalogoController::class, 'grado_escolar_edit']);
    Route::post('/grados_escolares', [CatalogoController::class, 'grado_escolar_store']);
    Route::patch('/grados_escolares/{id}', [CatalogoController::class, 'grado_escolar_update']);

    // Método de pago
    Route::get('/metodos_de_pagos/buscador', [CatalogoController::class, 'metodo_de_pago_buscador_index']);
    Route::get('/metodos_de_pagos', [CatalogoController::class, 'metodo_de_pago_index']);
    Route::get('/metodos_de_pagos/create', [CatalogoController::class, 'metodo_de_pago_create']);
    Route::get('/metodos_de_pagos/view/{id}', [CatalogoController::class, 'metodo_de_pago_view']);
    Route::get('/metodos_de_pagos/edit/{id}', [CatalogoController::class, 'metodo_de_pago_edit']);
    Route::post('/metodos_de_pagos', [CatalogoController::class, 'metodo_de_pago_store']);
    Route::patch('/metodos_de_pagos/{id}', [CatalogoController::class, 'metodo_de_pago_update']);

    // Motivo de baja
    Route::get('/motivos_de_bajas/buscador', [CatalogoController::class, 'motivo_de_baja_buscador_index']);
    Route::get('/motivos_de_bajas', [CatalogoController::class, 'motivo_de_baja_index']);
    Route::get('/motivos_de_bajas/create', [CatalogoController::class, 'motivo_de_baja_create']);
    Route::get('/motivos_de_bajas/view/{id}', [CatalogoController::class, 'motivo_de_baja_view']);
    Route::get('/motivos_de_bajas/edit/{id}', [CatalogoController::class, 'motivo_de_baja_edit']);
    Route::post('/motivos_de_bajas', [CatalogoController::class, 'motivo_de_baja_store']);
    Route::patch('/motivos_de_bajas/{id}', [CatalogoController::class, 'motivo_de_baja_update']);

    // Provincia
    Route::get('/provincias/buscador', [CatalogoController::class, 'provincia_buscador_index']);
    Route::get('/provincias', [CatalogoController::class, 'provincia_index']);
    Route::get('/provincias/create', [CatalogoController::class, 'provincia_create']);
    Route::get('/provincias/view/{id}', [CatalogoController::class, 'provincia_view']);
    Route::get('/provincias/edit/{id}', [CatalogoController::class, 'provincia_edit']);
    Route::post('/provincias', [CatalogoController::class, 'provincia_store']);
    Route::patch('/provincias/{id}', [CatalogoController::class, 'provincia_update']);
    
    // Proyectos
    Route::get('/proyectos/buscador', [CatalogoController::class, 'proyecto_buscador_index']);
    Route::get('/proyectos', [CatalogoController::class, 'proyecto_index']);
    Route::get('/proyectos/create', [CatalogoController::class, 'proyecto_create']);
    Route::get('/proyectos/view/{id}', [CatalogoController::class, 'proyecto_view']);
    Route::get('/proyectos/edit/{id}', [CatalogoController::class, 'proyecto_edit']);
    Route::post('/proyectos', [CatalogoController::class, 'proyecto_store']);
    Route::patch('/proyectos/{id}', [CatalogoController::class, 'proyecto_update']);
    
    // Tipo de asistencia
    Route::get('/tipos_de_asistencias/buscador', [CatalogoController::class, 'tipo_de_asistencia_buscador_index']);
    Route::get('/tipos_de_asistencias', [CatalogoController::class, 'tipo_de_asistencia_index']);
    Route::get('/tipos_de_asistencias/create', [CatalogoController::class, 'tipo_de_asistencia_create']);
    Route::get('/tipos_de_asistencias/view/{id}', [CatalogoController::class, 'tipo_de_asistencia_view']);
    Route::get('/tipos_de_asistencias/edit/{id}', [CatalogoController::class, 'tipo_de_asistencia_edit']);
    Route::post('/tipos_de_asistencias', [CatalogoController::class, 'tipo_de_asistencia_store']);
    Route::patch('/tipos_de_asistencias/{id}', [CatalogoController::class, 'tipo_de_asistencia_update']);
    
    // Tipo de entrega
    Route::get('/tipos_de_entregas/buscador', [CatalogoController::class, 'tipo_de_entrega_buscador_index']);
    Route::get('/tipos_de_entregas', [CatalogoController::class, 'tipo_de_entrega_index']);
    Route::get('/tipos_de_entregas/create', [CatalogoController::class, 'tipo_de_entrega_create']);
    Route::get('/tipos_de_entregas/view/{id}', [CatalogoController::class, 'tipo_de_entrega_view']);
    Route::get('/tipos_de_entregas/edit/{id}', [CatalogoController::class, 'tipo_de_entrega_edit']);
    Route::post('/tipos_de_entregas', [CatalogoController::class, 'tipo_de_entrega_store']);
    Route::patch('/tipos_de_entregas/{id}', [CatalogoController::class, 'tipo_de_entrega_update']);
    
    // Tipo de pobreza
    Route::get('/tipos_de_pobrezas/buscador', [CatalogoController::class, 'tipo_de_pobreza_buscador_index']);
    Route::get('/tipos_de_pobrezas', [CatalogoController::class, 'tipo_de_pobreza_index']);
    Route::get('/tipos_de_pobrezas/create', [CatalogoController::class, 'tipo_de_pobreza_create']);
    Route::get('/tipos_de_pobrezas/view/{id}', [CatalogoController::class, 'tipo_de_pobreza_view']);
    Route::get('/tipos_de_pobrezas/edit/{id}', [CatalogoController::class, 'tipo_de_pobreza_edit']);
    Route::post('/tipos_de_pobrezas', [CatalogoController::class, 'tipo_de_pobreza_store']);
    Route::patch('/tipos_de_pobrezas/{id}', [CatalogoController::class, 'tipo_de_pobreza_update']);
    
    // Barrio
    Route::get('/barrios/buscador', [CatalogoController::class, 'barrio_buscador_index']);
    Route::get('/barrios', [CatalogoController::class, 'barrio_index']);
    Route::get('/barrios/create', [CatalogoController::class, 'barrio_create']);
    Route::get('/barrios/view/{id}', [CatalogoController::class, 'barrio_view']);
    Route::get('/barrios/edit/{id}', [CatalogoController::class, 'barrio_edit']);
    Route::post('/barrios', [CatalogoController::class, 'barrio_store']);
    Route::patch('/barrios/{id}', [CatalogoController::class, 'barrio_update']);

    // Canton
    Route::get('/cantones/buscador', [CatalogoController::class, 'canton_buscador_index']);
    Route::get('/cantones', [CatalogoController::class, 'canton_index']);
    Route::get('/cantones/create', [CatalogoController::class, 'canton_create']);
    Route::get('/cantones/view/{id}', [CatalogoController::class, 'canton_view']);
    Route::get('/cantones/edit/{id}', [CatalogoController::class, 'canton_edit']);
    Route::post('/cantones', [CatalogoController::class, 'canton_store']);
    Route::patch('/cantones/{id}', [CatalogoController::class, 'canton_update']);

    // Estados
    Route::get('/estados/buscador', [CatalogoController::class, 'estado_buscador_index']);
    Route::get('/estados', [CatalogoController::class, 'estado_index']);
    Route::get('/estados/create', [CatalogoController::class, 'estado_create']);
    Route::get('/estados/view/{id}', [CatalogoController::class, 'estado_view']);
    Route::get('/estados/edit/{id}', [CatalogoController::class, 'estado_edit']);
    Route::post('/estados', [CatalogoController::class, 'estado_store']);
    Route::patch('/estados/{id}', [CatalogoController::class, 'estado_update']);

    // Baja de padrino
    Route::get('/bajas_de_padrinos/buscador', [CatalogoController::class, 'baja_de_padrino_buscador_index']);
    Route::get('/bajas_de_padrinos', [CatalogoController::class, 'baja_de_padrino_index']);
    Route::get('/bajas_de_padrinos/create', [CatalogoController::class, 'baja_de_padrino_create']);
    Route::get('/bajas_de_padrinos/view/{id}', [CatalogoController::class, 'baja_de_padrino_view']);
    Route::get('/bajas_de_padrinos/edit/{id}', [CatalogoController::class, 'baja_de_padrino_edit']);
    Route::post('/bajas_de_padrinos', [CatalogoController::class, 'baja_de_padrino_store']);
    Route::patch('/bajas_de_padrinos/{id}', [CatalogoController::class, 'baja_de_padrino_update']);

    // Actividades
    Route::get('/actividades/buscador', [CatalogoController::class, 'actividad_buscador_index']);
    Route::get('/actividades', [CatalogoController::class, 'actividad_index']);
    Route::get('/actividades/create', [CatalogoController::class, 'actividad_create']);
    Route::get('/actividades/view/{id}', [CatalogoController::class, 'actividad_view']);
    Route::get('/actividades/edit/{id}', [CatalogoController::class, 'actividad_edit']);
    Route::post('/actividades', [CatalogoController::class, 'actividad_store']);
    Route::patch('/actividades/{id}', [CatalogoController::class, 'actividad_update']);

    // Detalle Actividades
    Route::get('/actividades/detalles_actividades/{id_a}', [CatalogoController::class, 'detalle_actividad_index']);
    Route::get('/actividades/detalles_actividades/create/{id_a}', [CatalogoController::class, 'detalle_actividad_create']);
    Route::get('/actividades/detalles_actividades/view/{id}/{id_a}', [CatalogoController::class, 'detalle_actividad_view']);
    Route::get('/actividades/detalles_actividades/{id_a}/edit/{id}', [CatalogoController::class, 'detalle_actividad_edit']);
    // Route::post('/actividades/detalles_actividades/{id_a}/{id_niño}/{activo}', [CatalogoController::class, 'detalle_actividad_store']);
    Route::patch('/actividades/detalles_actividades/{id}/{id_a}', [CatalogoController::class, 'detalle_actividad_update']);
    Route::get('/actividades/detalles_actividades/delete/{id}', [CatalogoController::class, 'detalle_actividad_delete']);

    // Tutores
    Route::get('/tutores/buscador', [CatalogoController::class, 'tutor_buscador_index']);
    Route::get('/tutores', [CatalogoController::class, 'tutor_index']);
    Route::get('/tutores/create', [CatalogoController::class, 'tutor_create']);
    Route::get('/tutores/view/{id}', [CatalogoController::class, 'tutor_view']);
    Route::get('/tutores/edit/{id}', [CatalogoController::class, 'tutor_edit']);
    Route::post('/tutores', [CatalogoController::class, 'tutor_store']);
    Route::patch('/tutores/{id}', [CatalogoController::class, 'tutor_update']);

    // Tutorias
    Route::get('/tutorias/buscador', [CatalogoController::class, 'tutoria_buscador_index']);
    Route::get('/tutorias', [CatalogoController::class, 'tutoria_index']);
    Route::get('/tutorias/create', [CatalogoController::class, 'tutoria_create']);
    Route::get('/tutorias/view/{id}', [CatalogoController::class, 'tutoria_view']);
    Route::get('/tutorias/edit/{id}', [CatalogoController::class, 'tutoria_edit']);
    Route::post('/tutorias', [CatalogoController::class, 'tutoria_store']);
    Route::patch('/tutorias/{id}', [CatalogoController::class, 'tutoria_update']);
});