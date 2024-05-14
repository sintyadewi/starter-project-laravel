<?php

namespace App\Modules\Shared\Traits;

use App\Modules\Shared\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use jeremykenedy\LaravelRoles\Models\Role;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;

/**
 * @mixin Model
 */
trait HasRoleAndPermissionTrait
{
    use HasRoleAndPermission;

    /**
     * @return MorphToMany<Role>
     */
    public function roles(): MorphToMany
    {
        return $this->morphToMany(Role::class, 'roleable', 'role_user');
    }

    /**
     * @return MorphToMany<Permission>
     */
    public function userPermissions(): MorphToMany
    {
        return $this->morphToMany(Permission::class, 'permissionable', 'permission_user');
    }
}
