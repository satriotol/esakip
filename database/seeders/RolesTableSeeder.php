<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Superadmin',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 08:49:14',
                'updated_at' => '2022-07-07 08:56:09',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Magang',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 08:56:43',
                'updated_at' => '2022-07-13 11:31:38',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' => '2022-07-13 11:37:36',
                'updated_at' => '2022-07-13 11:37:36',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'OPD',
                'guard_name' => 'web',
                'created_at' => '2022-10-01 19:09:09',
                'updated_at' => '2022-10-01 19:09:09',
            ),
        ));
        
        
    }
}