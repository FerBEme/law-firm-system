<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

// Este trait se puede agregar a cualquier modelo para registrar automáticamente 
// las acciones de creación, actualización y eliminación en la tabla de ActivityLog
trait LogsActivity
{
    // Este método se ejecuta automáticamente al "bootear" el modelo
    // Laravel llama a bootTraits, y por eso podemos enganchar eventos del modelo
    public static function bootLogsActivity()
    {
        // Cuando se crea un modelo, se registra la acción 'created'
        static::created(function ($model) {
            self::log('created', $model);
        });

        // Cuando se actualiza un modelo, se registra la acción 'updated'
        static::updated(function ($model) {
            self::log('updated', $model);
        });

        // Cuando se elimina un modelo, se registra la acción 'deleted'
        static::deleted(function ($model) {
            self::log('deleted', $model);
        });
    }

    // Función que crea el registro en la tabla ActivityLog
    // Recibe:
    // - $action: 'created', 'updated' o 'deleted'
    // - $model: el modelo sobre el que ocurrió la acción
    protected static function log($action, $model)
    {
        ActivityLog::create([
            'user_id'     => Auth::id(),             // Usuario que hizo la acción
            'action'      => $action,                // Tipo de acción realizada
            'entity_type' => class_basename($model), // Nombre del modelo afectado
            'entity_id'   => $model->id,            // ID del registro afectado
            'description' => null,                   // Descripción adicional (actualmente null)
        ]);
    }
}