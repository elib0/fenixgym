<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'user_id','direc_factura','peso','estatura','enfermedades','observaciones'
    ];
    //
    public function getStatusAttribute()
    {
        $factura=$this->factura->last();
        return isset($factura) ? $factura->status : 'sin facturar';
    }

    public function user()
    {
        //esta es la relacion de cliente con usuario
        //belong: cuando esta tabla (cliente) tiene clave foranea de la otra tabla (user)
        return $this->belongsTo('App\User');
    }

    public function factura()
    {
        // esta es la relacion de cliente con factura
        //has: cuando la otra tabla (factura) tiene clave foranea de esta tabla (cliente)
        return $this->hasMany('App\Factura');
    }
}
