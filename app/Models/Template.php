<?php
namespace App\Models;
use App\Traits\BelongsToLawyer;
use App\Traits\HasPermissions;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
class Template extends Model {
    use BelongsToLawyer; // Filtra registros según el abogado asignado
    use HasPermissions; // Controla si el usuario puede editar ciertos registros
    use LogsActivity; // Registra automáticamente las acciones (create, update, delete)
    protected $fillable = [ // Campos que se pueden llenar masivamente
        'name',
        'content',
        'logo_path',
        'created_by',
    ];
    // ------------ Relaciones ------------
    public function creator(){ // Relación de Templates por cada Usuario creador
        return $this->belongsTo(User::class, 'created_by');
    }
}
