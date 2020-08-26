<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['account', 'digit'];

    /**
     * Get the movements for the account.
     */
    public function movements()
    {
        return $this->hasMany('App\Movement');
    }

    /**
     * Get the movements for the account.
     */
    public function deposits()
    {
        return $this->hasMany('App\Movement')->deposits();
    }

    /**
     * Get the movements for the account.
     */
    public function withdraws()
    {
        return $this->hasMany('App\Movement')->withdraws();
    }


    public function getBalanceAttribute(){
        return $this->deposits()->sum('value') - $this->withdraws()->sum('value');
    }

    public static function generateAccountNumber(){
        return [
            'account'    =>  rand(1, 9999999),
            'digit'      =>  rand(1, 99)
        ];
    }

    public static function exists($account_number){
        if(is_array($account_number)) {
            return self::where('account', $account_number['account'])
                ->where('digit', $account_number['digit'])->count() || false;
        }

        return false;
    }
}
