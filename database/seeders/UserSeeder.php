<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Setting;
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

        $super_admin_role = Role::create(['name' => 'Super Admin']);
        $leader_role = Role::create(['name' => 'Ketua']);
        $co_leader_role = Role::create(['name' => 'Wakil Ketua']);
        $sekre_role = Role::create(['name' => 'Sekretaris']);
        $bendahara_role = Role::create(['name' => 'Bendahara']);
        $member_role = Role::create(['name' => 'Member']);

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
        $admin->assignRole($super_admin_role);

        $leader = User::factory()->count(1)->create();
        foreach($leader as $functionary){
            $functionary->assignRole($leader_role);
        }

        $co_leader = User::factory()->count(1)->create();
        foreach($co_leader as $functionary){
            $functionary->assignRole($co_leader_role);
        }

        $sekre = User::factory()->count(1)->create();
        foreach($sekre as $functionary){
            $functionary->assignRole($sekre_role);
        }

        $bendahara = User::factory()->count(1)->create();
        foreach($bendahara as $functionary){
            $functionary->assignRole($bendahara_role);
        }

        $members = User::factory()->count(3)->create();
        foreach($members as $member){
            $member->assignRole($member_role);
        }

        Setting::create([
            'key'=>'penalty_fee',
            'content'=>5000
        ]);

    }
}
