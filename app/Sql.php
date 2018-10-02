<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Role;

class Sql extends Model
{
    protected $table = 'sqls';

    protected $fillable = [
        'bezeichnung', 'anweisung', 'options', 'ausgabe'
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }    

    /**
    * Check multiple roles
    * @param array $roles
    */
    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Check one role
     * @param string $role
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

}
