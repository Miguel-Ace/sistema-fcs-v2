<?php

namespace App\Http\Controllers\catalogo;

use Carbon\Carbon;
use App\Models\Beca;
use App\Models\Nota;
use App\Models\Sexo;
use App\Models\User;
use App\Models\Banco;
use App\Models\Activo;
use App\Models\Barrio;
use App\Models\Estado;
use App\Models\Insumo;
use App\Models\Cantone;
use App\Models\Clinica;
use App\Models\Padrino;
use App\Models\Tutoria;
use App\Models\Proyecto;
use App\Models\Semaforo;
use Nette\Schema\Expect;
use App\Models\Actividad;
use App\Models\Comunidad;
use App\Models\Provincia;
use App\Models\Cumpleanio;
use App\Models\Enfermedad;
use App\Models\Expediente;
use App\Models\MotivoBaja;
use App\Models\MetodosPago;
use App\Models\TipoEntrega;
use App\Models\TipoPobreza;
use Faker\Provider\Medical;
use App\Models\BajasPadrino;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use App\Models\GradosEscolare;
use App\Models\Ocupa_tutorias;
use App\Models\TipoAsistencia;
use App\Models\CentroEducativo;
use App\Models\DetalleActividad;
use App\Models\EntregasMensuale;
use App\Models\EvaluacionesMedica;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Models\DetalleEntregaMensual;
use Illuminate\Support\Facades\Hash;
use App\Models\DetalleEvaluacionMedica;
use App\Models\Tutor;
use Illuminate\Support\Facades\Storage;

class CatalogoController extends Controller
{    
    /////// Rol
    public function user_rol_create(Request $request, $user) {
        $usuario = User::find($user);
        // Borrar todos los roles del usuario
        $usuario->syncRoles([]);
        // Asignarle el rol al usuario
        $usuario->assignRole($request['rol']);

        return redirect()->back()->with(['mensaje' => 'Rol Actualizado']);
    }

    /////// Usuarios
    public function user_index() {
        $roles = Role::all();
        
        $datos = [];
        $user = User::find(auth()->user()->id);
        $user_rol = $user->getRoleNames();
        if ($user_rol[0] == 'admin') {
            $datos = User::where('id', '!=', 1)->get();
        }else{
            $datos = [$user];
        }
        return view('catalogo.user.index', compact('datos','roles'));
    }

    public function user_create() {
        return view('catalogo.user.create');
    }

    public function user_view($id) {
        $dato = User::find($id);
        return view('catalogo.user.view', compact('dato'));
    }

    public function user_edit($id) {
        $dato = User::find($id);
        return view('catalogo.user.edit', compact('dato'));
    }

