<?php
namespace App\Models;
use App\Traits\BelongsToLawyer;
use App\Traits\HasPermissions;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
class Payment extends Model {
    use BelongsToLawyer; // Filtra registros según el abogado asignado
    use HasPermissions; // Controla si el usuario puede editar ciertos registros
    use LogsActivity; // Registra automáticamente las acciones (create, update, delete)
    protected $fillable = [ // Campos que se pueden llenar masivamente
        'case_id',
        'type',
        'amount',
        'status',
        'description',
    ];
    // ------------ Relaciones ------------
    public function case(){ // Relación de Pago por cada Caso
        return $this->belongsTo(CaseModel::class, 'case_id');
    }
    public function receipts(){ // Relación de Recibos por cada Pago
        return $this->hasMany(Receipt::class, 'payment_id');
    }
}
