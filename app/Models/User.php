<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
	
	/**
	 * The column associated with the UPDATED_AT timestamp.
	 *
	 * @var string
	 */
	const UPDATED_AT = null;
	

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
//        'remember_token',
    ];

	/**
     * Get the wallets for the user.
     */
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
	
	public function dd($param)
	{
		dd($this);
	}
	
	/*
DB::transaction(function () use ($bar) {
    $master = new  Master();
    $master->foo = $bar;

    $items = [];
    foreach ($myArray as $var) {
        $item = new  Item();
        $item->someField =  $field;

        $items[] = $item;
    }

    $master->save();
    $master->items()->saveMany($items);
});
	 */
}
