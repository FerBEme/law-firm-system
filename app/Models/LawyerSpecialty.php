<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
// Modelo de Abogado Especialidad que representa todas las especialidades que tienen los abogados
class LawyerSpecialty extends Model {
    protected $fillable = [ // Campos que se llenaran masivamente
        'lawyer_id',
        'specialty_id',
    ];
    // ---------------------- Relaciones  ----------------------
    public function lawyer(){ // Relación de Abogado que va a tener varias Especialidades
        return $this->belongsTo(User::class, 'lawyer_id');
    }
    public function specialty(){ // Relación de Especialidad que va a trabajar varios Abogados
        return $this->belongsTo(Specialty::class, 'specialty_id');
    }
}
