<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
// Modelo Specialty que representa todas las especialidad que el abogado puede tener
class Specialty extends Model {
    protected $fillable = ['name']; // Campo que se va a llenar masivamente
    // ---------------------- Relaciones  ----------------------
    public function lawyer(){ // Relación de Especialidades de cada Abogado (muchos a muchos)
        return $this->belongsToMany(User::class, 'lawyer_specialty');
    }
}
