<?php
namespace App\Models;
use App\Traits\HasPermissions;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
// Modelo Customer que representa todos los clientes que la empresa va a tener
class Customer extends Model {
    use HasPermissions; // Controla si el usuario puede editar ciertos registros
    use LogsActivity; // Registra automáticamente las acciones (create, update, delete)
    protected $fillable = [ // Campos que se van a llenar masivamente
        'document_type',
        'number_document',
        'first_name',
        'paternal_surname',
        'maternal_surname',
        'phone',
        'email',
        'address',
    ];
    // ---------------------- Relaciones  ----------------------
    public function cases(){ // Relación de Clientes que tiene cada caso
        return $this->hasMany(CaseModel::class);
    }
    public function receipts(){ // Relación de Clientes que hay con los Recibos de pagos
        return $this->hasMany(Receipt::class);
    }
}
