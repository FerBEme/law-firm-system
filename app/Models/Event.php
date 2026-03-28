<?php
namespace App\Models;
use App\Traits\BelongsToLawyer;
use App\Traits\HasPermissions;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
class Event extends Model {
    use BelongsToLawyer; // Filtra registros según el abogado asignado
    use HasPermissions; // Controla si el usuario puede editar ciertos registros
    use LogsActivity; // Registra automáticamente las acciones (create, update, delete)
    protected $fillable = [ // Campos que se pueden llenar masivamente
        'title',
        'description',
        'event_type',
        'start_datetime',
        'end_datetime',
        'meeting_link',
        'case_id',
        'created_by',
    ];
    // -------------- Relaciones --------------
    public function case(){ // Relación de Evento por su Caso
        return $this->belongsTo(CaseModel::class, 'case_id');
    }
    public function creator(){ // Relación de Evento con su Creador
        return $this->belongsTo(User::class, 'created_by');
    }
}
