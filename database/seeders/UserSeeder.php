<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', '=', "satriotol69@gmail.com")->first();
        $user_admin = User::where('email', '=', "admin@admin.com")->first();
        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id', 'id')->all();
        $role->syncPermissions($permissions);
        if ($user === null) {
            $u = User::create([
                'name' => "Satrio Jati Wicaksono",
                'email' => 'satriotol69@gmail.com',
                'password' => Hash::make('pandeanlamper69b'),
            ]);
            $u->assignRole([$role->id]);
        }
        if ($user_admin === null) {
            User::create([
                'name' => "admin",
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123'),
            ]);
        }
    }
}
