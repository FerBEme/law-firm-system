<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

trait HasPermissions
{
    public function canEdit()
    {
        // Obtenemos el usuario actualmente autenticado (el que está logueado)
        $user = Auth::user();

        // Si el usuario es admin, puede editar TODO sin restricciones
        if ($user->role === 'admin') return true;

        // Si el usuario es abogado (lawyer), también puede editar TODO
        if ($user->role === 'lawyer') return true;

        // Si el usuario es secretaria, aplican restricciones
        if ($user->role === 'secretary') {

            // Solo puede editar si:
            // 1. Ella misma creó el registro (created_by === id del usuario)
            // 2. Y NO han pasado más de 24 horas desde que se creó

            return $this->created_by === $user->id &&
                // Convertimos la fecha de creación a objeto Carbon
                // y calculamos cuántas horas han pasado hasta ahora
                Carbon::parse($this->created_at)->diffInHours(now()) <= 24;
        }
        
        // Si no cumple ningún caso anterior, NO puede editar
        return false;
    }
}
