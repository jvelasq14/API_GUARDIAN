<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Fases extends Model
{
    use HasFactory,  HasApiTokens;
    protected $table = 'fases' ;

    protected $fillable = [
        'user_id',
        'id_contactos', 
        'servicios',
        'fase_activa_voz'    
    ]; 

    public $timestamps = false;
}
