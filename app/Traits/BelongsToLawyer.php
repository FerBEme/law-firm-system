<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

// Este trait se puede agregar a cualquier modelo que esté relacionado con un abogado (lawyer)
// Permite filtrar automáticamente los registros según el usuario autenticado
trait BelongsToLawyer
{
    // Scope para filtrar registros según el abogado asociado
    // Se puede usar así: Model::forCurrentLawyer()->get();
    public function scopeForCurrentLawyer($query)
    {
        // Obtenemos el usuario actualmente autenticado
        $user = Auth::user();

        // Si el usuario es un abogado, solo vemos registros donde él es el lawyer_id
        if ($user->role === 'lawyer') {
            return $query->where('lawyer_id', $user->id);
        }

        // Si el usuario es secretaria, solo vemos registros del abogado al que está asignada
        if ($user->role === 'secretary') {
            return $query->where('lawyer_id', $user->lawyer_id);
        }

        // Si no es lawyer ni secretary, devolvemos todos los registros (sin filtrar)
        return $query;
    }
}