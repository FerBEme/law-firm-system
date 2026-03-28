<?php
namespace App\Models;
use App\Traits\BelongsToLawyer;
use App\Traits\HasPermissions;
use App\Traits\LogsActivity;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// Modelo User que representa a todos los usuarios del sistema
// Puede ser abogado, secretaria o admin, según su rol
class User extends Authenticatable {
    // Incluimos Traits que agregan funcionalidades extras:
    // - Notificable: permite enviar notificaciones
    // - BelongsToLawyer: filtra registros según el abogado asignado
    // - HasPermissions: controla si el usuario puede editar ciertos registros
    // - LogsActivity: registra automáticamente las acciones (create, update, delete)
    use Notifiable, BelongsToLawyer, HasPermissions, LogsActivity;
    protected $fillable = [ // Campos que se pueden llenar masivamente
        'dni',
        'first_name',
        'paternal_surname',
        'maternal_surname',
        'phone',
        'email',
        'password',
        'role',             // 'admin', 'lawyer', 'secretary'
        'status',
        'profile_photo',
        'cal_number',
        'lawyer_id',        // Para relacionar secretarias con abogados
    ];
    protected $hidden = [ // Campos ocultos al serializar el modelo (ej. al convertir a JSON)
        'password',
    ];
    protected $casts = [ // Conversión automática de campos a tipos específicos
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    // ---------------------- Relaciones  ----------------------
    public function lawyer(){ // Relación de usuario con su abogado (si es secretaria)
        return $this->belongsTo(User::class, 'lawyer_id');
    }
    public function secretaries(){ // Relación de abogado con sus secretarias
        return $this->hasMany(User::class, 'lawyer_id');
    }    
    public function specialties(){ // Relación de abogado con sus especialidades (muchos a muchos)
        return $this->belongsToMany(Specialty::class, 'lawyer_specialty');
    }    
    public function foldersCreated(){ // Relación de carpetas creadas por el usuario
        return $this->hasMany(Folder::class, 'created_by');
    }    
    public function fileUploaded(){ // Relación de archivos cargadas por el usuario
        return $this->hasMany(File::class, 'uploaded_by');
    }    
    public function eventsCreated(){ // Relación de eventos creadas por el usuario
        return $this->hasMany(Event::class, 'created_by');
    }    
    public function activityLogs(){ // Relación de los logs de actividad del usuario
        return $this->hasMany(ActivityLog::class, 'user_id');
    }
    // ------------------- Scopes para filtrar usuarios por Rol -------------------
    public function scopeLawyers($query){
        return $query->where('role', 'lawyer');
    }
    public function scopeSecretaries($query) {
        return $query->where('role', 'secretary');
    }
}
