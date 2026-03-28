<?php
namespace App\Traits;
use Illuminate\Support\Facades\Auth;
// Este trait se puede agregar a cualquier modelo que esté relacionado con un abogado (lawyer)
// Permite filtrar automáticamente los registros según el usuario autenticado
trait BelongsToLawyer {
    // Scope para filtrar registros según el abogado asociado, se puede usar así: Model::forCurrentLawyer()->get();
    public function scopeForCurrentLawyer($query) {
        $user = Auth::user(); // Obtenemos el usuario actualmente autenticado        
        if ($user->role === 'lawyer') { // Si el usuario es un abogado, solo vemos registros donde él es el lawyer_id
            return $query->where('lawyer_id', $user->id);
        }
        if ($user->role === 'secretary') { // Si el usuario es secretaria, solo vemos registros del abogado al que está asignada
            return $query->where('lawyer_id', $user->lawyer_id);
        }        
        return $query; // Si no es lawyer ni secretary, devolvemos todos los registros (sin filtrar)
    }
}