<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_id','address_envoice','wheigth','height','diseases','observations'
    ];
    protected $with = ['user'];
    //
    public function getStatusAttribute()
    {
        $invoices=$this->invoices->last();
        return isset($invoices) ? $invoices->status : 'sin facturar';
    }

    public function user()
    {
        //esta es la relacion de cliente con usuario
        //belong: cuando esta tabla (cliente) tiene clave foranea de la otra tabla (user)
        return $this->belongsTo('App\User');
    }

    public function invoices()
    {
        // esta es la relacion de cliente con factura
        //has: cuando la otra tabla (factura) tiene clave foranea de esta tabla (cliente)
        return $this->hasMany('App\Invoice');
    }
}
