<?php
namespace App\Traits;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
// Este trait se puede agregar a cualquier modelo para registrar automáticamente las acciones de creación, actualización y eliminación en la tabla de ActivityLog
trait LogsActivity {
    // Este método se ejecuta automáticamente al "bootear" el modelo Laravel llama a bootTraits, y por eso podemos enganchar eventos del modelo
    public static function bootLogsActivity() {        
        static::created(function ($model) { // Cuando se crea un modelo, se registra la acción 'created'
            self::log('created', $model);
        });        
        static::updated(function ($model) { // Cuando se actualiza un modelo, se registra la acción 'updated'
            self::log('updated', $model);
        });        
        static::deleted(function ($model) { // Cuando se elimina un modelo, se registra la acción 'deleted'
            self::log('deleted', $model);
        });
    }
    // Función que crea el registro en la tabla ActivityLog
    // Recibe:
    // - $action: 'created', 'updated' o 'deleted'
    // - $model: el modelo sobre el que ocurrió la acción
    protected static function log($action, $model) {
        ActivityLog::create([
            'user_id'     => Auth::id(),             // Usuario que hizo la acción
            'action'      => $action,                // Tipo de acción realizada
            'entity_type' => class_basename($model), // Nombre del modelo afectado
            'entity_id'   => $model->id,            // ID del registro afectado
            'description' => null,                   // Descripción adicional (actualmente null)
        ]);
    }
}