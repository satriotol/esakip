<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'role-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 08:49:14',
                'updated_at' => '2022-07-07 08:49:14',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'role-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 08:49:14',
                'updated_at' => '2022-07-07 08:49:14',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'role-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 08:49:14',
                'updated_at' => '2022-07-07 08:49:14',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'role-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 08:49:14',
                'updated_at' => '2022-07-07 08:49:14',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'user-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 08:49:14',
                'updated_at' => '2022-07-07 08:49:14',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'user-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 08:49:14',
                'updated_at' => '2022-07-07 08:49:14',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'user-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 08:49:14',
                'updated_at' => '2022-07-07 08:49:14',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'user-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 08:49:14',
                'updated_at' => '2022-07-07 08:49:14',
            ),
            8 => 
            array (
                'id' => 13,
                'name' => 'opdPerjanjianKinerja-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 09:13:15',
                'updated_at' => '2022-07-07 09:13:15',
            ),
            9 => 
            array (
                'id' => 14,
                'name' => 'opdPerjanjianKinerja-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 09:13:15',
                'updated_at' => '2022-07-07 09:13:15',
            ),
            10 => 
            array (
                'id' => 15,
                'name' => 'opdPerjanjianKinerja-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 09:13:15',
                'updated_at' => '2022-07-07 09:13:15',
            ),
            11 => 
            array (
                'id' => 16,
                'name' => 'opdPerjanjianKinerja-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 09:13:15',
                'updated_at' => '2022-07-07 09:13:15',
            ),
            12 => 
            array (
                'id' => 17,
                'name' => 'permission-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 09:15:04',
                'updated_at' => '2022-07-07 09:15:04',
            ),
            13 => 
            array (
                'id' => 18,
                'name' => 'permission-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 09:15:04',
                'updated_at' => '2022-07-07 09:15:04',
            ),
            14 => 
            array (
                'id' => 19,
                'name' => 'permission-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 09:15:04',
                'updated_at' => '2022-07-07 09:15:04',
            ),
            15 => 
            array (
                'id' => 20,
                'name' => 'permission-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 09:15:04',
                'updated_at' => '2022-07-07 09:15:04',
            ),
            16 => 
            array (
                'id' => 21,
                'name' => 'evaluasiKinerja-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 09:39:03',
                'updated_at' => '2022-07-07 09:39:03',
            ),
            17 => 
            array (
                'id' => 22,
                'name' => 'evaluasiKinerja-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 09:39:03',
                'updated_at' => '2022-07-07 09:39:03',
            ),
            18 => 
            array (
                'id' => 23,
                'name' => 'evaluasiKinerja-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 09:39:03',
                'updated_at' => '2022-07-07 09:39:03',
            ),
            19 => 
            array (
                'id' => 24,
                'name' => 'evaluasiKinerja-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 09:39:03',
                'updated_at' => '2022-07-07 09:39:03',
            ),
            20 => 
            array (
                'id' => 25,
                'name' => 'evaluasiKinerjaYear-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 12:38:17',
                'updated_at' => '2022-07-07 12:38:17',
            ),
            21 => 
            array (
                'id' => 26,
                'name' => 'evaluasiKinerjaYear-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 12:38:17',
                'updated_at' => '2022-07-07 12:38:17',
            ),
            22 => 
            array (
                'id' => 27,
                'name' => 'evaluasiKinerjaYear-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 12:38:17',
                'updated_at' => '2022-07-07 12:38:17',
            ),
            23 => 
            array (
                'id' => 28,
                'name' => 'evaluasiKinerjaYear-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 12:38:17',
                'updated_at' => '2022-07-07 12:38:17',
            ),
            24 => 
            array (
                'id' => 29,
                'name' => 'link-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 13:38:14',
                'updated_at' => '2022-07-07 13:38:14',
            ),
            25 => 
            array (
                'id' => 30,
                'name' => 'link-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 13:38:14',
                'updated_at' => '2022-07-07 13:38:14',
            ),
            26 => 
            array (
                'id' => 31,
                'name' => 'link-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 13:38:14',
                'updated_at' => '2022-07-07 13:38:14',
            ),
            27 => 
            array (
                'id' => 32,
                'name' => 'link-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 13:38:14',
                'updated_at' => '2022-07-07 13:38:14',
            ),
            28 => 
            array (
                'id' => 33,
                'name' => 'opdLkjip-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 13:46:51',
                'updated_at' => '2022-07-07 13:46:51',
            ),
            29 => 
            array (
                'id' => 34,
                'name' => 'opdLkjip-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 13:46:51',
                'updated_at' => '2022-07-07 13:46:51',
            ),
            30 => 
            array (
                'id' => 35,
                'name' => 'opdLkjip-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 13:46:51',
                'updated_at' => '2022-07-07 13:46:51',
            ),
            31 => 
            array (
                'id' => 36,
                'name' => 'opdLkjip-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 13:46:51',
                'updated_at' => '2022-07-07 13:46:51',
            ),
            32 => 
            array (
                'id' => 37,
                'name' => 'kotaLkjip-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 13:46:51',
                'updated_at' => '2022-07-07 13:46:51',
            ),
            33 => 
            array (
                'id' => 38,
                'name' => 'kotaLkjip-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 13:46:51',
                'updated_at' => '2022-07-07 13:46:51',
            ),
            34 => 
            array (
                'id' => 39,
                'name' => 'kotaLkjip-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 13:46:51',
                'updated_at' => '2022-07-07 13:46:51',
            ),
            35 => 
            array (
                'id' => 40,
                'name' => 'kotaLkjip-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 13:46:51',
                'updated_at' => '2022-07-07 13:46:51',
            ),
            36 => 
            array (
                'id' => 41,
                'name' => 'kotaIku-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:38:35',
                'updated_at' => '2022-07-07 14:38:35',
            ),
            37 => 
            array (
                'id' => 42,
                'name' => 'kotaIku-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:38:35',
                'updated_at' => '2022-07-07 14:38:35',
            ),
            38 => 
            array (
                'id' => 43,
                'name' => 'kotaIku-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:38:35',
                'updated_at' => '2022-07-07 14:38:35',
            ),
            39 => 
            array (
                'id' => 44,
                'name' => 'kotaIku-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:38:35',
                'updated_at' => '2022-07-07 14:38:35',
            ),
            40 => 
            array (
                'id' => 45,
                'name' => 'opdIku-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:38:35',
                'updated_at' => '2022-07-07 14:38:35',
            ),
            41 => 
            array (
                'id' => 46,
                'name' => 'opdIku-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:38:35',
                'updated_at' => '2022-07-07 14:38:35',
            ),
            42 => 
            array (
                'id' => 47,
                'name' => 'opdIku-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:38:35',
                'updated_at' => '2022-07-07 14:38:35',
            ),
            43 => 
            array (
                'id' => 48,
                'name' => 'opdIku-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:38:35',
                'updated_at' => '2022-07-07 14:38:35',
            ),
            44 => 
            array (
                'id' => 49,
                'name' => 'kotaPerjanjianKinerja-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:41:15',
                'updated_at' => '2022-07-07 14:41:15',
            ),
            45 => 
            array (
                'id' => 50,
                'name' => 'kotaPerjanjianKinerja-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:41:15',
                'updated_at' => '2022-07-07 14:41:15',
            ),
            46 => 
            array (
                'id' => 51,
                'name' => 'kotaPerjanjianKinerja-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:41:15',
                'updated_at' => '2022-07-07 14:41:15',
            ),
            47 => 
            array (
                'id' => 52,
                'name' => 'kotaPerjanjianKinerja-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:41:15',
                'updated_at' => '2022-07-07 14:41:15',
            ),
            48 => 
            array (
                'id' => 53,
                'name' => 'pengukuranKinerja',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:51:09',
                'updated_at' => '2022-07-07 14:51:09',
            ),
            49 => 
            array (
                'id' => 54,
                'name' => 'kotaPengukuranKinerja',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:51:09',
                'updated_at' => '2022-07-07 14:51:09',
            ),
            50 => 
            array (
                'id' => 55,
                'name' => 'kotaPerencanaanKinerja',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:52:12',
                'updated_at' => '2022-07-07 14:52:12',
            ),
            51 => 
            array (
                'id' => 56,
                'name' => 'opdPerencanaanKinerja',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:52:12',
                'updated_at' => '2022-07-07 14:52:12',
            ),
            52 => 
            array (
                'id' => 57,
                'name' => 'perencanaanKinerja',
                'guard_name' => 'web',
                'created_at' => '2022-07-07 14:52:32',
                'updated_at' => '2022-07-07 14:52:32',
            ),
            53 => 
            array (
                'id' => 58,
                'name' => 'kotaRpjmd-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:04:35',
                'updated_at' => '2022-07-08 10:04:35',
            ),
            54 => 
            array (
                'id' => 59,
                'name' => 'kotaRpjmd-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:04:35',
                'updated_at' => '2022-07-08 10:04:35',
            ),
            55 => 
            array (
                'id' => 60,
                'name' => 'kotaRpjmd-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:04:35',
                'updated_at' => '2022-07-08 10:04:35',
            ),
            56 => 
            array (
                'id' => 61,
                'name' => 'kotaRpjmd-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:04:35',
                'updated_at' => '2022-07-08 10:04:35',
            ),
            57 => 
            array (
                'id' => 62,
                'name' => 'kotaCascadingKinerja-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:07:39',
                'updated_at' => '2022-07-08 10:07:39',
            ),
            58 => 
            array (
                'id' => 63,
                'name' => 'kotaCascadingKinerja-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:07:39',
                'updated_at' => '2022-07-08 10:07:39',
            ),
            59 => 
            array (
                'id' => 64,
                'name' => 'kotaCascadingKinerja-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:07:39',
                'updated_at' => '2022-07-08 10:07:39',
            ),
            60 => 
            array (
                'id' => 65,
                'name' => 'kotaCascadingKinerja-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:07:39',
                'updated_at' => '2022-07-08 10:07:39',
            ),
            61 => 
            array (
                'id' => 66,
                'name' => 'kotaRkpd-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:09:53',
                'updated_at' => '2022-07-08 10:09:53',
            ),
            62 => 
            array (
                'id' => 67,
                'name' => 'kotaRkpd-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:09:53',
                'updated_at' => '2022-07-08 10:09:53',
            ),
            63 => 
            array (
                'id' => 68,
                'name' => 'kotaRkpd-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:09:53',
                'updated_at' => '2022-07-08 10:09:53',
            ),
            64 => 
            array (
                'id' => 69,
                'name' => 'kotaRkpd-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:09:53',
                'updated_at' => '2022-07-08 10:09:53',
            ),
            65 => 
            array (
                'id' => 70,
                'name' => 'opdPeriodRenstra-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:15:46',
                'updated_at' => '2022-07-08 10:15:46',
            ),
            66 => 
            array (
                'id' => 71,
                'name' => 'opdPeriodRenstra-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:15:46',
                'updated_at' => '2022-07-08 10:15:46',
            ),
            67 => 
            array (
                'id' => 72,
                'name' => 'opdPeriodRenstra-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:15:46',
                'updated_at' => '2022-07-08 10:15:46',
            ),
            68 => 
            array (
                'id' => 73,
                'name' => 'opdPeriodRenstra-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:15:46',
                'updated_at' => '2022-07-08 10:15:46',
            ),
            69 => 
            array (
                'id' => 74,
                'name' => 'opdRkt-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:15:46',
                'updated_at' => '2022-07-08 10:15:46',
            ),
            70 => 
            array (
                'id' => 75,
                'name' => 'opdRkt-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:15:46',
                'updated_at' => '2022-07-08 10:15:46',
            ),
            71 => 
            array (
                'id' => 76,
                'name' => 'opdRkt-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:15:46',
                'updated_at' => '2022-07-08 10:15:46',
            ),
            72 => 
            array (
                'id' => 77,
                'name' => 'opdRkt-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:15:46',
                'updated_at' => '2022-07-08 10:15:46',
            ),
            73 => 
            array (
                'id' => 78,
                'name' => 'opdRenja-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:15:46',
                'updated_at' => '2022-07-08 10:15:46',
            ),
            74 => 
            array (
                'id' => 79,
                'name' => 'opdRenja-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:15:47',
                'updated_at' => '2022-07-08 10:15:47',
            ),
            75 => 
            array (
                'id' => 80,
                'name' => 'opdRenja-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:15:47',
                'updated_at' => '2022-07-08 10:15:47',
            ),
            76 => 
            array (
                'id' => 81,
                'name' => 'opdRenja-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:15:47',
                'updated_at' => '2022-07-08 10:15:47',
            ),
            77 => 
            array (
                'id' => 82,
                'name' => 'opdCascadingKinerja-list',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:15:47',
                'updated_at' => '2022-07-08 10:15:47',
            ),
            78 => 
            array (
                'id' => 83,
                'name' => 'opdCascadingKinerja-create',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:15:47',
                'updated_at' => '2022-07-08 10:15:47',
            ),
            79 => 
            array (
                'id' => 84,
                'name' => 'opdCascadingKinerja-edit',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:15:47',
                'updated_at' => '2022-07-08 10:15:47',
            ),
            80 => 
            array (
                'id' => 85,
                'name' => 'opdCascadingKinerja-delete',
                'guard_name' => 'web',
                'created_at' => '2022-07-08 10:15:47',
                'updated_at' => '2022-07-08 10:15:47',
            ),
        ));
        
        
    }
}