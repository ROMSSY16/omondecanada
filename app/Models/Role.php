<?php

namespace App\Models;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function permissions(){
        return $this->belongsTomany(Permission::class,'roles_permissions', 'user_id', 'permission_id', 'id');
    }

    public function users(){
        return $this->belongsTomany(User::class,'users_roles', 'user_id', 'role_id', 'id');
    }

}
