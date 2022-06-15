<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Hash;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Member']);

        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'super@admin',
            'phone' => '1234567890',
            'id_number' => '1234567890',
            'is_active' => true,
            'sex' => 'male',
            'date_of_birth' => now(),
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'remember_token' => Str::random(10),
        ]);
        $admin->assignRole($role1);

        $functionaries = User::factory()->count(10)->create();
        foreach($functionaries as $functionary){
            $functionary->assignRole($role1);
        }

        $members = User::factory()->count(300)->create();
        foreach($members as $member){
            $member->assignRole($role2);
        }

    }
}
