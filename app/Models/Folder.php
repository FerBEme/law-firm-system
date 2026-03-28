<?php
namespace App\Models;
use App\Traits\BelongsToLawyer;
use App\Traits\HasPermissions;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
class Folder extends Model {
    use BelongsToLawyer; // Filtra registros según el abogado asignado
    use HasPermissions; // Controla si el usuario puede editar ciertos registros
    use LogsActivity; // Registra automáticamente las acciones (create, update, delete)
    protected $fillable = [ // Campos que se pueden llenar masivamente
        'case_id',
        'parent_id',
        'name',
        'created_by',
    ];
    // ----------------- Relaciones -----------------
    public function case(){ // Relación de Folder con sus Casos
        return $this->belongsTo(CaseModel::class, 'case_id');
    }
    public function parent(){ // Relación de Folder con sus Subfolders
        return $this->belongsTo(Folder::class, 'parent_id');
    }
    public function subfolders(){ // Relación de Subfolders con su Folder
        return $this->hasMany(Folder::class, 'parent_id');
    }
    public function creator(){ // Relación de Folder por los Usuario que lo Crearon
        return $this->belongsTo(User::class, 'created_by');
    }
    public function files(){ // Relación de Archivos con su Folder
        return $this->hasMany(File::class, 'folder_id');
    }
}
