import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: 
            [
                'resources/css/display_load.css',
                'resources/css/general.css',
                'resources/css/plantilla_app.css',
                'resources/css/plantilla_auth.css',
                'resources/css/catalogo/user.css',
                'resources/js/display_load.js',
                'resources/js/limpiar_errores.js',
                'resources/js/plantilla_app.js',
                'resources/js/catalogo/user.js',
                'resources/js/catalogo/banco.js',
                'resources/js/catalogo/tutor.js',
                'resources/js/catalogo/tutoria.js',
                'resources/js/catalogo/provincia.js',
                'resources/js/catalogo/canton.js',
                'resources/js/catalogo/barrio.js',
                'resources/js/catalogo/padrino.js',
                'resources/js/catalogo/metodo_pago.js',
                'resources/js/catalogo/expediente.js',
                'resources/js/catalogo/evaluacion_medica.js',
                'resources/js/catalogo/clinica.js',
                'resources/js/catalogo/entrega_mensual.js',
                'resources/js/catalogo/insumo.js',
                'resources/js/catalogo/cumple.js',
                'resources/js/catalogo/notas.js',
                'resources/js/catalogo/baja_padrino.js',
                'resources/js/catalogo/actividad.js',
                'resources/js/catalogo/motivo_baja.js',
                'resources/js/catalogo/proyectos.js',
                'resources/js/catalogo/tipo_asistencia.js',
                'resources/js/catalogo/especialidad.js',
                'resources/js/catalogo/enfermedades.js',
                'resources/js/catalogo/beca.js',
                'resources/js/catalogo/tipo_pobreza.js',
                'resources/js/catalogo/tipo_entrega.js',
                'resources/js/catalogo/estado.js',
                'resources/js/catalogo/comunidad.js',
            ],
            refresh: true,
        }),
    ],
});
