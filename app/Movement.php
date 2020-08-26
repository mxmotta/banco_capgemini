<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['value', 'type', 'account_id'];

    /**
     * Get the account that owns the movement.
     */
    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    public function scopeDeposits($query){
        return $query->where('type', 'deposit');
    }

    public function scopeWithdraws($query){
        return $query->where('type', 'withdraw');
    }
}
