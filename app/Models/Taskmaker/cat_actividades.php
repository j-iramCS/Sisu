<?php

namespace App\Models\Taskmaker;

use Illuminate\Database\Eloquent\Model;

class cat_actividades extends Model
{
    //
    protected $table = 'cat_actividades';
    protected $primaryKey = 'id';
    protected $fillable = [
        'created_by',
        'nombre',
        'descripcion',
    ];
}
