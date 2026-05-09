<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    // Se agrega temporalmente, mas adelante se crea la tabla
    private array $carreras = [
        'Ingeniería en Sistemas',
        'Ingeniería Civil',
        'Administración de Empresas',
        'Medicina',
        'Derecho',
    ];

    // GET /alumnos
    public function index()
    {
        $alumnos = Alumno::latest()->paginate(10);
        return view('alumnos.index', compact('alumnos'));
    }

    // GET /alumnos/create
    public function create()
    {
        $carreras = $this->carreras;
        return view('alumnos.create', compact('carreras'));
    }

    // POST /alumnos
    public function store(Request $request)
    {
        $validated = $request->validate([ //validacion del formulario de registro
            'carnet'           => 'required|string|max:20|unique:alumnos,carnet',
            'nombres'          => 'required|string|max:100',
            'apellidos'        => 'required|string|max:100',
            'email'            => 'required|email|unique:alumnos,email',
            'telefono'         => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date|before:today',
            'carrera'          => 'required|string|in:' . implode(',', $this->carreras),
            'semestre'         => 'required|integer|min:1|max:10',
            'estado'           => 'required|in:activo,inactivo,graduado,suspendido',
        ]);

        Alumno::create($validated);

        return redirect()->route('alumnos.index')
            ->with('success', 'Alumno inscrito correctamente.');
    }

    // GET /alumnos/{alumno}
    public function show(Alumno $alumno)
    {
        return view('alumnos.show', compact('alumno'));
    }

    // GET /alumnos/{alumno}/edit
    public function edit(Alumno $alumno)
    {
        $carreras = $this->carreras;
        return view('alumnos.edit', compact('alumno', 'carreras'));
    }

    // PUT /alumnos/{alumno}
    public function update(Request $request, Alumno $alumno)
    {
        $validated = $request->validate([
            'carnet'           => 'required|string|max:20|unique:alumnos,carnet,' . $alumno->id,
            'nombres'          => 'required|string|max:100',
            'apellidos'        => 'required|string|max:100',
            'email'            => 'required|email|unique:alumnos,email,' . $alumno->id,
            'telefono'         => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date|before:today',
            'carrera'          => 'required|string|in:' . implode(',', $this->carreras),
            'semestre'         => 'required|integer|min:1|max:10',
            'estado'           => 'required|in:activo,inactivo,graduado,suspendido',
        ]);

        $alumno->update($validated);

        return redirect()->route('alumnos.index')
            ->with('success', 'Datos del alumno actualizados.');
    }

    // DELETE /alumnos/{alumno}
    public function destroy(Alumno $alumno)
    {
        $alumno->delete();

        return redirect()->route('alumnos.index')
            ->with('success', 'Alumno dado de baja del sistema.');
    }
}
