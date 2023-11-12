<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes, HasFactory;


    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'encrypt_id', 'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'id_trabajador',
        'id_estado', 'id_municipio', 'id_pais', 'id_institucion', 'id_role', 'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id', 'created_at', 'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role()
    {
        return $this->belongsTo('App\Models\Role','id_role','id');
    }

    public function institucion()
    {
        return $this->belongsTo('App\Models\Institucion','id_institucion','id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class,'id_estado','id');
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class,'id_pais','id');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class,'id_municipio','id');
    }

    public function documento()
    {
        return $this->hasMany('App\Models\Documento');
    }

    public function sugerencia()
    {
        return $this->hasMany('App\Models\Sugerencia');
    }

    public function notificacion()
    {
        return $this->hasMany('App\Models\Notificacion');
    }

    public function detalle_pago()
    {
        return $this->hasMany('App\Models\DetallePago');
    }
}
