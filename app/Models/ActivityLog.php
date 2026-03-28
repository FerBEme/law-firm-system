<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ActivityLog extends Model {
    protected $fillable = [ // Campos que se pueden llenar masivamente
        'user_id',
        'action',
        'entity_type',
        'entity_id',
        'description',
    ];
    // --------------- Relaciones ---------------
    public function user(){ // Relación de Auditoria por cada Usuario
        return $this->belongsTo(User::class, 'user_id');
    }
}
