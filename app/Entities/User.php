<?php

declare(strict_types=1);

namespace App\Entities;

use App\Entities\Acl\Permission;
use App\Entities\Acl\Role;
use App\Entities\Acl\RoleUser;
use App\Enums\UserRoleEnum;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, UuidTrait;

    protected $fillable = [
        'uuid',
        'name',
        'document',
        'email',
        'password',
        'user_status_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function userStatus(): BelongsTo
    {
        return $this->belongsTo(UserStatus::class);
    }

    public function rolesUsers(): HasOne
    {
        return $this->hasOne(RoleUser::class, 'user_id');
    }

    public function permissions()
    {
        return $this->rolesUsers
            ->roles
            ->rolesPermissions
            ->pluck('permission_slug')
            ->toArray();
    }

    public function isMaster(): bool
    {
        return $this->role->contains('id', UserRoleEnum::MASTER->value);
    }

    public function isSecretary(): bool
    {
        return $this->role->contains('id', UserRoleEnum::SECRETARY->value);
    }

    public function isExternal(): bool
    {
        return $this->role->contains('id', UserRoleEnum::EXTERNAL->value);
    }

    public function getAllPermissionSlug()
    {
        return $this->roles->flatMap(function ($role) {
            return $role->permissions->pluck('slug');
        })->merge($this->permissions->pluck('slug'))->unique()->toArray();
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
        // return [
        //     'roles' => $this->roles->map(fn ($i) => strtolower($i['name'])),
        //     'permissions' => $this->getAllPermissionSlug()
        // ];
    }
}
