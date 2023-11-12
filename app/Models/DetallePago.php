<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetallePago extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'detalle_pagos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'encrypt_id', 'id_usuario','id_pago','status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function usuario()
    {
        return $this->belongsTo('App\Models\User','id_usuario','id');
    }

    public function pago()
    {
        return $this->belongsTo('App\Models\Pago','id_pago','id');
    }
}