    public function user_store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
        ],[
            'password.min' => 'Minimo 8 carácteres'
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        $user->assignRole('editor');

        return redirect('/user')->with(['mensaje' => 'Información Creada']);
    }

    public function user_update(Request $request, $id) {
        $usuario = User::find($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'min:8',
        ],[
            'password.min' => 'Minimo 8 carácteres'
        ]);

        $usuario->update([
            'name' => $request['name'] ? $request['name'] : $usuario['name'],
            'email' => $request['email'] ? $request['email'] : $usuario['email'],
            'password' => $request['password'] ? Hash::make($request['password']) : $usuario['password']
        ]);

        return redirect('/user')->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Expediente
    public function expediente_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Expediente::with(['becas','activos','sexos','comunidades','estados','tipo_pobrezas','barrios','grados_escolares','centro_educativos','padrinos'])
        ->where('codigo_nino', 'LIKE', "%{$buscar}%")
        ->orWhereHas('comunidades', function ($query) use ($buscar) {
            $query->where('comunidad', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('becas', function ($query) use ($buscar) {
            $query->where('beca', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('activos', function ($query) use ($buscar) {
            $query->where('activo', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('sexos', function ($query) use ($buscar) {
            $query->where('sexo', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('estados', function ($query) use ($buscar) {
            $query->where('estado', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('tipo_pobrezas', function ($query) use ($buscar) {
            $query->where('tipo_pobreza', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('barrios', function ($query) use ($buscar) {
            $query->where('barrio', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('grados_escolares', function ($query) use ($buscar) {
            $query->where('grado_escolar', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('centro_educativos', function ($query) use ($buscar) {
            $query->where('centro_educativo', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('padrinos', function ($query) use ($buscar) {
            $terms = explode(' ', $buscar); // Divide el término de búsqueda en palabras
            $query->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->where(function ($query) use ($term) {
                        $query->where('nombre', 'LIKE', "%{$term}%")
                              ->orWhere('apellido', 'LIKE', "%{$term}%");
                    });
                }
            });
        })
        ->orWhere('nombre1', 'LIKE', "%{$buscar}%")
        ->orWhere('nombre2', 'LIKE', "%{$buscar}%")
        ->orWhere('apellido1', 'LIKE', "%{$buscar}%")
        ->orWhere('apellido2', 'LIKE', "%{$buscar}%")
        ->orWhere('pp', 'LIKE', "%{$buscar}%")
        ->orWhere('cedula', 'LIKE', "%{$buscar}%")
        ->orWhere('fecha_nacimiento', 'LIKE', "%{$buscar}%")
        ->orWhere('contacto_representante', 'LIKE', "%{$buscar}%")
        ->orWhere('talla_pantalon', 'LIKE', "%{$buscar}%")
        ->orWhere('talla_camisa', 'LIKE', "%{$buscar}%")
        ->orWhere('talla_zapato', 'LIKE', "%{$buscar}%")
        ->orWhere('nombre_encargado', 'LIKE', "%{$buscar}%")
        ->orWhere('telefono_encargado', 'LIKE', "%{$buscar}%")
        ->paginate(10);

        return view('catalogo.expediente.index', compact('datos'));
    }

    public function expediente_index() {
        $datos = Expediente::paginate(20);
        return view('catalogo.expediente.index', compact('datos'));
    }

    public function expediente_create() {
        $comunidades = Comunidad::all();
        $estados = Estado::all();
        $sexos = Sexo::all();
        $tipoPobrezas = TipoPobreza::all();
        $barrios = Barrio::all();
        $gradosEscolares = GradosEscolare::all();
        $activos = Activo::all();
        $centrosEducativos = CentroEducativo::all();
        $padrinos = Padrino::all();
        $becas = Beca::all();
        return view('catalogo.expediente.create', compact('comunidades','estados','sexos','tipoPobrezas','barrios','gradosEscolares','activos','centrosEducativos','padrinos','becas'));
    }

    public function expediente_view($id) {
        $dato = Expediente::find($id);
        return view('catalogo.expediente.view', compact('dato'));
    }

    public function expediente_edit($id) {
        $dato = Expediente::find($id);
        $comunidades = Comunidad::all();
        $estados = Estado::all();
        $sexos = Sexo::all();
        $tipoPobrezas = TipoPobreza::all();
        $barrios = Barrio::all();
        $gradosEscolares = GradosEscolare::all();
        $activos = Activo::all();
        $centrosEducativos = CentroEducativo::all();
        $padrinos = Padrino::all();
        $becas = Beca::all();
        return view('catalogo.expediente.edit', compact('dato','comunidades','estados','sexos','tipoPobrezas','barrios','gradosEscolares','activos','centrosEducativos','padrinos','becas'));
    }

    public function expediente_store(Request $request) {
        $request->validate([
            'id_comunidad' => 'required|integer',
            'nombre1' => 'required|string|max:255',
            'nombre2' => 'required|string|max:255',
            'apellido1' => 'required|string|max:255',
            'apellido2' => 'required|string|max:255',
            'pp' => 'required|string|max:255',
            'id_estado' => 'required|integer',
            'id_sexo' => 'required|integer',
            'cedula' => 'required|string|max:255',
            'id_tipo_pobreza' => 'required|integer',
            'id_barrio' => 'required|integer',
            'fecha_nacimiento' => 'required|date',
            'contacto_representante' => 'required|string|max:255',
            'id_grado_escolar' => 'required|integer',
            'talla_pantalon' => 'required|string|max:50',
            'talla_camisa' => 'required|string|max:50',
            'talla_zapato' => 'required|string|max:50',
            'id_activo' => 'required|boolean',
            'nombre_encargado' => 'required|string|max:255',
            'telefono_encargado' => 'required|string|max:255',
            'id_centro_educativo' => 'required|integer',
            'id_padrino' => 'required|integer',
            'id_beca' => 'required|integer',
        ]);

        // Crear el registro en la base de datos
        $expediente = Expediente::create($request->all());

        // Actualizar el campo 'codigo_nino'
        $expediente->update(['codigo_nino' => 'FCS'.$expediente->id.date('Y')]);
        
        return redirect('/expedientes')->with(['mensaje' => 'Información Creada']);
    }

    public function expediente_update(Request $request, $id) {
        $expediente = Expediente::find($id);
        
        $expediente->update([
            'id_comunidad' => $request['id_comunidad'] ? $request['id_comunidad'] : $expediente['id_comunidad'],
            'nombre1' => $request['nombre1'] ? $request['nombre1'] :$expediente['nombre1'],
            'nombre2' => $request['nombre2'] ? $request['nombre2'] : $expediente['nombre2'],
            'apellido1' => $request['apellido1'] ? $request['apellido1'] : $expediente['apellido1'],
            'apellido2' => $request['apellido2'] ? $request['apellido2'] : $expediente['apellido2'],
            'pp' => $request['pp'] ? $request['pp'] : $expediente['pp'],
            'id_estado' => $request['id_estado'] ? $request['id_estado'] : $expediente['id_estado'],
            'id_sexo' => $request['id_sexo'] ? $request['id_sexo'] : $expediente['id_sexo'],
            'cedula' => $request['cedula'] ? $request['cedula'] : $expediente['cedula'],
            'id_tipo_pobreza' => $request['id_tipo_pobreza'] ? $request['id_tipo_pobreza'] :  $expediente['id_tipo_pobreza'],
            'id_barrio' => $request['id_barrio'] ? $request['id_barrio'] : $expediente['id_barrio'],
            'fecha_nacimiento' => $request['fecha_nacimiento'] ? $request['fecha_nacimiento'] : $expediente['fecha_nacimiento'],
            'contacto_representante' => $request['contacto_representante'] ? $request['contacto_representante'] : $expediente['contacto_representante'],
            'id_grado_escolar' => $request['id_grado_escolar'] ? $request['id_grado_escolar'] : $expediente['id_grado_escolar'],
            'talla_pantalon' => $request['talla_pantalon'] ? $request['talla_pantalon'] : $expediente['talla_pantalon'],
            'talla_camisa' => $request['talla_camisa'] ? $request['talla_camisa'] : $expediente['talla_camisa'],
            'talla_zapato' => $request['talla_zapato'] ? $request['talla_zapato'] : $expediente['talla_zapato'],
            'id_activo' => $request['id_activo'] ? $request['id_activo'] : $expediente['id_activo'],
            'nombre_encargado' => $request['nombre_encargado'] ? $request['nombre_encargado'] :$expediente['nombre_encargado'],
            'telefono_encargado' => $request['telefono_encargado'] ? $request['telefono_encargado'] : $expediente['telefono_encargado'],
            'id_centro_educativo' => $request['id_centro_educativo'] ? $request['id_centro_educativo'] : $expediente['id_centro_educativo'],
            'id_padrino' => $request['id_padrino'] ? $request['id_padrino'] : $expediente['id_padrino'],
            'id_beca' => $request['id_beca'] ? $request['id_beca'] : $expediente['id_beca'],
        ]);
        
        return redirect('/expedientes')->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Padrinos
    public function padrino_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Padrino::with(['provincias','cantones','barrios','metodos_pagos','bancos'])
        ->where('nombre', 'LIKE', "%{$buscar}%")
        ->orWhereHas('provincias', function ($query) use ($buscar) {
            $query->where('provincia', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('cantones', function ($query) use ($buscar) {
            $query->where('canton', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('barrios', function ($query) use ($buscar) {
            $query->where('barrio', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('metodos_pagos', function ($query) use ($buscar) {
            $query->where('metodo_pago', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('bancos', function ($query) use ($buscar) {
            $query->where('banco', 'LIKE', "%{$buscar}%");
        })
        ->orWhere('apellido', 'LIKE', "%{$buscar}%")
        ->orWhere('telefono', 'LIKE', "%{$buscar}%")
        ->orWhere('direccion', 'LIKE', "%{$buscar}%")
        ->orWhere('correo', 'LIKE', "%{$buscar}%")
        ->orWhere('tipo', 'LIKE', "%{$buscar}%")
        ->orWhere('fecha_inicio', 'LIKE', "%{$buscar}%")
        ->orWhere('fecha_final', 'LIKE', "%{$buscar}%")
        ->orWhere('fecha_nacimiento', 'LIKE', "%{$buscar}%")
        ->paginate(20);

        return view('catalogo.padrino.index', compact('datos'));
    }

    public function padrino_index() {
        $datos = Padrino::paginate(20);
        return view('catalogo.padrino.index', compact('datos'));
    }

    public function padrino_create() {
        $provincias = Provincia::all();
        $cantones = Cantone::all();
        $barrios = Barrio::all();
        $metodos_pagos = MetodosPago::all();
        $bancos = Banco::all();
        return view('catalogo.padrino.create', compact('provincias','cantones','barrios','metodos_pagos','bancos'));
    }

    public function padrino_view($id) {
        $dato = Padrino::find($id);
        return view('catalogo.padrino.view', compact('dato'));
    }

    public function padrino_edit($id) {
        $dato = Padrino::find($id);
        $provincias = Provincia::all();
        $cantones = Cantone::all();
        $barrios = Barrio::all();
        $metodos_pagos = MetodosPago::all();
        $bancos = Banco::all();
        return view('catalogo.padrino.edit', compact('dato','provincias','cantones','barrios','metodos_pagos','bancos'));
    }

    public function padrino_store(Request $request) {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'correo' => 'required',
            'tipo' => 'required',
            'fecha_inicio' => 'required',
            'fecha_final' => 'required',
            'fecha_nacimiento' => 'required',
            'id_barrio' => 'required',
            'id_metodo_pago' => 'required',
            'id_banco' => 'required',
        ]);

        // Crear el registro en la base de datos
        $padrino = Padrino::create($request->all());

        $padrino->update([
            'id_provincia' => $padrino->barrios->cantones->id_provincia,
            'id_canton' => $padrino->barrios->id_canton,
        ]);
        
        return redirect('/padrinos')->with(['mensaje' => 'Información Creada']);
    }

    public function padrino_update(Request $request, $id) {
        $padrino = Padrino::find($id);
        
        $padrino->update([
            'nombre' => $request['nombre'] ? $request['nombre'] : $padrino['nombre'],
            'apellido' => $request['apellido'] ? $request['apellido'] : $padrino['apellido'],
            'telefono' => $request['telefono'] ? $request['telefono'] : $padrino['telefono'],
            'direccion' => $request['direccion'] ? $request['direccion'] : $padrino['direccion'],
            'correo' => $request['correo'] ? $request['correo'] : $padrino['correo'],
            'tipo' => $request['tipo'] ? $request['tipo'] : $padrino['tipo'],
            'fecha_inicio' => $request['fecha_inicio'] ? $request['fecha_inicio'] : $padrino['fecha_inicio'],
            'fecha_final' => $request['fecha_final'] ? $request['fecha_final'] : $padrino['fecha_final'],
            'fecha_nacimiento' => $request['fecha_nacimiento'] ? $request['fecha_nacimiento'] : $padrino['fecha_nacimiento'],
            'id_provincia' => $request['id_provincia'] ? $request['id_provincia'] : $padrino['id_provincia'],
            'id_canton' => $request['id_canton'] ? $request['id_canton'] : $padrino['id_canton'],
            'id_barrio' => $request['id_barrio'] ? $request['id_barrio'] : $padrino['id_barrio'],
            'id_metodo_pago' => $request['id_metodo_pago'] ? $request['id_metodo_pago'] : $padrino['id_metodo_pago'],
            'id_banco' => $request['id_banco'] ? $request['id_banco'] : $padrino['id_banco'],
        ]);
        
        $padrino->update([
            'id_provincia' => $padrino->barrios->cantones->id_provincia,
            'id_canton' => $padrino->barrios->id_canton,
        ]);
        
        return redirect('/padrinos')->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Evaluaciones médicas
    public function evaluacion_medica_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = EvaluacionesMedica::with(['expedientes','clinicas'])
        ->where('fecha', 'LIKE', "%{$buscar}%")
        ->orWhereHas('expedientes', function ($query) use ($buscar) {
            $terms = explode(' ', $buscar); // Divide el término de búsqueda en palabras
            $query->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->where(function ($query) use ($term) {
                        $query->where('nombre1', 'LIKE', "%{$term}%")
                              ->orWhere('nombre2', 'LIKE', "%{$term}%")
                              ->orWhere('apellido1', 'LIKE', "%{$term}%")
                              ->orWhere('apellido2', 'LIKE', "%{$term}%");
                    });
                }
            });
        })
        ->orWhereHas('clinicas', function ($query) use ($buscar) {
            $query->where('clinica', 'LIKE', "%{$buscar}%");
        })
        ->orWhere('peso', 'LIKE', "%{$buscar}%")
        ->orWhere('talla', 'LIKE', "%{$buscar}%")
        ->orWhere('signos', 'LIKE', "%{$buscar}%")
        ->orWhere('notas', 'LIKE', "%{$buscar}%")
        ->paginate(20);

        return view('catalogo.evaluaciones_medicas.index', compact('datos'));
    }

    public function evaluacion_medica_index() {
        $datos = EvaluacionesMedica::paginate(20);
        return view('catalogo.evaluaciones_medicas.index', compact('datos'));
    }

    public function evaluacion_medica_create() {
        $expedientes = Expediente::all();
        $clinicas = Clinica::all();
        return view('catalogo.evaluaciones_medicas.create', compact('expedientes','clinicas'));
    }

    public function evaluacion_medica_view($id) {
        $dato = EvaluacionesMedica::find($id);
        return view('catalogo.evaluaciones_medicas.view', compact('dato'));
    }

    public function evaluacion_medica_edit($id) {
        $dato = EvaluacionesMedica::find($id);
        $expedientes = Expediente::all();
        $clinicas = Clinica::all();
        return view('catalogo.evaluaciones_medicas.edit', compact('dato','expedientes','clinicas'));
    }

    public function evaluacion_medica_store(Request $request) {
        $request->validate([
            'id_expediente' => 'required',
            'id_clinica' => 'required',
            'fecha' => 'required',
            'peso' => 'required',
            'talla' => 'required',
            'signos' => 'required',
            'notas' => 'required',
        ]);

        // Crear el registro en la base de datos
        $padrino = EvaluacionesMedica::create($request->all());
        
        return redirect('/evaluaciones_medicas')->with(['mensaje' => 'Información Creada']);
    }

    public function evaluacion_medica_update(Request $request, $id) {
        $evaluacion_medica = EvaluacionesMedica::find($id);
        
        $evaluacion_medica->update([
            'id_expediente' => $request['id_expediente'] ? $request['id_expediente'] : $evaluacion_medica['id_expediente'],
            'id_clinica' => $request['id_clinica'] ? $request['id_clinica'] : $evaluacion_medica['id_clinica'],
            'fecha' => $request['fecha'] ? $request['fecha'] : $evaluacion_medica['fecha'],
            'peso' => $request['peso'] ? $request['peso'] : $evaluacion_medica['peso'],
            'talla' => $request['talla'] ? $request['talla'] : $evaluacion_medica['talla'],
            'signos' => $request['signos'] ? $request['signos'] : $evaluacion_medica['signos'],
            'notas' => $request['notas'] ? $request['notas'] : $evaluacion_medica['notas'],
        ]);
        
        return redirect('/evaluaciones_medicas')->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Detalle evaluaciones médicas
    public function detalle_evaluacion_medica_index($id_em) {
        $datos = DetalleEvaluacionMedica::where('id_evaluacion_medica',$id_em)->paginate(20);
        return view('catalogo.detalle_evaluaciones_medicas.index', compact('datos','id_em'));
    }

    public function detalle_evaluacion_medica_create($id_em) {
        $especialidades = Especialidad::all();
        $semaforos = Semaforo::all();
        return view('catalogo.detalle_evaluaciones_medicas.create', compact('especialidades','semaforos','id_em'));
    }

    public function detalle_evaluacion_medica_view($id, $id_em) {
        $dato = DetalleEvaluacionMedica::find($id);
        return view('catalogo.detalle_evaluaciones_medicas.view', compact('dato','id_em'));
    }

    public function detalle_evaluacion_medica_edit($id_em, $id) {
        $dato = DetalleEvaluacionMedica::find($id);
        $especialidades = Especialidad::all();
        $semaforos = Semaforo::all();
        return view('catalogo.detalle_evaluaciones_medicas.edit', compact('dato','especialidades','semaforos','id_em'));
    }

    public function detalle_evaluacion_medica_store(Request $request, $id_em) {
        $request->validate([
            'id_especialidad' => 'required',
            'medico' => 'required',
            'diagnostico' => 'required',
            'observacion' => 'nullable',
            'id_semaforo' => 'required',
            'nombre_diente' => 'nullable',
            'descripcion' => 'nullable',
            'fecha' => 'required',
        ]);

        // Crear el registro en la base de datos
        $detalle_evaluaciones_medicas = DetalleEvaluacionMedica::create($request->all());

        $detalle_evaluaciones_medicas->update(['id_evaluacion_medica' => $id_em]);
        
        return redirect('/evaluaciones_medicas/detalle_evaluaciones_medicas/'.$id_em)->with(['mensaje' => 'Información Creada']);
    }

    public function detalle_evaluacion_medica_update(Request $request, $id, $id_em) {
        $detalle_evaluacion_medica = DetalleEvaluacionMedica::find($id);
        
        $detalle_evaluacion_medica->update([
            'id_especialidad' => $request['id_especialidad'] ? $request['id_especialidad'] : $detalle_evaluacion_medica['id_especialidad'],
            'medico' => $request['medico'] ? $request['medico'] : $detalle_evaluacion_medica['medico'],
            'diagnostico' => $request['diagnostico'] ? $request['diagnostico'] : $detalle_evaluacion_medica['diagnostico'],
            'obsevacion' => $request['obsevacion'] ? $request['obsevacion'] : $detalle_evaluacion_medica['obsevacion'],
            'id_semaforo' => $request['id_semaforo'] ? $request['id_semaforo'] : $detalle_evaluacion_medica['id_semaforo'],
            'nombre_diente' => $request['nombre_diente'] ? $request['nombre_diente'] : $detalle_evaluacion_medica['nombre_diente'],
            'descripcion' => $request['descripcion'] ? $request['descripcion'] : $detalle_evaluacion_medica['descripcion'],
            'fecha' => $request['fecha'] ? $request['fecha'] : $detalle_evaluacion_medica['fecha'],
        ]);
        
        return redirect('/evaluaciones_medicas/detalle_evaluaciones_medicas/'.$id_em)->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Enfermedades
    public function enfermedad_index($id_em) {
        $datos = Enfermedad::where('id_evaluacion_medica',$id_em)->paginate(20);
        return view('catalogo.enfermedades.index', compact('datos','id_em'));
    }

    public function enfermedad_create($id_em) {
        return view('catalogo.enfermedades.create', compact('id_em'));
    }

    public function enfermedad_view($id, $id_em) {
        $dato = Enfermedad::find($id);
        return view('catalogo.enfermedades.view', compact('dato','id_em'));
    }

    public function enfermedad_edit($id_em, $id) {
        $dato = Enfermedad::find($id);
        return view('catalogo.enfermedades.edit', compact('dato','id_em'));
    }

    public function enfermedad_store(Request $request, $id_em) {
        $request->validate([
            'enfermedad' => 'required',
            'medicamento' => 'required',
        ]);

        // Crear el registro en la base de datos
        Enfermedad::create([
            'id_evaluacion_medica' => $id_em,
            'id_expediente' => EvaluacionesMedica::find($id_em)->id_expediente,
            'enfermedad' => $request['enfermedad'],
            'medicamento' => $request['medicamento'],
        ]);

        return redirect('/evaluaciones_medicas/enfermedades/'.$id_em)->with(['mensaje' => 'Información Creada']);
    }

    public function enfermedad_update(Request $request, $id, $id_em) {
        $enfermedades = Enfermedad::find($id);
        
        $enfermedades->update([
            'enfermedad' => $request['enfermedad'] ? $request['enfermedad'] : $enfermedades['enfermedad'],
            'medicamento' => $request['medicamento'] ? $request['medicamento'] : $enfermedades['medicamento'],
        ]);
        
        return redirect('/evaluaciones_medicas/enfermedades/'.$id_em)->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Entregas mensuales
    public function entrega_mensual_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = EntregasMensuale::with(['expedientes','padrinos','insumos'])
        ->where('fecha', 'LIKE', "%{$buscar}%")
        ->orWhereHas('expedientes', function ($query) use ($buscar) {
            $terms = explode(' ', $buscar); // Divide el término de búsqueda en palabras
            $query->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->where(function ($query) use ($term) {
                        $query->where('nombre1', 'LIKE', "%{$term}%")
                              ->orWhere('nombre2', 'LIKE', "%{$term}%")
                              ->orWhere('apellido1', 'LIKE', "%{$term}%")
                              ->orWhere('apellido2', 'LIKE', "%{$term}%");
                    });
                }
            });
        })
        ->orWhereHas('padrinos', function ($query) use ($buscar) {
            $terms = explode(' ', $buscar); // Divide el término de búsqueda en palabras
            $query->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->where(function ($query) use ($term) {
                        $query->where('nombre', 'LIKE', "%{$term}%")
                              ->orWhere('apellido', 'LIKE', "%{$term}%");
                    });
                }
            });
        })
        ->orWhereHas('insumos', function ($query) use ($buscar) {
            $query->where('insumo', 'LIKE', "%{$buscar}%");
        })
        ->orWhere('observaciones', 'LIKE', "%{$buscar}%")
        ->paginate(20);

        return view('catalogo.entregas_mensuales.index', compact('datos'));
    }

    public function entrega_mensual_index() {
        $datos = EntregasMensuale::paginate(20);
        return view('catalogo.entregas_mensuales.index', compact('datos'));
    }

    public function entrega_mensual_create() {
        $expedientes = Expediente::all();
        $padrinos = Padrino::all();
        $insumos = Insumo::all();
        return view('catalogo.entregas_mensuales.create', compact('expedientes','padrinos','insumos'));
    }

    public function entrega_mensual_view($id) {
        $dato = EntregasMensuale::find($id);
        return view('catalogo.entregas_mensuales.view', compact('dato'));
    }

    public function entrega_mensual_edit($id) {
        $dato = EntregasMensuale::find($id);
        $expedientes = Expediente::all();
        $padrinos = Padrino::all();
        $insumos = Insumo::all();
        return view('catalogo.entregas_mensuales.edit', compact('dato','expedientes','padrinos','insumos'));
    }

    public function entrega_mensual_store(Request $request) {
        $request->validate([
            'id_expediente' => 'required',
            'id_padrino' => 'required',
            'id_insumos' => 'required',
            'fecha' => 'required',
        ]);

        // Crear el registro en la base de datos
        EntregasMensuale::create($request->all());
        
        return redirect('/entregas_mensuales')->with(['mensaje' => 'Información Creada']);
    }

    public function entrega_mensual_update(Request $request, $id) {
        $entrega_mensual = EntregasMensuale::find($id);
        
        $entrega_mensual->update([
            'id_expediente' => $request['id_expediente'] ? $request['id_expediente'] : $entrega_mensual['id_expediente'],
            'id_padrino' => $request['id_padrino'] ? $request['id_padrino'] : $entrega_mensual['id_padrino'],
            'id_insumos' => $request['id_insumos'] ? $request['id_insumos'] : $entrega_mensual['id_insumos'],
            'fecha' => $request['fecha'] ? $request['fecha'] : $entrega_mensual['fecha'],
            'observaciones' => $request['observaciones'] ? $request['observaciones'] : $entrega_mensual['observaciones'],
        ]);
        
        return redirect('/entregas_mensuales')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Detalle Entregas mensuales
    public function detalle_entrega_mensual_index($id_em) {
        $datos = DetalleEntregaMensual::where('id_entrega_mensual',$id_em)->paginate(20);
        return view('catalogo.detalle_entrega_mensual.index', compact('datos','id_em'));
    }

    public function detalle_entrega_mensual_create($id_em) {
        $tipos_entregas = TipoEntrega::all();
        return view('catalogo.detalle_entrega_mensual.create', compact('id_em','tipos_entregas'));
    }

    public function detalle_entrega_mensual_view($id, $id_em) {
        $dato = DetalleEntregaMensual::find($id);
        return view('catalogo.detalle_entrega_mensual.view', compact('dato','id_em'));
    }

    public function detalle_entrega_mensual_edit($id_em, $id) {
        $dato = DetalleEntregaMensual::find($id);
        $tipos_entregas = TipoEntrega::all();
        return view('catalogo.detalle_entrega_mensual.edit', compact('dato','id_em','tipos_entregas'));
    }

    public function detalle_entrega_mensual_store(Request $request, $id_em) {
        $request->validate([
            'id_tipoEntrega' => 'required',
        ]);

        // Crear el registro en la base de datos
        DetalleEntregaMensual::create([
            'id_entrega_mensual' => $id_em,
            'id_expediente' => EntregasMensuale::find($id_em)->id_expediente,
            'id_tipoEntrega' => $request['id_tipoEntrega'],
        ]);

        return redirect('/entregas_mensuales/detalle_entregas_mensuales/'.$id_em)->with(['mensaje' => 'Información Creada']);
    }

    public function detalle_entrega_mensual_update(Request $request, $id, $id_em) {
        $detalle_entrega_mensual = DetalleEntregaMensual::find($id);
        
        $detalle_entrega_mensual->update([
            'id_tipoEntrega' => $request['id_tipoEntrega'] ? $request['id_tipoEntrega'] : $detalle_entrega_mensual['id_tipoEntrega'],
        ]);
        
        return redirect('/entregas_mensuales/detalle_entregas_mensuales/'.$id_em)->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Cumpleaños
    public function cumpleaño_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Cumpleanio::with(['padrinos'])
        ->where('fecha', 'LIKE', "%{$buscar}%")
        ->orWhereHas('padrinos', function ($query) use ($buscar) {
            $terms = explode(' ', $buscar); // Divide el término de búsqueda en palabras
            $query->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->where(function ($query) use ($term) {
                        $query->where('nombre', 'LIKE', "%{$term}%")
                              ->orWhere('apellido', 'LIKE', "%{$term}%");
                    });
                }
            });
        })
        ->orWhere('fecha_entrega_carta', 'LIKE', "%{$buscar}%")
        ->orWhere('entrega_carta_presentacion', 'LIKE', "%{$buscar}%")
        ->orWhere('entrega_regalo', 'LIKE', "%{$buscar}%")
        ->orWhere('observaciones', 'LIKE', "%{$buscar}%")
        ->orWhere('regalo', 'LIKE', "%{$buscar}%")
        ->paginate(20);

        return view('catalogo.cumple.index', compact('datos'));
    }

    public function cumpleaño_index() {
        $datos = Cumpleanio::paginate(20);
        return view('catalogo.cumple.index', compact('datos'));
    }

    public function cumpleaño_create() {
        $padrinos = Padrino::all();
        return view('catalogo.cumple.create', compact('padrinos'));
    }

    public function cumpleaño_view($id) {
        $dato = Cumpleanio::find($id);
        return view('catalogo.cumple.view', compact('dato'));
    }

    public function cumpleaño_edit($id) {
        $dato = Cumpleanio::find($id);
        $padrinos = Padrino::all();
        return view('catalogo.cumple.edit', compact('dato','padrinos'));
    }

    public function cumpleaño_store(Request $request) {
        $request->validate([
            'id_padrino' => 'required',
            'fecha' => 'required',
            'fecha_entrega_carta' => 'required',
            'entrega_carta_presentacion' => 'required',
            'entrega_regalo' => 'required',
            'regalo' => 'required',
        ]);

        // Crear el registro en la base de datos
        Cumpleanio::create($request->all());
        
        return redirect('/cumpleaños')->with(['mensaje' => 'Información Creada']);
    }

    public function cumpleaño_update(Request $request, $id) {
        $cumpleaños = Cumpleanio::find($id);
        
        $cumpleaños->update([
            'id_padrino' => $request['id_padrino'] ? $request['id_padrino'] : $cumpleaños['id_padrino'],
            'fecha' => $request['fecha'] ? $request['fecha'] : $cumpleaños['fecha'],
            'fecha_entrega_carta' => $request['fecha_entrega_carta'] ? $request['fecha_entrega_carta'] : $cumpleaños['fecha_entrega_carta'],
            'entrega_carta_presentacion' => $request['entrega_carta_presentacion'] ? $request['entrega_carta_presentacion'] : $cumpleaños['entrega_carta_presentacion'],
            'entrega_regalo' => $request['entrega_regalo'] ? $request['entrega_regalo'] : $cumpleaños['entrega_regalo'],
            'observaciones' => $request['observaciones'] ? $request['observaciones'] : $cumpleaños['observaciones'],
            'regalo' => $request['regalo'] ? $request['regalo'] : $cumpleaños['regalo'],
        ]);
        
        return redirect('/cumpleaños')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Notas
    public function nota_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Nota::with(['expedientes','grados_escolares','ocupa_tutorias','semaforos'])
        ->where('promedio', 'LIKE', "%{$buscar}%")
        ->orWhereHas('expedientes', function ($query) use ($buscar) {
            $terms = explode(' ', $buscar); // Divide el término de búsqueda en palabras
            $query->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->where(function ($query) use ($term) {
                        $query->where('nombre1', 'LIKE', "%{$term}%")
                              ->orWhere('nombre2', 'LIKE', "%{$term}%")
                              ->orWhere('apellido1', 'LIKE', "%{$term}%")
                              ->orWhere('apellido2', 'LIKE', "%{$term}%");
                    });
                }
            });
        })
        ->orWhereHas('grados_escolares', function ($query) use ($buscar) {
            $query->where('grado_escolar', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('ocupa_tutorias', function ($query) use ($buscar) {
            $query->where('ocupa_tutoria', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('semaforos', function ($query) use ($buscar) {
            $query->where('semaforo', 'LIKE', "%{$buscar}%");
        })
        ->orWhere('fecha', 'LIKE', "%{$buscar}%")
        ->orWhere('tipo_promedio', 'LIKE', "%{$buscar}%")
        ->orWhere('observaciones', 'LIKE', "%{$buscar}%")
        ->paginate(20);

        return view('catalogo.notas.index', compact('datos'));
    }

    public function nota_index() {
        $datos = Nota::paginate(20);
        return view('catalogo.notas.index', compact('datos'));
    }

    public function nota_create() {
        $expedientes = Expediente::all();
        $grados_ecolares = GradosEscolare::all();
        $ocupar_tutorias = Ocupa_tutorias::all();
        $semaforos = Semaforo::all();
        return view('catalogo.notas.create', compact('expedientes','grados_ecolares','ocupar_tutorias','semaforos'));
    }

    public function nota_view($id) {
        $dato = Nota::find($id);
        return view('catalogo.notas.view', compact('dato'));
    }

    public function nota_edit($id) {
        $dato = Nota::find($id);
        $expedientes = Expediente::all();
        $grados_ecolares = GradosEscolare::all();
        $ocupar_tutorias = Ocupa_tutorias::all();
        $semaforos = Semaforo::all();
        return view('catalogo.notas.edit', compact('dato','expedientes','grados_ecolares','ocupar_tutorias','semaforos'));
    }

    public function nota_store(Request $request) {
        $request->validate([
            'id_expediente' => 'required',
            'promedio' => 'required',
            'fecha' => 'required',
            'id_grado_escolar' => 'required',
            'id_ocupa_tutoria' => 'required',
            'tipo_promedio' => 'required',
            'id_semaforo' => 'required',
        ]);

        // Crear el registro en la base de datos
        Nota::create($request->all());
        
        return redirect('/notas')->with(['mensaje' => 'Información Creada']);
    }

    public function nota_update(Request $request, $id) {
        $notas = Nota::find($id);
        
        $notas->update([
            'id_expediente' => $request['id_expediente'] ? $request['id_expediente'] : $notas['id_expediente'],
            'promedio' => $request['promedio'] ? $request['promedio'] : $notas['promedio'],
            'fecha' => $request['fecha'] ? $request['fecha'] : $notas['fecha'],
            'id_grado_escolar' => $request['id_grado_escolar'] ? $request['id_grado_escolar'] : $notas['id_grado_escolar'],
            'id_ocupa_tutoria' => $request['id_ocupa_tutoria'] ? $request['id_ocupa_tutoria'] : $notas['id_ocupa_tutoria'],
            'tipo_promedio' => $request['tipo_promedio'] ? $request['tipo_promedio'] : $notas['tipo_promedio'],
            'id_semaforo' => $request['id_semaforo'] ? $request['id_semaforo'] : $notas['id_semaforo'],
        ]);
        
        return redirect('/notas')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Insumos
    public function insumo_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Insumo::where('insumo', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.insumo.index', compact('datos'));
    }

    public function insumo_index() {
        $datos = Insumo::paginate(20);
        return view('catalogo.insumo.index', compact('datos'));
    }

    public function insumo_create() {
        return view('catalogo.insumo.create');
    }

    public function insumo_view($id) {
        $dato = Insumo::find($id);
        return view('catalogo.insumo.view', compact('dato'));
    }

    public function insumo_edit($id) {
        $dato = Insumo::find($id);
        return view('catalogo.insumo.edit', compact('dato'));
    }

    public function insumo_store(Request $request) {
        $request->validate([
            'insumo' => 'required',
        ]);

        // Crear el registro en la base de datos
        Insumo::create($request->all());
        
        return redirect('/insumos')->with(['mensaje' => 'Información Creada']);
    }

    public function insumo_update(Request $request, $id) {
        $notas = Insumo::find($id);
        
        $notas->update([
            'insumo' => $request['insumo'] ? $request['insumo'] : $notas['insumo'],
        ]);
        
        return redirect('/insumos')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Bancos
    public function banco_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Banco::where('banco', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.banco.index', compact('datos'));
    }

    public function banco_index() {
        $datos = Banco::paginate(20);
        return view('catalogo.banco.index', compact('datos'));
    }

    public function banco_create() {
        return view('catalogo.banco.create');
    }

    public function banco_view($id) {
        $dato = Banco::find($id);
        return view('catalogo.banco.view', compact('dato'));
    }

    public function banco_edit($id) {
        $dato = Banco::find($id);
        return view('catalogo.banco.edit', compact('dato'));
    }

    public function banco_store(Request $request) {
        $request->validate([
            'banco' => 'required',
        ]);

        // Crear el registro en la base de datos
        Banco::create($request->all());
        
        return redirect('/bancos')->with(['mensaje' => 'Información Creada']);
    }

    public function banco_update(Request $request, $id) {
        $notas = Banco::find($id);
        
        $notas->update([
            'banco' => $request['banco'] ? $request['banco'] : $notas['banco'],
        ]);
        
        return redirect('/bancos')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Becas
    public function beca_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Beca::where('beca', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.becas.index', compact('datos'));
    }

    public function beca_index() {
        $datos = Beca::paginate(20);
        return view('catalogo.becas.index', compact('datos'));
    }

    public function beca_create() {
        return view('catalogo.becas.create');
    }

    public function beca_view($id) {
        $dato = Beca::find($id);
        return view('catalogo.becas.view', compact('dato'));
    }

    public function beca_edit($id) {
        $dato = Beca::find($id);
        return view('catalogo.becas.edit', compact('dato'));
    }

    public function beca_store(Request $request) {
        $request->validate([
            'beca' => 'required',
        ]);

        // Crear el registro en la base de datos
        Beca::create($request->all());
        
        return redirect('/becas')->with(['mensaje' => 'Información Creada']);
    }

    public function beca_update(Request $request, $id) {
        $notas = Beca::find($id);
        
        $notas->update([
            'beca' => $request['beca'] ? $request['beca'] : $notas['beca'],
        ]);
        
        return redirect('/becas')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Centro educativo
    public function centro_educativo_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = CentroEducativo::where('centro_educativo', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.centro_educativo.index', compact('datos'));
    }

    public function centro_educativo_index() {
        $datos = CentroEducativo::paginate(20);
        return view('catalogo.centro_educativo.index', compact('datos'));
    }

    public function centro_educativo_create() {
        return view('catalogo.centro_educativo.create');
    }

    public function centro_educativo_view($id) {
        $dato = CentroEducativo::find($id);
        return view('catalogo.centro_educativo.view', compact('dato'));
    }

    public function centro_educativo_edit($id) {
        $dato = CentroEducativo::find($id);
        return view('catalogo.centro_educativo.edit', compact('dato'));
    }

    public function centro_educativo_store(Request $request) {
        $request->validate([
            'centro_educativo' => 'required',
        ]);

        // Crear el registro en la base de datos
        CentroEducativo::create($request->all());
        
        return redirect('/centros_educativos')->with(['mensaje' => 'Información Creada']);
    }

    public function centro_educativo_update(Request $request, $id) {
        $notas = CentroEducativo::find($id);
        
        $notas->update([
            'centro_educativo' => $request['centro_educativo'] ? $request['centro_educativo'] : $notas['centro_educativo'],
        ]);
        
        return redirect('/centros_educativos')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Clinicas
    public function clinica_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Clinica::where('clinica', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.clinica.index', compact('datos'));
    }

    public function clinica_index() {
        $datos = Clinica::paginate(20);
        return view('catalogo.clinica.index', compact('datos'));
    }

    public function clinica_create() {
        return view('catalogo.clinica.create');
    }

    public function clinica_view($id) {
        $dato = Clinica::find($id);
        return view('catalogo.clinica.view', compact('dato'));
    }

    public function clinica_edit($id) {
        $dato = Clinica::find($id);
        return view('catalogo.clinica.edit', compact('dato'));
    }

    public function clinica_store(Request $request) {
        $request->validate([
            'clinica' => 'required',
        ]);

        // Crear el registro en la base de datos
        Clinica::create($request->all());
        
        return redirect('/clinicas')->with(['mensaje' => 'Información Creada']);
    }

    public function clinica_update(Request $request, $id) {
        $clinicas = Clinica::find($id);
        
        $clinicas->update([
            'clinica' => $request['clinica'] ? $request['clinica'] : $clinicas['clinica'],
        ]);
        
        return redirect('/clinicas')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Comunidades
    public function comunidad_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Comunidad::where('comunidad', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.comunidad.index', compact('datos'));
    }

    public function comunidad_index() {
        $datos = Comunidad::paginate(20);
        return view('catalogo.comunidad.index', compact('datos'));
    }

    public function comunidad_create() {
        return view('catalogo.comunidad.create');
    }

    public function comunidad_view($id) {
        $dato = Comunidad::find($id);
        return view('catalogo.comunidad.view', compact('dato'));
    }

    public function comunidad_edit($id) {
        $dato = Comunidad::find($id);
        return view('catalogo.comunidad.edit', compact('dato'));
    }

    public function comunidad_store(Request $request) {
        $request->validate([
            'comunidad' => 'required',
        ]);

        // Crear el registro en la base de datos
        Comunidad::create($request->all());
        
        return redirect('/comunidades')->with(['mensaje' => 'Información Creada']);
    }

    public function comunidad_update(Request $request, $id) {
        $comunidades = Comunidad::find($id);
        
        $comunidades->update([
            'comunidad' => $request['comunidad'] ? $request['comunidad'] : $comunidades['comunidad'],
        ]);
        
        return redirect('/comunidades')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Especialidades
    public function especialidad_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Especialidad::where('especialidad', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.especialidades.index', compact('datos'));
    }

    public function especialidad_index() {
        $datos = Especialidad::paginate(20);
        return view('catalogo.especialidades.index', compact('datos'));
    }

    public function especialidad_create() {
        return view('catalogo.especialidades.create');
    }

    public function especialidad_view($id) {
        $dato = Especialidad::find($id);
        return view('catalogo.especialidades.view', compact('dato'));
    }

    public function especialidad_edit($id) {
        $dato = Especialidad::find($id);
        return view('catalogo.especialidades.edit', compact('dato'));
    }

    public function especialidad_store(Request $request) {
        $request->validate([
            'especialidad' => 'required',
        ]);

        // Crear el registro en la base de datos
        Especialidad::create($request->all());
        
        return redirect('/especialidades')->with(['mensaje' => 'Información Creada']);
    }

    public function especialidad_update(Request $request, $id) {
        $especialidades = Especialidad::find($id);
        
        $especialidades->update([
            'especialidad' => $request['especialidad'] ? $request['especialidad'] : $especialidades['especialidad'],
        ]);
        
        return redirect('/especialidades')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Grados escolares
    public function grado_escolar_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = GradosEscolare::where('grado_escolar', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.grado_escolar.index', compact('datos'));
    }

    public function grado_escolar_index() {
        $datos = GradosEscolare::paginate(20);
        return view('catalogo.grado_escolar.index', compact('datos'));
    }

    public function grado_escolar_create() {
        return view('catalogo.grado_escolar.create');
    }

    public function grado_escolar_view($id) {
        $dato = GradosEscolare::find($id);
        return view('catalogo.grado_escolar.view', compact('dato'));
    }

    public function grado_escolar_edit($id) {
        $dato = GradosEscolare::find($id);
        return view('catalogo.grado_escolar.edit', compact('dato'));
    }

    public function grado_escolar_store(Request $request) {
        $request->validate([
            'grado_escolar' => 'required',
        ]);

        // Crear el registro en la base de datos
        GradosEscolare::create($request->all());
        
        return redirect('/grados_escolares')->with(['mensaje' => 'Información Creada']);
    }

    public function grado_escolar_update(Request $request, $id) {
        $grados_escolares = GradosEscolare::find($id);
        
        $grados_escolares->update([
            'grado_escolar' => $request['grado_escolar'] ? $request['grado_escolar'] : $grados_escolares['grado_escolar'],
        ]);
        
        return redirect('/grados_escolares')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Método de pago
    public function metodo_de_pago_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = MetodosPago::where('metodo_pago', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.metodos_pagos.index', compact('datos'));
    }

    public function metodo_de_pago_index() {
        $datos = MetodosPago::paginate(20);
        return view('catalogo.metodos_pagos.index', compact('datos'));
    }

    public function metodo_de_pago_create() {
        return view('catalogo.metodos_pagos.create');
    }

    public function metodo_de_pago_view($id) {
        $dato = MetodosPago::find($id);
        return view('catalogo.metodos_pagos.view', compact('dato'));
    }

    public function metodo_de_pago_edit($id) {
        $dato = MetodosPago::find($id);
        return view('catalogo.metodos_pagos.edit', compact('dato'));
    }

    public function metodo_de_pago_store(Request $request) {
        $request->validate([
            'metodo_pago' => 'required',
        ]);

        // Crear el registro en la base de datos
        MetodosPago::create($request->all());
        
        return redirect('/metodos_de_pagos')->with(['mensaje' => 'Información Creada']);
    }

    public function metodo_de_pago_update(Request $request, $id) {
        $metodo_pago = MetodosPago::find($id);
        
        $metodo_pago->update([
            'metodo_pago' => $request['metodo_pago'] ? $request['metodo_pago'] : $metodo_pago['metodo_pago'],
        ]);
        
        return redirect('/metodos_de_pagos')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Motivo de baja
    public function motivo_de_baja_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = MotivoBaja::where('motivo_baja', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.motivo_baja.index', compact('datos'));
    }

    public function motivo_de_baja_index() {
        $datos = MotivoBaja::paginate(20);
        return view('catalogo.motivo_baja.index', compact('datos'));
    }

    public function motivo_de_baja_create() {
        return view('catalogo.motivo_baja.create');
    }

    public function motivo_de_baja_view($id) {
        $dato = MotivoBaja::find($id);
        return view('catalogo.motivo_baja.view', compact('dato'));
    }

    public function motivo_de_baja_edit($id) {
        $dato = MotivoBaja::find($id);
        return view('catalogo.motivo_baja.edit', compact('dato'));
    }

    public function motivo_de_baja_store(Request $request) {
        $request->validate([
            'motivo_baja' => 'required',
        ]);

        // Crear el registro en la base de datos
        MotivoBaja::create($request->all());
        
        return redirect('/motivos_de_bajas')->with(['mensaje' => 'Información Creada']);
    }

    public function motivo_de_baja_update(Request $request, $id) {
        $motivo_baja = MotivoBaja::find($id);
        
        $motivo_baja->update([
            'motivo_baja' => $request['motivo_baja'] ? $request['motivo_baja'] : $motivo_baja['motivo_baja'],
        ]);
        
        return redirect('/motivos_de_bajas')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Provincias
    public function provincia_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Provincia::where('provincia', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.provincia.index', compact('datos'));
    }

    public function provincia_index() {
        $datos = Provincia::paginate(20);
        return view('catalogo.provincia.index', compact('datos'));
    }

    public function provincia_create() {
        return view('catalogo.provincia.create');
    }

    public function provincia_view($id) {
        $dato = Provincia::find($id);
        return view('catalogo.provincia.view', compact('dato'));
    }

    public function provincia_edit($id) {
        $dato = Provincia::find($id);
        return view('catalogo.provincia.edit', compact('dato'));
    }

    public function provincia_store(Request $request) {
        $request->validate([
            'provincia' => 'required',
        ]);

        // Crear el registro en la base de datos
        Provincia::create($request->all());
        
        return redirect('/provincias')->with(['mensaje' => 'Información Creada']);
    }

    public function provincia_update(Request $request, $id) {
        $provincia = Provincia::find($id);
        
        $provincia->update([
            'provincia' => $request['provincia'] ? $request['provincia'] : $provincia['provincia'],
        ]);
        
        return redirect('/provincias')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Proyectos
    public function proyecto_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Proyecto::where('proyecto', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.proyectos.index', compact('datos'));
    }

    public function proyecto_index() {
        $datos = Proyecto::paginate(20);
        return view('catalogo.proyectos.index', compact('datos'));
    }

    public function proyecto_create() {
        return view('catalogo.proyectos.create');
    }

    public function proyecto_view($id) {
        $dato = Proyecto::find($id);
        return view('catalogo.proyectos.view', compact('dato'));
    }

    public function proyecto_edit($id) {
        $dato = Proyecto::find($id);
        return view('catalogo.proyectos.edit', compact('dato'));
    }

    public function proyecto_store(Request $request) {
        $request->validate([
            'proyecto' => 'required',
        ]);

        // Crear el registro en la base de datos
        Proyecto::create($request->all());
        
        return redirect('/proyectos')->with(['mensaje' => 'Información Creada']);
    }

    public function proyecto_update(Request $request, $id) {
        $proyecto = Proyecto::find($id);
        
        $proyecto->update([
            'proyecto' => $request['proyecto'] ? $request['proyecto'] : $proyecto['proyecto'],
        ]);
        
        return redirect('/proyectos')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Tipo de asistencia
    public function tipo_de_asistencia_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = TipoAsistencia::where('tipo_asistencia', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.tipo_asistencia.index', compact('datos'));
    }

    public function tipo_de_asistencia_index() {
        $datos = TipoAsistencia::paginate(20);
        return view('catalogo.tipo_asistencia.index', compact('datos'));
    }

    public function tipo_de_asistencia_create() {
        return view('catalogo.tipo_asistencia.create');
    }

    public function tipo_de_asistencia_view($id) {
        $dato = TipoAsistencia::find($id);
        return view('catalogo.tipo_asistencia.view', compact('dato'));
    }

    public function tipo_de_asistencia_edit($id) {
        $dato = TipoAsistencia::find($id);
        return view('catalogo.tipo_asistencia.edit', compact('dato'));
    }

    public function tipo_de_asistencia_store(Request $request) {
        $request->validate([
            'tipo_asistencia' => 'required',
        ]);

        // Crear el registro en la base de datos
        TipoAsistencia::create($request->all());
        
        return redirect('/tipos_de_asistencias')->with(['mensaje' => 'Información Creada']);
    }

    public function tipo_de_asistencia_update(Request $request, $id) {
        $tipo_asistencia = TipoAsistencia::find($id);
        
        $tipo_asistencia->update([
            'tipo_asistencia' => $request['tipo_asistencia'] ? $request['tipo_asistencia'] : $tipo_asistencia['tipo_asistencia'],
        ]);
        
        return redirect('/tipos_de_asistencias')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Tipo de entrega
    public function tipo_de_entrega_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = TipoEntrega::where('tipo_entrega', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.tipo_entrega.index', compact('datos'));
    }

    public function tipo_de_entrega_index() {
        $datos = TipoEntrega::paginate(20);
        return view('catalogo.tipo_entrega.index', compact('datos'));
    }

    public function tipo_de_entrega_create() {
        return view('catalogo.tipo_entrega.create');
    }

    public function tipo_de_entrega_view($id) {
        $dato = TipoEntrega::find($id);
        return view('catalogo.tipo_entrega.view', compact('dato'));
    }

    public function tipo_de_entrega_edit($id) {
        $dato = TipoEntrega::find($id);
        return view('catalogo.tipo_entrega.edit', compact('dato'));
    }

    public function tipo_de_entrega_store(Request $request) {
        $request->validate([
            'tipo_entrega' => 'required',
        ]);

        // Crear el registro en la base de datos
        TipoEntrega::create($request->all());
        
        return redirect('/tipos_de_entregas')->with(['mensaje' => 'Información Creada']);
    }

    public function tipo_de_entrega_update(Request $request, $id) {
        $tipo_entrega = TipoEntrega::find($id);
        
        $tipo_entrega->update([
            'tipo_entrega' => $request['tipo_entrega'] ? $request['tipo_entrega'] : $tipo_entrega['tipo_entrega'],
        ]);
        
        return redirect('/tipos_de_entregas')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Tipo de pobreza
    public function tipo_de_pobreza_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = TipoPobreza::where('tipo_pobreza', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.tipo_pobreza.index', compact('datos'));
    }

    public function tipo_de_pobreza_index() {
        $datos = TipoPobreza::paginate(20);
        return view('catalogo.tipo_pobreza.index', compact('datos'));
    }

    public function tipo_de_pobreza_create() {
        return view('catalogo.tipo_pobreza.create');
    }

    public function tipo_de_pobreza_view($id) {
        $dato = TipoPobreza::find($id);
        return view('catalogo.tipo_pobreza.view', compact('dato'));
    }

    public function tipo_de_pobreza_edit($id) {
        $dato = TipoPobreza::find($id);
        return view('catalogo.tipo_pobreza.edit', compact('dato'));
    }

    public function tipo_de_pobreza_store(Request $request) {
        $request->validate([
            'tipo_pobreza' => 'required',
        ]);

        // Crear el registro en la base de datos
        TipoPobreza::create($request->all());
        
        return redirect('/tipos_de_pobrezas')->with(['mensaje' => 'Información Creada']);
    }

    public function tipo_de_pobreza_update(Request $request, $id) {
        $tipo_pobreza = TipoPobreza::find($id);
        
        $tipo_pobreza->update([
            'tipo_pobreza' => $request['tipo_pobreza'] ? $request['tipo_pobreza'] : $tipo_pobreza['tipo_pobreza'],
        ]);
        
        return redirect('/tipos_de_pobrezas')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Barrios
    public function barrio_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Barrio::with(['cantones'])
        ->where('barrio', 'LIKE', "%{$buscar}%")
        ->orWhereHas('cantones', function ($query) use ($buscar) {
            $query->where('canton', 'LIKE', "%{$buscar}%");
        })->paginate(20);

        return view('catalogo.barrio.index', compact('datos'));
    }

    public function barrio_index() {
        $datos = Barrio::paginate(20);
        return view('catalogo.barrio.index', compact('datos'));
    }

    public function barrio_create() {
        $cantones = Cantone::all();
        return view('catalogo.barrio.create', compact('cantones'));
    }

    public function barrio_view($id) {
        $dato = Barrio::find($id);
        return view('catalogo.barrio.view', compact('dato'));
    }

    public function barrio_edit($id) {
        $dato = Barrio::find($id);
        $cantones = Cantone::all();
        return view('catalogo.barrio.edit', compact('dato','cantones'));
    }

    public function barrio_store(Request $request) {
        $request->validate([
            'barrio' => 'required',
            'id_canton' => 'required',
        ]);

        // Crear el registro en la base de datos
        Barrio::create($request->all());
        
        return redirect('/barrios')->with(['mensaje' => 'Información Creada']);
    }

    public function barrio_update(Request $request, $id) {
        $barrio = Barrio::find($id);
        
        $barrio->update([
            'barrio' => $request['barrio'] ? $request['barrio'] : $barrio['barrio'],
            'id_canton' => $request['id_canton'] ? $request['id_canton'] : $barrio['id_canton'],
        ]);
        
        return redirect('/barrios')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Cantones
    public function canton_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Cantone::with(['provincias'])
        ->where('canton', 'LIKE', "%{$buscar}%")
        ->orWhereHas('provincias', function ($query) use ($buscar) {
            $query->where('provincia', 'LIKE', "%{$buscar}%");
        })->paginate(20);

        return view('catalogo.canton.index', compact('datos'));
    }

    public function canton_index() {
        $datos = Cantone::paginate(20);
        return view('catalogo.canton.index', compact('datos'));
    }

    public function canton_create() {
        $provincias = Provincia::all();
        return view('catalogo.canton.create', compact('provincias'));
    }

    public function canton_view($id) {
        $dato = Cantone::find($id);
        return view('catalogo.canton.view', compact('dato'));
    }

    public function canton_edit($id) {
        $dato = Cantone::find($id);
        $provincias = Provincia::all();
        return view('catalogo.canton.edit', compact('dato','provincias'));
    }

    public function canton_store(Request $request) {
        $request->validate([
            'canton' => 'required',
            'id_provincia' => 'required',
        ]);

        // Crear el registro en la base de datos
        Cantone::create($request->all());
        
        return redirect('/cantones')->with(['mensaje' => 'Información Creada']);
    }

    public function canton_update(Request $request, $id) {
        $cantones = Cantone::find($id);
        
        $cantones->update([
            'canton' => $request['canton'] ? $request['canton'] : $cantones['canton'],
            'id_provincia' => $request['id_provincia'] ? $request['id_provincia'] : $cantones['id_provincia'],
        ]);
        
        return redirect('/cantones')->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Estado
    public function estado_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Estado::where('estado', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.estado.index', compact('datos'));
    }

    public function estado_index() {
        $datos = Estado::paginate(20);
        return view('catalogo.estado.index', compact('datos'));
    }

    public function estado_create() {
        return view('catalogo.estado.create');
    }

    public function estado_view($id) {
        $dato = Estado::find($id);
        return view('catalogo.estado.view', compact('dato'));
    }

    public function estado_edit($id) {
        $dato = Estado::find($id);
        return view('catalogo.estado.edit', compact('dato'));
    }

    public function estado_store(Request $request) {
        $request->validate([
            'estado' => 'required',
        ]);

        // Crear el registro en la base de datos
        Estado::create($request->all());
        
        return redirect('/estados')->with(['mensaje' => 'Información Creada']);
    }

    public function estado_update(Request $request, $id) {
        $estado = Estado::find($id);
        
        $estado->update([
            'estado' => $request['estado'] ? $request['estado'] : $estado['estado'],
        ]);
        
        return redirect('/estados')->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Baja de padrino
    public function baja_de_padrino_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = BajasPadrino::with(['padrinos','expedientes','motivo_bajas'])
        ->where('fecha_baja', 'LIKE', "%{$buscar}%")
        ->where('detalle_salida', 'LIKE', "%{$buscar}%")
        ->orWhereHas('padrinos', function ($query) use ($buscar) {
            $terms = explode(' ', $buscar); // Divide el término de búsqueda en palabras
            $query->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->where(function ($query) use ($term) {
                        $query->where('nombre', 'LIKE', "%{$term}%")
                              ->orWhere('apellido', 'LIKE', "%{$term}%");
                    });
                }
            });
        })
        ->orWhereHas('expedientes', function ($query) use ($buscar) {
            $terms = explode(' ', $buscar); // Divide el término de búsqueda en palabras
            $query->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->where(function ($query) use ($term) {
                        $query->where('nombre1', 'LIKE', "%{$term}%")
                              ->orWhere('nombre2', 'LIKE', "%{$term}%")
                              ->orWhere('apellido1', 'LIKE', "%{$term}%")
                              ->orWhere('apellido2', 'LIKE', "%{$term}%");
                    });
                }
            });
        })
        ->orWhereHas('motivo_bajas', function ($query) use ($buscar) {
            $query->where('motivo_baja', 'LIKE', "%{$buscar}%");
        })
        ->paginate(20);

        return view('catalogo.baja_padrinos.index', compact('datos'));
    }

    public function baja_de_padrino_index() {
        $datos = BajasPadrino::paginate(20);
        return view('catalogo.baja_padrinos.index', compact('datos'));
    }

    public function baja_de_padrino_create() {
        $padrinos = Padrino::all();
        $expedientes = Expediente::all();
        $motivo_bajas = MotivoBaja::all();
        return view('catalogo.baja_padrinos.create', compact('padrinos','expedientes','motivo_bajas'));
    }

    public function baja_de_padrino_view($id) {
        $dato = BajasPadrino::find($id);
        return view('catalogo.baja_padrinos.view', compact('dato'));
    }

    public function baja_de_padrino_edit($id) {
        $dato = BajasPadrino::find($id);
        $padrinos = Padrino::all();
        $expedientes = Expediente::all();
        $motivo_bajas = MotivoBaja::all();
        return view('catalogo.baja_padrinos.edit', compact('dato','padrinos','expedientes','motivo_bajas'));
    }

    public function baja_de_padrino_store(Request $request) {
        $request->validate([
            'id_padrino' => 'required',
            'id_expediente' => 'required',
            'fecha_baja' => 'required',
            'detalle_salida' => 'required',
            'id_motivo_baja' => 'required',
        ]);

        // Crear el registro en la base de datos
        BajasPadrino::create($request->all());
        
        return redirect('/bajas_de_padrinos')->with(['mensaje' => 'Información Creada']);
    }

    public function baja_de_padrino_update(Request $request, $id) {
        $baja_padrinos = BajasPadrino::find($id);
        
        $baja_padrinos->update([
            'id_padrino' => $request['id_padrino'] ? $request['id_padrino'] : $baja_padrinos['id_padrino'],
            'id_expediente' => $request['id_expediente'] ? $request['id_expediente'] : $baja_padrinos['id_expediente'],
            'fecha_baja' => $request['fecha_baja'] ? $request['fecha_baja'] : $baja_padrinos['fecha_baja'],
            'detalle_salida' => $request['detalle_salida'] ? $request['detalle_salida'] : $baja_padrinos['detalle_salida'],
            'id_motivo_baja' => $request['id_motivo_baja'] ? $request['id_motivo_baja'] : $baja_padrinos['id_motivo_baja'],
        ]);
        
        return redirect('/bajas_de_padrinos')->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Actividades
    public function actividad_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Actividad::with(['tipo_asistencias','proyectos'])
        ->where('actividad', 'LIKE', "%{$buscar}%")
        ->orWhere('fecha_creacion', 'LIKE', "%{$buscar}%")
        ->orWhere('fecha_actividad', 'LIKE', "%{$buscar}%")
        ->orWhere('patrocinador', 'LIKE', "%{$buscar}%")
        ->orWhere('observacion', 'LIKE', "%{$buscar}%")
        ->orWhereHas('tipo_asistencias', function ($query) use ($buscar) {
            $query->where('tipo_asistencia', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('proyectos', function ($query) use ($buscar) {
            $query->where('proyecto', 'LIKE', "%{$buscar}%");
        })
        ->paginate(20);

        return view('catalogo.actividades.index', compact('datos'));
    }

    public function actividad_index() {
        $datos = Actividad::paginate(20);
        return view('catalogo.actividades.index', compact('datos'));
    }

    public function actividad_create() {
        $tipos_asistencias = TipoAsistencia::all();
        $proyectos = Proyecto::all();
        return view('catalogo.actividades.create', compact('tipos_asistencias','proyectos'));
    }

    public function actividad_view($id) {
        $dato = Actividad::find($id);
        return view('catalogo.actividades.view', compact('dato'));
    }

    public function actividad_edit($id) {
        $dato = Actividad::find($id);
        $tipos_asistencias = TipoAsistencia::all();
        $proyectos = Proyecto::all();
        return view('catalogo.actividades.edit', compact('dato','tipos_asistencias','proyectos'));
    }

    public function actividad_store(Request $request) {
        $request->validate([
            'actividad' => 'required',
            'fecha_creacion' => 'required',
            'fecha_actividad' => 'required',
            'id_tipo_asistencia' => 'required',
            'patrocinador' => 'required',
            'id_proyecto' => 'required',
            'cantidad_total_invitados' => 'required',
        ]);

        // Crear el registro en la base de datos
        Actividad::create($request->all());
        
        return redirect('/actividades')->with(['mensaje' => 'Información Creada']);
    }

    public function actividad_update(Request $request, $id) {
        $actividades = Actividad::find($id);
        
        $actividades->update([
            'actividad' => $request['actividad'] ?? $actividades['actividad'],
            'fecha_actividad' => $request['fecha_actividad'] ?? $actividades['fecha_actividad'],
            'id_tipo_asistencia' => $request['id_tipo_asistencia'] ?? $actividades['id_tipo_asistencia'],
            'patrocinador' => $request['patrocinador'] ?? $actividades['patrocinador'],
            'id_proyecto' => $request['id_proyecto'] ?? $actividades['id_proyecto'],
            'cantidad_total_invitados' => $request['cantidad_total_invitados'] ?? $actividades['cantidad_total_invitados'],
            'cantidad_asistidos' => $request['cantidad_asistidos'] ?? $actividades['cantidad_asistidos'],
            'cantidad_ausentes' => $request['cantidad_ausentes'] ?? $actividades['cantidad_ausentes'],
            'observacion' => $request['observacion'] ?? $actividades['observacion'],
        ]);
        
        return redirect('/actividades')->with(['mensaje' => 'Información Actualizada']);
    }

    /////// Detalle Actividades
    public function detalle_actividad_index($id_a) {
        $datos = DetalleActividad::where('id_actividad',$id_a)->paginate(10);
        return view('catalogo.detalle_actividad.index', compact('datos','id_a'));
    }

    public function detalle_actividad_create($id_a) {
        $datos = [];
        
        $expedientes = Expediente::paginate(9);
        foreach ($expedientes as $key => $expediente) {
            $fecha = $expediente->fecha_nacimiento;

            if (strtotime($expediente->fecha_nacimiento) !== false) {
                // sacando edad del niño
                $fechaCarbon = Carbon::parse($fecha);
                $edad = Carbon::now()->year - $fechaCarbon->year;
                
                // saber si existe o no ese niño en la lista de la actividad
                $existe_niño = DetalleActividad::where('id_expediente', $expediente->id)
                ->where('id_actividad',$id_a)
                ->exists();

                $datos[] = [
                    'id' => $expediente->id,
                    'niño' => $expediente->nombre1 . ' ' . $expediente->nombre2 . ' ' . $expediente->apellido1 . ' ' . $expediente->apellido2,
                    'edad' => $edad,
                    'activo' => $existe_niño ? 1 : 0
                ];
            }
        }

        return view('catalogo.detalle_actividad.create', compact('id_a','datos','expedientes'));
    }

    public function detalle_actividad_view($id, $id_a) {
        $dato = DetalleActividad::find($id);
        return view('catalogo.detalle_actividad.view', compact('dato','id_a'));
    }

    public function detalle_actividad_edit($id_a, $id) {
        $dato = DetalleActividad::find($id);
        $actividades = Actividad::all();
        $expedientes = Expediente::all();
        $semaforos = Semaforo::all();
        return view('catalogo.detalle_actividad.edit', compact('dato','id_a','actividades','expedientes','semaforos'));
    }

    public function detalle_actividad_store(Request $request, $id_a, $id_niño, $activo) {

        if (!$activo) {
            // Crear el registro en la base de datos
            DetalleActividad::create([
                'id_actividad' => $id_a,
                'id_expediente' => $id_niño,
                'asistencia' => 'Si',
                'id_semaforo' => 1,
            ]);

            return redirect()->back()->with(['mensaje' => 'Agregado a la lista']);
        }
        return redirect()->back();
    }

    public function detalle_actividad_update(Request $request, $id, $id_a) {
        $detalle_actividad = DetalleActividad::find($id);

        if ($request['asistencia']) {
            $detalle_actividad->update([
                'asistencia' => $request['asistencia'] == 'Si' ? 'No' : 'Si'
            ]);

            return redirect()->back()->with(['mensaje' => 'Información Actualizada']);
        }else{
            $detalle_actividad->update([
                'observacion' => $request['observacion'] ? $request['observacion'] : $detalle_actividad['observacion'],
                'id_semaforo' => $request['id_semaforo'] ? $request['id_semaforo'] : $detalle_actividad['id_semaforo'],
            ]);
            
            return redirect('/actividades/detalles_actividades/'.$id_a)->with(['mensaje' => 'Información Actualizada']);
        }
    }

    public function detalle_actividad_delete($id) {
        DetalleActividad::destroy($id);
        return redirect()->back()->with(['mensaje' => 'Eliminador de la lista']);
    }

    /////// Tutores
    public function tutor_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Tutor::where('tutor', 'LIKE', "%{$buscar}%")->paginate(20);

        return view('catalogo.tutor.index', compact('datos'));
    }

    public function tutor_index() {
        $datos = Tutor::paginate(20);
        return view('catalogo.tutor.index', compact('datos'));
    }

    public function tutor_create() {
        return view('catalogo.tutor.create');
    }

    public function tutor_view($id) {
        $dato = Tutor::find($id);
        return view('catalogo.tutor.view', compact('dato'));
    }

    public function tutor_edit($id) {
        $dato = Tutor::find($id);
        return view('catalogo.tutor.edit', compact('dato'));
    }

    public function tutor_store(Request $request) {
        $request->validate([
            'tutor' => 'required',
        ]);

        // Crear el registro en la base de datos
        Tutor::create($request->all());
        
        return redirect('/tutores')->with(['mensaje' => 'Información Creada']);
    }

    public function tutor_update(Request $request, $id) {
        $tutores = Tutor::find($id);
        
        $tutores->update([
            'tutor' => $request['tutor'] ?? $tutores['tutor'],
        ]);
        
        return redirect('/tutores')->with(['mensaje' => 'Información Actualizada']);
    }
    
    /////// Tutorias
    public function tutoria_buscador_index(Request $request) {
        $buscar = $request->buscar;

        $datos = Tutoria::with(['tutores','expedientes','comunidades','semaforos'])
        ->where('promedio', 'LIKE', "%{$buscar}%")
        ->orWhereHas('tutores', function ($query) use ($buscar) {
            $query->where('tutor', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('expedientes', function ($query) use ($buscar) {
            $terms = explode(' ', $buscar); // Divide el término de búsqueda en palabras
            $query->where(function ($query) use ($terms) {
                foreach ($terms as $term) {
                    $query->where(function ($query) use ($term) {
                        $query->where('nombre1', 'LIKE', "%{$term}%")
                              ->orWhere('nombre2', 'LIKE', "%{$term}%")
                              ->orWhere('apellido1', 'LIKE', "%{$term}%")
                              ->orWhere('apellido2', 'LIKE', "%{$term}%");
                    });
                }
            });
        })
        ->orWhereHas('comunidades', function ($query) use ($buscar) {
            $query->where('comunidad', 'LIKE', "%{$buscar}%");
        })
        ->orWhereHas('semaforos', function ($query) use ($buscar) {
            $query->where('semaforo', 'LIKE', "%{$buscar}%");
        })
        ->paginate(20);

        return view('catalogo.tutoria.index', compact('datos'));
    }

    public function tutoria_index() {
        $datos = Tutoria::paginate(20);
        return view('catalogo.tutoria.index', compact('datos'));
    }

    public function tutoria_create() {
        $tutores = Tutor::all();
        $expedientes = Expediente::all();
        $semaforos = Semaforo::all();
        return view('catalogo.tutoria.create', compact('tutores','expedientes','semaforos'));
    }

    public function tutoria_view($id) {
        $dato = Tutoria::find($id);
        return view('catalogo.tutoria.view', compact('dato'));
    }

    public function tutoria_edit($id) {
        $dato = Tutoria::find($id);
        $tutores = Tutor::all();
        $expedientes = Expediente::all();
        $semaforos = Semaforo::all();
        return view('catalogo.tutoria.edit', compact('dato','tutores','expedientes','semaforos'));
    }

    public function tutoria_store(Request $request) {
        $request->validate([
            'id_tutor' => 'required',
            'id_expediente' => 'required',
            'id_semaforo' => 'required',
        ]);

        // Crear el registro en la base de datos
        $id_nota = Nota::where('id_expediente',$request['id_expediente'])->value('promedio');

        $tutoria = Tutoria::create([
            'id_tutor' => $request['id_tutor'],
            'id_expediente' => $request['id_expediente'],
            'id_comunidad' => Expediente::find($request['id_expediente'])->id_comunidad,
            'nota' => $request['nota'],
            'id_semaforo' => $request['id_semaforo'],
        ]);
        
        $id_nota ? $tutoria->update(['promedio' => $id_nota]) : '';

        return redirect('/tutorias')->with(['mensaje' => 'Información Creada']);
    }

    public function tutoria_update(Request $request, $id) {
        $tutorias = Tutoria::find($id);
    
        // Obtener el valor de 'promedio' si existe
        $id_nota = Nota::where('id_expediente', $request['id_expediente'])->value('promedio');
    
        // Crear el array de actualización
        $updateData = [
            'id_tutor' => $request['id_tutor'] ?? $tutorias['id_tutor'],
            'id_expediente' => $request['id_expediente'] ?? $tutorias['id_expediente'],
            'id_semaforo' => $request['id_semaforo'] ?? $tutorias['id_semaforo'],
        ];
    
        // Agregar 'promedio' solo si tiene un valor
        if ($id_nota) {
            $updateData['promedio'] = $id_nota;
        }
    
        // Actualizar la información en la base de datos
        $tutorias->update($updateData);

        return redirect('/tutorias')->with(['mensaje' => 'Información Actualizada']);
    }
}
