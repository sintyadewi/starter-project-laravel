<?php

namespace App\Modules\Shared\Models;

use App\Modules\Admin\Models\Admin;
use App\Modules\Membership\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Role extends \jeremykenedy\LaravelRoles\Models\Role
{
    /**
     * @return BelongsToMany<Admin>|MorphToMany<Admin>
     */
    public function admins(): BelongsToMany|MorphToMany
    {
        return $this->morphedByMany(Admin::class, 'roleable', 'role_user');
    }

    /**
     * @return BelongsToMany<User>|MorphToMany<User>
     */
    public function users(): BelongsToMany|MorphToMany
    {
        return $this->morphedByMany(User::class, 'roleable', 'role_user');
    }
}
