<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Permission;
use App\Models\User;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = ['slug','name'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
}
