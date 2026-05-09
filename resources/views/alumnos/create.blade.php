
@extends('layouts.app')

@php
    $title = 'Inscribir Alumno';
@endphp

@section('slot')
    <div class="max-w-2xl">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-sm text-slate-400 mb-6">
            <a href="{{ route('alumnos.index') }}" class="hover:text-sky-600 transition-colors">Alumnos</a>
            <span>/</span>
            <span class="text-slate-600 font-medium">Inscripción</span>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">

            {{-- Header --}}
            <div class="px-6 py-4 border-b border-slate-100">
                <h2 class="font-semibold text-slate-800">Inscripción de nuevo alumno</h2>
                <p class="text-sm text-slate-400 mt-0.5">Los campos marcados con * son obligatorios.</p>
            </div>

            <form action="{{ route('alumnos.store') }}" method="POST" class="p-6 space-y-5">
                @csrf

                {{-- Sección: Identificación --}}
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-400 mb-3">
                        Identificación
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        {{-- Carnet --}}
                        <div>
                            <label for="carnet" class="block text-sm font-medium text-slate-700 mb-1.5">
                                Carnet *
                            </label>
                            <input type="text" id="carnet" name="carnet"
                                   value="{{ old('carnet') }}"
                                   placeholder="Ej: 202301045"
                                   class="w-full px-3.5 py-2.5 rounded-lg border text-sm font-mono
                                      text-slate-700 placeholder-slate-400 bg-white outline-none
                                      focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors
                                      {{ $errors->has('carnet') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                            @error('carnet')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Fecha de nacimiento --}}
                        <div>
                            <label for="fecha_nacimiento" class="block text-sm font-medium text-slate-700 mb-1.5">
                                Fecha de nacimiento
                            </label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                                   value="{{ old('fecha_nacimiento') }}"
                                   class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-sm
                                      text-slate-700 bg-white outline-none
                                      focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors">
                            @error('fecha_nacimiento')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Sección: Datos personales --}}
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-400 mb-3">
                        Datos personales
                    </p>
                    <div class="space-y-4">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            {{-- Nombres --}}
                            <div>
                                <label for="nombres" class="block text-sm font-medium text-slate-700 mb-1.5">
                                    Nombres *
                                </label>
                                <input type="text" id="nombres" name="nombres"
                                       value="{{ old('nombres') }}"
                                       placeholder="Ej: Carlos Andrés"
                                       class="w-full px-3.5 py-2.5 rounded-lg border text-sm text-slate-700
                                          placeholder-slate-400 bg-white outline-none
                                          focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors
                                          {{ $errors->has('nombres') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                                @error('nombres')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Apellidos --}}
                            <div>
                                <label for="apellidos" class="block text-sm font-medium text-slate-700 mb-1.5">
                                    Apellidos *
                                </label>
                                <input type="text" id="apellidos" name="apellidos"
                                       value="{{ old('apellidos') }}"
                                       placeholder="Ej: Morales Pérez"
                                       class="w-full px-3.5 py-2.5 rounded-lg border text-sm text-slate-700
                                          placeholder-slate-400 bg-white outline-none
                                          focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors
                                          {{ $errors->has('apellidos') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                                @error('apellidos')
                                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">
                                Correo institucional *
                            </label>
                            <input type="email" id="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="carlos.morales@universidad.edu"
                                   class="w-full px-3.5 py-2.5 rounded-lg border text-sm text-slate-700
                                      placeholder-slate-400 bg-white outline-none
                                      focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors
                                      {{ $errors->has('email') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                            @error('email')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Teléfono --}}
                        <div>
                            <label for="telefono" class="block text-sm font-medium text-slate-700 mb-1.5">
                                Teléfono
                            </label>
                            <input type="text" id="telefono" name="telefono"
                                   value="{{ old('telefono') }}"
                                   placeholder="+502 1234-5678"
                                   class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-sm
                                      text-slate-700 placeholder-slate-400 bg-white outline-none
                                      focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors">
                            @error('telefono')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Sección: Académico --}}
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest text-slate-400 mb-3">
                        Información académica
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">

                        {{-- Carrera --}}
                        <div class="sm:col-span-2">
                            <label for="carrera" class="block text-sm font-medium text-slate-700 mb-1.5">
                                Carrera *
                            </label>
                            <select id="carrera" name="carrera"
                                    class="w-full px-3.5 py-2.5 rounded-lg border text-sm text-slate-700
                                       bg-white outline-none
                                       focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors
                                       {{ $errors->has('carrera') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                                <option value="">Seleccionar carrera...</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera }}"
                                        {{ old('carrera') === $carrera ? 'selected' : '' }}>
                                        {{ $carrera }}
                                    </option>
                                @endforeach
                            </select>
                            @error('carrera')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Semestre --}}
                        <div>
                            <label for="semestre" class="block text-sm font-medium text-slate-700 mb-1.5">
                                Semestre *
                            </label>
                            <select id="semestre" name="semestre"
                                    class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 text-sm
                                       text-slate-700 bg-white outline-none
                                       focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors">
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('semestre', 1) == $i ? 'selected' : '' }}>
                                        {{ $i }}° semestre
                                    </option>
                                @endfor
                            </select>
                            @error('semestre')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Estado --}}
                        <div>
                            <label for="estado" class="block text-sm font-medium text-slate-700 mb-1.5">
                                Estado *
                            </label>
                            <select id="estado" name="estado"
                                    class="w-full px-3.5 py-2.5 rounded-lg border text-sm text-slate-700
                                       bg-white outline-none
                                       focus:ring-2 focus:ring-sky-500 focus:border-sky-500 transition-colors
                                       {{ $errors->has('estado') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                                <option value="activo"     {{ old('estado') === 'activo'     ? 'selected' : '' }}>Activo</option>
                                <option value="inactivo"   {{ old('estado') === 'inactivo'   ? 'selected' : '' }}>Inactivo</option>
                                <option value="graduado"   {{ old('estado') === 'graduado'   ? 'selected' : '' }}>Graduado</option>
                                <option value="suspendido" {{ old('estado') === 'suspendido' ? 'selected' : '' }}>Suspendido</option>
                            </select>
                            @error('estado')
                            <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Botones --}}
                <div class="flex items-center justify-end gap-3 pt-2 border-t border-slate-100">
                    <a href="{{ route('alumnos.index') }}"
                       class="px-4 py-2 text-sm font-medium text-slate-600 bg-slate-100
                          rounded-lg hover:bg-slate-200 transition-colors">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="px-5 py-2 text-sm font-medium text-white bg-sky-600
                               rounded-lg hover:bg-sky-700 transition-colors">
                        Inscribir alumno
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
