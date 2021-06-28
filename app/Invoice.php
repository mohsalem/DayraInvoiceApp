<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function client()
    {
        $this->belongsTo(Client::class);
    }
    public function user()
    {
        $this->belongsTo(User::class);
    }
}
