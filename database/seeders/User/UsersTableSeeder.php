<?php

namespace Database\Seeders\User;

use App\Modules\Membership\Models\User;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole   = config('roles.models.role')::where('slug', '=', 'superadmin')->first();
        $permissions = config('roles.models.permission')::all();

        $newUser = config('roles.models.defaultUser')::firstOrCreate([
            'email' => 'demo@timedoor.net',
        ], [
            'name'              => 'Timedoor Indonesia',
            'password'          => 'demo123', // store deault password in .env for real project
            'email_verified_at' => now(),
        ]);

        $newUser->attachRole($adminRole);

        foreach ($permissions as $permission) {
            $newUser->attachPermission($permission);
        }
        
        /** @var Role $roleUser */
        $roleUser = Role::query()->where('slug', 'user')->first();

        User::factory(10)
            ->create()
            ->each(function (User $user) use ($roleUser) {
                $user->attachRole($roleUser);
            });
    }
}
