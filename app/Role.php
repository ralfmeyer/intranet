<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Sql;

class Role extends Model
{
    //
    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function sqls(){
        return $this->belongsToMany(Sql::class);
    }
}
