<?php

namespace App\Models\Taskmaker;

use Illuminate\Database\Eloquent\Model;

class actividades extends Model
{
    //
    protected $table = 'actividades';
    protected $primaryKey = 'id';
    protected $fillable = [
        'created_by',
        'utr_id',
        'actividad_id',
        'plazo_inicial',
        'plazo_final',
        'descripcion',
        'estatus',
        'numero_horas',
        'cadena',
        'repetible'
    ];
}
