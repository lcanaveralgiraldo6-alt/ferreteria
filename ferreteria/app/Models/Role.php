<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Nombre de la tabla (opcional pero recomendado)
    protected $table = 'roles';

    // Campos permitidos para asignación masiva
    protected $fillable = ['nombre'];

    // Relación: un rol tiene muchos usuarios
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
