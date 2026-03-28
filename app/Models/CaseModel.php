<?php
namespace App\Models;

use App\Traits\BelongsToLawyer;
use App\Traits\HasPermissions;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
// Modelo de Cases que representa todos lo Casos del sistema
class CaseModel extends Model {
    use BelongsToLawyer; // Filtra registros según el abogado asignado
    use HasPermissions; // Controla si el usuario puede editar ciertos registros
    use LogsActivity; // Registra automáticamente las acciones (create, update, delete)
    protected $table = 'cases'; // Asignación de la tabla que trabajará este modelo
    protected $fillable = [ // Campos que se llenarán masivamente
        'case_number',
        'subject',
        'specialist',
        'judge',
        'court',
        'status',
        'customer_id',
    ];
    // ---------------- Relaciones ----------------
    public function customer(){ // Relación de Cliente que hay en cada Caso
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function folders(){ // Relación de Folders que se crea por cada Caso
        return $this->hasMany(Folder::class, 'case_id');
    }
    public function events(){ // Relación de Eventos que se crea por cada Caso
        return $this->hasMany(Event::class, 'case_id');
    }
    public function payments(){ // Relación de Pagos que se crea por cada Caso
        return $this->hasMany(Payment::class, 'case_id');
    }
}
