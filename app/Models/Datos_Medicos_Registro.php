<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Datos_Medicos_Registro extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'datos_medicos_registros' ;

    protected $fillable = [
        'user_id',
        'eps',
        'tipo_sangre',
        'alergias',
        'patologias',     
    ]; 

    public $timestamps = false;

}
