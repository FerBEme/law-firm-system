<?php
namespace App\Models;
use App\Traits\BelongsToLawyer;
use App\Traits\HasPermissions;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
class File extends Model {
    use BelongsToLawyer; // Filtra registros según el abogado asignado
    use HasPermissions; // Controla si el usuario puede editar ciertos registros
    use LogsActivity; // Registra automáticamente las acciones (create, update, delete)
    protected $fillable = [ // Campos que se pueden llenar masivamente 
        'folder_id',
        'name',
        'file_path',
        'file_type',
        'file_size',
        'uploaded_by',
    ];
    // --------------------- Relaciones ---------------------
    public function folder(){ // Relación de Archivos con el Folder
        return $this->belongsTo(Folder::class, 'folder_id');
    }
    public function uploader(){ // Relación de Archivos con su Actualizador
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
