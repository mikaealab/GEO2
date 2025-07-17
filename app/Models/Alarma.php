<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alarma extends Model
{
    use HasFactory;

    protected $table = 'alarmas'; // Asegúrate de que el nombre de la tabla sea correcto

    protected $fillable = [
        'serie',
        'responsable',
        'tipo',
        'radio',
        'latitud',
        'longitud',
    ];
}