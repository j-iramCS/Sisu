<?php

namespace App\Models\Taskmaker;

use Illuminate\Database\Eloquent\Model;

class cat_utrs extends Model
{
    //
    protected $table = 'cat_utrs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'created_by',
        'nombre',
        'descripcion',
    ];
}
