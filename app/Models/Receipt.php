<?php
namespace App\Models;
use App\Traits\BelongsToLawyer;
use App\Traits\HasPermissions;
use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
class Receipt extends Model {
    use BelongsToLawyer; // Filtra registros según el abogado asignado
    use HasPermissions; // Controla si el usuario puede editar ciertos registros
    use LogsActivity; // Registra automáticamente las acciones (create, update, delete)
    protected $fillable = [ // Campos que se pueden llenar masivamente
        'payment_id',
        'customer_id',
        'receipt_number',
        'file_path',
    ];
    // ------------ Relaciones ------------
    public function payment(){ // relación de Recibos por cada Pago efectuado
        return $this->belongsTo(Payment::class, 'payment_id');
    }
    public function customer(){ // Relación de Recibos por cada Cliente
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
