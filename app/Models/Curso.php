<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'catedratico_id',
        'codigo',
        'nombre',
        'descripcion',
        'creditos',
        'ciclo',
        'modalidad',
        'cupo',
        'estado',
    ];

    public function catedratico(): BelongsTo
    {
        return $this->belongsTo(Catedratico::class);
    }
}
