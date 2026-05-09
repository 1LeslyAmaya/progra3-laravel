
@extends('layouts.app')

@php
    $title = 'Alumnos';
@endphp

@section('slot')
    <div class="space-y-4">

        {{-- Cabecera --}}
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-slate-800">Registro de Alumnos</h2>
                <p class="text-sm text-slate-500">{{ $alumnos->total() }} alumnos registrados</p>
            </div>
            <a href="{{ route('alumnos.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-sky-600 text-white
                  text-sm font-medium rounded-lg hover:bg-sky-700 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4"/>
                </svg>
                Inscribir alumno
            </a>
        </div>

        {{-- Flash message --}}
        @if (session('success'))
            <div class="flex items-center gap-3 px-4 py-3 bg-emerald-50 border border-emerald-200
                    rounded-lg text-sm text-emerald-700">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        {{-- Tabla --}}
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                <tr class="bg-slate-50 text-left text-xs font-semibold text-slate-500
                           uppercase tracking-wider border-b border-slate-200">
                    <th class="px-6 py-3">Alumno</th>
                    <th class="px-6 py-3">Carnet</th>
                    <th class="px-6 py-3">Carrera</th>
                    <th class="px-6 py-3">Semestre</th>
                    <th class="px-6 py-3">Estado</th>
                    <th class="px-6 py-3 text-right">Acciones</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">

                @forelse ($alumnos as $alumno)
                    <tr class="hover:bg-slate-50 transition-colors">

                        {{-- Alumno (avatar + nombre + email) --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-700
                                        flex items-center justify-center text-xs font-bold flex-shrink-0">
                                    {{ strtoupper(substr($alumno->nombres, 0, 1) . substr($alumno->apellidos, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-medium text-slate-700">{{ $alumno->nombre_completo }}</p>
                                    <p class="text-xs text-slate-400">{{ $alumno->email }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Carnet --}}
                        <td class="px-6 py-4">
                        <span class="font-mono text-xs bg-slate-100 text-slate-600
                                     px-2 py-1 rounded">
                            {{ $alumno->carnet }}
                        </span>
                        </td>

                        {{-- Carrera --}}
                        <td class="px-6 py-4 text-slate-500 max-w-[180px] truncate">
                            {{ $alumno->carrera }}
                        </td>

                        {{-- Semestre --}}
                        <td class="px-6 py-4 text-slate-500">
                            {{ $alumno->semestre }}° semestre
                        </td>

                        {{-- Estado --}}
                        <td class="px-6 py-4">
                            @php
                                $badges = [
                                    'activo'     => 'bg-emerald-50 text-emerald-700',
                                    'inactivo'   => 'bg-slate-100 text-slate-500',
                                    'graduado'   => 'bg-sky-50 text-sky-700',
                                    'suspendido' => 'bg-red-50 text-red-600',
                                ];
                                $dots = [
                                    'activo'     => 'bg-emerald-500',
                                    'inactivo'   => 'bg-slate-400',
                                    'graduado'   => 'bg-sky-500',
                                    'suspendido' => 'bg-red-500',
                                ];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full
                                     text-xs font-medium {{ $badges[$alumno->estado] }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $dots[$alumno->estado] }}"></span>
                            {{ ucfirst($alumno->estado) }}
                        </span>
                        </td>

                        {{-- Acciones --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-1">

                                {{-- Ver expediente --}}
                                <a href="{{ route('alumnos.show', $alumno) }}"
                                   class="p-1.5 text-slate-400 hover:text-sky-600 hover:bg-sky-50
                                      rounded-lg transition-colors" title="Ver expediente">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z
                                             M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943
                                             9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </a>

                                {{-- Editar --}}
                                <a href="{{ route('alumnos.edit', $alumno) }}"
                                   class="p-1.5 text-slate-400 hover:text-amber-600 hover:bg-amber-50
                                      rounded-lg transition-colors" title="Editar">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                                             m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>

                                {{-- Dar de baja --}}
                                <form action="{{ route('alumnos.destroy', $alumno) }}" method="POST"
                                      onsubmit="return confirm('¿Dar de baja a {{ $alumno->nombre_completo }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50
                                               rounded-lg transition-colors" title="Dar de baja">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858
                                                 L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-14 text-center">
                            <p class="text-slate-400 text-sm">No hay alumnos registrados.</p>
                            <a href="{{ route('alumnos.create') }}"
                               class="mt-2 inline-block text-sm text-sky-600 hover:underline">
                                Inscribir primer alumno
                            </a>
                        </td>
                    </tr>
                @endforelse

                </tbody>
            </table>

            {{-- Paginación --}}
            @if ($alumnos->hasPages())
                <div class="px-6 py-4 border-t border-slate-100">
                    {{ $alumnos->links() }}
                </div>
            @endif
        </div>

    </div>
@endsection
