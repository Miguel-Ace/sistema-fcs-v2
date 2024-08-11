<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Control-Contratistas</title>
    @vite(['resources/css/display_load.css','resources/css/general.css','resources/css/plantilla_app.css','resources/js/plantilla_app.js'])
    <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
</head>
<body>
    @if(session('mensaje'))
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "{{ session('mensaje') }}",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        </script>
    @endif

    <div class="display-load">
        <div class="cajita">
            <span class="s1"></span>
            <span class="s2"></span>
            <span class="s3"></span>
        </div>
    </div>

    <div class="contenedor">
        <div class="left">
            <div class="toogle"></div>
            <div class="catalogos">
                <a href="{{url('/expedientes')}}" class="a">
                    <ion-icon name="document-text-outline"></ion-icon>
                    <span class="nombre-catalogo">Expedientes</span>
                </a>
                
                <a href="{{url('/evaluaciones_medicas')}}" class="a">
                    <ion-icon name="medkit-outline"></ion-icon>
                    <span class="nombre-catalogo">Evaluaciones Médicas</span>
                </a>

                <a href="{{url('/cumpleaños')}}" class="a">
                    <ion-icon name="baseball-outline"></ion-icon>
                    <span class="nombre-catalogo">Cumpleaños</span>
                </a>

                <a href="{{url('/tutorias')}}" class="a">
                    <i class="fa-solid fa-person-chalkboard"></i>
                    <span class="nombre-catalogo">tutorias</span>
                </a>

                <a href="{{url('/actividades')}}" class="a">
                    <i class="fa-solid fa-person-swimming"></i>
                    <span class="nombre-catalogo">Actividades</span>
                </a>

                <a href="{{url('/insumos')}}" class="a desactivar">
                    <ion-icon name="bag-handle-outline"></ion-icon>
                    <span class="nombre-catalogo">Insumos</span>
                </a>

                <a href="{{url('/padrinos')}}" class="a">
                    <i class="fa-solid fa-person-circle-plus"></i>
                    <span class="nombre-catalogo">Padrinos</span>
                </a>

                <a href="{{url('/entregas_mensuales')}}" class="a">
                    <i class="fa-solid fa-person-walking-luggage"></i>
                    <span class="nombre-catalogo">Entregas Mensuales</span>
                </a>

                <a href="{{url('/bajas_de_padrinos')}}" class="a">
                    <i class="fa-solid fa-person-circle-xmark"></i>
                    <span class="nombre-catalogo">Bajas de Padrinos</span>
                </a>

                <a href="{{url('/especialidades')}}" class="a desactivar">
                    <i class="fa-solid fa-hand-holding-medical"></i>
                    <span class="nombre-catalogo">Especialidades</span>
                </a>

                <a href="{{url('/tipos_de_asistencias')}}" class="a desactivar">
                    <ion-icon name="color-palette-outline"></ion-icon>
                    <span class="nombre-catalogo">Tipo de asistencias</span>
                </a>

                <a href="{{url('/motivos_de_bajas')}}" class="a desactivar">
                    <ion-icon name="id-card-outline"></ion-icon>
                    <span class="nombre-catalogo">Motivo de baja</span>
                </a>

                <a href="{{url('/proyectos')}}" class="a desactivar">
                    <ion-icon name="subway-outline"></ion-icon>
                    <span class="nombre-catalogo">Proyectos</span>
                </a>
                
                <a href="{{url('/bancos')}}" class="a desactivar">
                    <i class="fa-solid fa-shop"></i>
                    <span class="nombre-catalogo">Bancos</span>
                </a>
                
                <a href="{{url('/provincias')}}" class="a desactivar">
                    <ion-icon name="map-outline"></ion-icon>
                    <span class="nombre-catalogo">Provincias</span>
                </a>
                
                <a href="{{url('/cantones')}}" class="a desactivar">
                    <ion-icon name="map-outline"></ion-icon>
                    <span class="nombre-catalogo">Cantones</span>
                </a>
                
                <a href="{{url('/barrios')}}" class="a desactivar">
                    <ion-icon name="map-outline"></ion-icon>
                    <span class="nombre-catalogo">Barrios</span>
                </a>
                
                <a href="{{url('/comunidades')}}" class="a desactivar">
                    <ion-icon name="earth-outline"></ion-icon>
                    <span class="nombre-catalogo">Comunidades</span>
                </a>
                
                <a href="{{url('/estados')}}" class="a desactivar">
                    <ion-icon name="shield-half-outline"></ion-icon>
                    <span class="nombre-catalogo">Estados</span>
                </a>

                <a href="{{url('/tutores')}}" class="a desactivar">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span class="nombre-catalogo">Tutores</span>
                </a>
                
                <a href="{{url('/clinicas')}}" class="a">
                    <i class="fa-solid fa-house-chimney-medical"></i>
                    <span class="nombre-catalogo">Clínicas</span>
                </a>
                
                <a href="{{url('/metodos_de_pagos')}}" class="a">
                    <ion-icon name="cash-outline"></ion-icon>
                    <span class="nombre-catalogo">Métodos de Pagos</span>
                </a>
                

                <a href="{{url('/tipos_de_entregas')}}" class="a">
                    <ion-icon name="mail-outline"></ion-icon>
                    <span class="nombre-catalogo">Tipos de Entregas</span>
                </a>
                
                <a href="{{url('/tipos_de_pobrezas')}}" class="a">
                    <ion-icon name="bonfire-outline"></ion-icon>
                    <span class="nombre-catalogo">Tipos de Pobrezas</span>
                </a>
                
                <a href="{{url('/grados_escolares')}}" class="a">
                    <ion-icon name="school-outline"></ion-icon>
                    <span class="nombre-catalogo">Grados Escolares</span>
                </a>
                
                <a href="{{url('/notas')}}" class="a">
                    <ion-icon name="document-text-outline"></ion-icon>
                    <span class="nombre-catalogo">Notas</span>
                </a>
                
                <a href="{{url('/becas')}}" class="a">
                    <i class="fa-regular fa-handshake"></i>
                    <span class="nombre-catalogo">Becas</span>
                </a>
                
                <a href="{{url('/centros_educativos')}}" class="a">
                    <ion-icon name="storefront-outline"></ion-icon>
                    <span class="nombre-catalogo">Centros Educativos</span>
                </a>
            </div>
            <div class="icon-cabiar-catalogo">
                <i class="fa-solid fa-arrows-rotate"></i>
            </div>
        </div>

        <div class="right">
            <div class="encabezado">
                <div class="menu"></div>
                
                <div class="logo">
                    <img src="https://beesys.net/beesy2023/wp-content/uploads/2023/07/logo-beesys-2021-1.png" alt="">
                </div>

                <div class="settings">
                    <div class="usuario">
                        <p>{{auth()->user()->name}}</p>
                        <ion-icon name="caret-back-outline"></ion-icon>
                    </div>

                    <div class="detalle-setting">
                        <a href="{{route('user')}}">
                            @role('admin')
                                Usuarios
                            @else('contratista')
                                Usuario
                            @endrole
                        </a>
                        <a href="{{route('logout')}}">Cerrar sesión</a>
                    </div>
                </div>
            </div>

            <div class="informacion">
                @yield('informacion')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    <script src="https://kit.fontawesome.com/cd197f289d.js" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>