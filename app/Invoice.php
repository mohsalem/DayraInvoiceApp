<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['user_id', 'client_id', 'amount', 'due_date'];
    public function client()
    {
        $this->belongsTo(Client::class);
    }
    public function user()
    {
        $this->belongsTo(User::class);
    }
}
