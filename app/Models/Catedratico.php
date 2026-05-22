<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Catedratico extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombres',
        'apellidos',
        'email',
        'telefono',
        'especialidad',
        'fecha_contratacion',
        'estado',
    ];

    protected $casts = [
        'fecha_contratacion' => 'date',
    ];

    public function cursos(): HasMany
    {
        return $this->hasMany(Curso::class);
    }

    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombres} {$this->apellidos}";
    }
}
