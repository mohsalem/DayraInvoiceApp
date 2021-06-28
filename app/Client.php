<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['full_name', 'mobile', 'email'];
    public function invoices()
    {
        $this->hasMany(Invoice::class);
    }
}
