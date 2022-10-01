<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 1,
            ),
            1 => 
            array (
                'permission_id' => 2,
                'role_id' => 1,
            ),
            2 => 
            array (
                'permission_id' => 3,
                'role_id' => 1,
            ),
            3 => 
            array (
                'permission_id' => 4,
                'role_id' => 1,
            ),
            4 => 
            array (
                'permission_id' => 5,
                'role_id' => 1,
            ),
            5 => 
            array (
                'permission_id' => 5,
                'role_id' => 3,
            ),
            6 => 
            array (
                'permission_id' => 6,
                'role_id' => 1,
            ),
            7 => 
            array (
                'permission_id' => 6,
                'role_id' => 3,
            ),
            8 => 
            array (
                'permission_id' => 7,
                'role_id' => 1,
            ),
            9 => 
            array (
                'permission_id' => 7,
                'role_id' => 3,
            ),
            10 => 
            array (
                'permission_id' => 8,
                'role_id' => 1,
            ),
            11 => 
            array (
                'permission_id' => 8,
                'role_id' => 3,
            ),
            12 => 
            array (
                'permission_id' => 13,
                'role_id' => 1,
            ),
            13 => 
            array (
                'permission_id' => 13,
                'role_id' => 2,
            ),
            14 => 
            array (
                'permission_id' => 13,
                'role_id' => 3,
            ),
            15 => 
            array (
                'permission_id' => 13,
                'role_id' => 4,
            ),
            16 => 
            array (
                'permission_id' => 14,
                'role_id' => 1,
            ),
            17 => 
            array (
                'permission_id' => 14,
                'role_id' => 2,
            ),
            18 => 
            array (
                'permission_id' => 14,
                'role_id' => 3,
            ),
            19 => 
            array (
                'permission_id' => 14,
                'role_id' => 4,
            ),
            20 => 
            array (
                'permission_id' => 15,
                'role_id' => 1,
            ),
            21 => 
            array (
                'permission_id' => 15,
                'role_id' => 2,
            ),
            22 => 
            array (
                'permission_id' => 15,
                'role_id' => 3,
            ),
            23 => 
            array (
                'permission_id' => 15,
                'role_id' => 4,
            ),
            24 => 
            array (
                'permission_id' => 16,
                'role_id' => 1,
            ),
            25 => 
            array (
                'permission_id' => 16,
                'role_id' => 2,
            ),
            26 => 
            array (
                'permission_id' => 16,
                'role_id' => 3,
            ),
            27 => 
            array (
                'permission_id' => 16,
                'role_id' => 4,
            ),
            28 => 
            array (
                'permission_id' => 17,
                'role_id' => 1,
            ),
            29 => 
            array (
                'permission_id' => 18,
                'role_id' => 1,
            ),
            30 => 
            array (
                'permission_id' => 19,
                'role_id' => 1,
            ),
            31 => 
            array (
                'permission_id' => 20,
                'role_id' => 1,
            ),
            32 => 
            array (
                'permission_id' => 21,
                'role_id' => 1,
            ),
            33 => 
            array (
                'permission_id' => 21,
                'role_id' => 2,
            ),
            34 => 
            array (
                'permission_id' => 21,
                'role_id' => 3,
            ),
            35 => 
            array (
                'permission_id' => 22,
                'role_id' => 1,
            ),
            36 => 
            array (
                'permission_id' => 22,
                'role_id' => 2,
            ),
            37 => 
            array (
                'permission_id' => 22,
                'role_id' => 3,
            ),
            38 => 
            array (
                'permission_id' => 23,
                'role_id' => 1,
            ),
            39 => 
            array (
                'permission_id' => 23,
                'role_id' => 2,
            ),
            40 => 
            array (
                'permission_id' => 23,
                'role_id' => 3,
            ),
            41 => 
            array (
                'permission_id' => 24,
                'role_id' => 1,
            ),
            42 => 
            array (
                'permission_id' => 24,
                'role_id' => 2,
            ),
            43 => 
            array (
                'permission_id' => 24,
                'role_id' => 3,
            ),
            44 => 
            array (
                'permission_id' => 25,
                'role_id' => 1,
            ),
            45 => 
            array (
                'permission_id' => 25,
                'role_id' => 2,
            ),
            46 => 
            array (
                'permission_id' => 25,
                'role_id' => 3,
            ),
            47 => 
            array (
                'permission_id' => 26,
                'role_id' => 1,
            ),
            48 => 
            array (
                'permission_id' => 26,
                'role_id' => 2,
            ),
            49 => 
            array (
                'permission_id' => 26,
                'role_id' => 3,
            ),
            50 => 
            array (
                'permission_id' => 27,
                'role_id' => 1,
            ),
            51 => 
            array (
                'permission_id' => 27,
                'role_id' => 2,
            ),
            52 => 
            array (
                'permission_id' => 27,
                'role_id' => 3,
            ),
            53 => 
            array (
                'permission_id' => 28,
                'role_id' => 1,
            ),
            54 => 
            array (
                'permission_id' => 28,
                'role_id' => 2,
            ),
            55 => 
            array (
                'permission_id' => 28,
                'role_id' => 3,
            ),
            56 => 
            array (
                'permission_id' => 29,
                'role_id' => 1,
            ),
            57 => 
            array (
                'permission_id' => 29,
                'role_id' => 2,
            ),
            58 => 
            array (
                'permission_id' => 29,
                'role_id' => 3,
            ),
            59 => 
            array (
                'permission_id' => 30,
                'role_id' => 1,
            ),
            60 => 
            array (
                'permission_id' => 30,
                'role_id' => 2,
            ),
            61 => 
            array (
                'permission_id' => 30,
                'role_id' => 3,
            ),
            62 => 
            array (
                'permission_id' => 31,
                'role_id' => 1,
            ),
            63 => 
            array (
                'permission_id' => 31,
                'role_id' => 2,
            ),
            64 => 
            array (
                'permission_id' => 31,
                'role_id' => 3,
            ),
            65 => 
            array (
                'permission_id' => 32,
                'role_id' => 1,
            ),
            66 => 
            array (
                'permission_id' => 32,
                'role_id' => 2,
            ),
            67 => 
            array (
                'permission_id' => 32,
                'role_id' => 3,
            ),
            68 => 
            array (
                'permission_id' => 33,
                'role_id' => 1,
            ),
            69 => 
            array (
                'permission_id' => 33,
                'role_id' => 2,
            ),
            70 => 
            array (
                'permission_id' => 33,
                'role_id' => 3,
            ),
            71 => 
            array (
                'permission_id' => 34,
                'role_id' => 1,
            ),
            72 => 
            array (
                'permission_id' => 34,
                'role_id' => 2,
            ),
            73 => 
            array (
                'permission_id' => 34,
                'role_id' => 3,
            ),
            74 => 
            array (
                'permission_id' => 35,
                'role_id' => 1,
            ),
            75 => 
            array (
                'permission_id' => 35,
                'role_id' => 2,
            ),
            76 => 
            array (
                'permission_id' => 35,
                'role_id' => 3,
            ),
            77 => 
            array (
                'permission_id' => 36,
                'role_id' => 1,
            ),
            78 => 
            array (
                'permission_id' => 36,
                'role_id' => 2,
            ),
            79 => 
            array (
                'permission_id' => 36,
                'role_id' => 3,
            ),
            80 => 
            array (
                'permission_id' => 37,
                'role_id' => 1,
            ),
            81 => 
            array (
                'permission_id' => 37,
                'role_id' => 2,
            ),
            82 => 
            array (
                'permission_id' => 37,
                'role_id' => 3,
            ),
            83 => 
            array (
                'permission_id' => 38,
                'role_id' => 1,
            ),
            84 => 
            array (
                'permission_id' => 38,
                'role_id' => 2,
            ),
            85 => 
            array (
                'permission_id' => 38,
                'role_id' => 3,
            ),
            86 => 
            array (
                'permission_id' => 39,
                'role_id' => 1,
            ),
            87 => 
            array (
                'permission_id' => 39,
                'role_id' => 2,
            ),
            88 => 
            array (
                'permission_id' => 39,
                'role_id' => 3,
            ),
            89 => 
            array (
                'permission_id' => 40,
                'role_id' => 1,
            ),
            90 => 
            array (
                'permission_id' => 40,
                'role_id' => 2,
            ),
            91 => 
            array (
                'permission_id' => 40,
                'role_id' => 3,
            ),
            92 => 
            array (
                'permission_id' => 41,
                'role_id' => 1,
            ),
            93 => 
            array (
                'permission_id' => 41,
                'role_id' => 2,
            ),
            94 => 
            array (
                'permission_id' => 41,
                'role_id' => 3,
            ),
            95 => 
            array (
                'permission_id' => 42,
                'role_id' => 1,
            ),
            96 => 
            array (
                'permission_id' => 42,
                'role_id' => 2,
            ),
            97 => 
            array (
                'permission_id' => 42,
                'role_id' => 3,
            ),
            98 => 
            array (
                'permission_id' => 43,
                'role_id' => 1,
            ),
            99 => 
            array (
                'permission_id' => 43,
                'role_id' => 2,
            ),
            100 => 
            array (
                'permission_id' => 43,
                'role_id' => 3,
            ),
            101 => 
            array (
                'permission_id' => 44,
                'role_id' => 1,
            ),
            102 => 
            array (
                'permission_id' => 44,
                'role_id' => 2,
            ),
            103 => 
            array (
                'permission_id' => 44,
                'role_id' => 3,
            ),
            104 => 
            array (
                'permission_id' => 45,
                'role_id' => 1,
            ),
            105 => 
            array (
                'permission_id' => 45,
                'role_id' => 2,
            ),
            106 => 
            array (
                'permission_id' => 45,
                'role_id' => 3,
            ),
            107 => 
            array (
                'permission_id' => 46,
                'role_id' => 1,
            ),
            108 => 
            array (
                'permission_id' => 46,
                'role_id' => 2,
            ),
            109 => 
            array (
                'permission_id' => 46,
                'role_id' => 3,
            ),
            110 => 
            array (
                'permission_id' => 47,
                'role_id' => 1,
            ),
            111 => 
            array (
                'permission_id' => 47,
                'role_id' => 2,
            ),
            112 => 
            array (
                'permission_id' => 47,
                'role_id' => 3,
            ),
            113 => 
            array (
                'permission_id' => 48,
                'role_id' => 1,
            ),
            114 => 
            array (
                'permission_id' => 48,
                'role_id' => 2,
            ),
            115 => 
            array (
                'permission_id' => 48,
                'role_id' => 3,
            ),
            116 => 
            array (
                'permission_id' => 49,
                'role_id' => 1,
            ),
            117 => 
            array (
                'permission_id' => 49,
                'role_id' => 2,
            ),
            118 => 
            array (
                'permission_id' => 49,
                'role_id' => 3,
            ),
            119 => 
            array (
                'permission_id' => 50,
                'role_id' => 1,
            ),
            120 => 
            array (
                'permission_id' => 50,
                'role_id' => 2,
            ),
            121 => 
            array (
                'permission_id' => 50,
                'role_id' => 3,
            ),
            122 => 
            array (
                'permission_id' => 51,
                'role_id' => 1,
            ),
            123 => 
            array (
                'permission_id' => 51,
                'role_id' => 2,
            ),
            124 => 
            array (
                'permission_id' => 51,
                'role_id' => 3,
            ),
            125 => 
            array (
                'permission_id' => 52,
                'role_id' => 1,
            ),
            126 => 
            array (
                'permission_id' => 52,
                'role_id' => 2,
            ),
            127 => 
            array (
                'permission_id' => 52,
                'role_id' => 3,
            ),
            128 => 
            array (
                'permission_id' => 53,
                'role_id' => 1,
            ),
            129 => 
            array (
                'permission_id' => 53,
                'role_id' => 2,
            ),
            130 => 
            array (
                'permission_id' => 53,
                'role_id' => 3,
            ),
            131 => 
            array (
                'permission_id' => 54,
                'role_id' => 1,
            ),
            132 => 
            array (
                'permission_id' => 54,
                'role_id' => 2,
            ),
            133 => 
            array (
                'permission_id' => 54,
                'role_id' => 3,
            ),
            134 => 
            array (
                'permission_id' => 55,
                'role_id' => 1,
            ),
            135 => 
            array (
                'permission_id' => 55,
                'role_id' => 2,
            ),
            136 => 
            array (
                'permission_id' => 55,
                'role_id' => 3,
            ),
            137 => 
            array (
                'permission_id' => 56,
                'role_id' => 1,
            ),
            138 => 
            array (
                'permission_id' => 56,
                'role_id' => 2,
            ),
            139 => 
            array (
                'permission_id' => 56,
                'role_id' => 3,
            ),
            140 => 
            array (
                'permission_id' => 57,
                'role_id' => 1,
            ),
            141 => 
            array (
                'permission_id' => 57,
                'role_id' => 2,
            ),
            142 => 
            array (
                'permission_id' => 57,
                'role_id' => 3,
            ),
            143 => 
            array (
                'permission_id' => 58,
                'role_id' => 1,
            ),
            144 => 
            array (
                'permission_id' => 58,
                'role_id' => 2,
            ),
            145 => 
            array (
                'permission_id' => 58,
                'role_id' => 3,
            ),
            146 => 
            array (
                'permission_id' => 59,
                'role_id' => 1,
            ),
            147 => 
            array (
                'permission_id' => 59,
                'role_id' => 2,
            ),
            148 => 
            array (
                'permission_id' => 59,
                'role_id' => 3,
            ),
            149 => 
            array (
                'permission_id' => 60,
                'role_id' => 1,
            ),
            150 => 
            array (
                'permission_id' => 60,
                'role_id' => 2,
            ),
            151 => 
            array (
                'permission_id' => 60,
                'role_id' => 3,
            ),
            152 => 
            array (
                'permission_id' => 61,
                'role_id' => 1,
            ),
            153 => 
            array (
                'permission_id' => 61,
                'role_id' => 2,
            ),
            154 => 
            array (
                'permission_id' => 61,
                'role_id' => 3,
            ),
            155 => 
            array (
                'permission_id' => 62,
                'role_id' => 1,
            ),
            156 => 
            array (
                'permission_id' => 62,
                'role_id' => 2,
            ),
            157 => 
            array (
                'permission_id' => 62,
                'role_id' => 3,
            ),
            158 => 
            array (
                'permission_id' => 63,
                'role_id' => 1,
            ),
            159 => 
            array (
                'permission_id' => 63,
                'role_id' => 2,
            ),
            160 => 
            array (
                'permission_id' => 63,
                'role_id' => 3,
            ),
            161 => 
            array (
                'permission_id' => 64,
                'role_id' => 1,
            ),
            162 => 
            array (
                'permission_id' => 64,
                'role_id' => 2,
            ),
            163 => 
            array (
                'permission_id' => 64,
                'role_id' => 3,
            ),
            164 => 
            array (
                'permission_id' => 65,
                'role_id' => 1,
            ),
            165 => 
            array (
                'permission_id' => 65,
                'role_id' => 2,
            ),
            166 => 
            array (
                'permission_id' => 65,
                'role_id' => 3,
            ),
            167 => 
            array (
                'permission_id' => 66,
                'role_id' => 1,
            ),
            168 => 
            array (
                'permission_id' => 66,
                'role_id' => 2,
            ),
            169 => 
            array (
                'permission_id' => 66,
                'role_id' => 3,
            ),
            170 => 
            array (
                'permission_id' => 67,
                'role_id' => 1,
            ),
            171 => 
            array (
                'permission_id' => 67,
                'role_id' => 2,
            ),
            172 => 
            array (
                'permission_id' => 67,
                'role_id' => 3,
            ),
            173 => 
            array (
                'permission_id' => 68,
                'role_id' => 1,
            ),
            174 => 
            array (
                'permission_id' => 68,
                'role_id' => 2,
            ),
            175 => 
            array (
                'permission_id' => 68,
                'role_id' => 3,
            ),
            176 => 
            array (
                'permission_id' => 69,
                'role_id' => 1,
            ),
            177 => 
            array (
                'permission_id' => 69,
                'role_id' => 2,
            ),
            178 => 
            array (
                'permission_id' => 69,
                'role_id' => 3,
            ),
            179 => 
            array (
                'permission_id' => 70,
                'role_id' => 1,
            ),
            180 => 
            array (
                'permission_id' => 70,
                'role_id' => 2,
            ),
            181 => 
            array (
                'permission_id' => 70,
                'role_id' => 3,
            ),
            182 => 
            array (
                'permission_id' => 71,
                'role_id' => 1,
            ),
            183 => 
            array (
                'permission_id' => 71,
                'role_id' => 2,
            ),
            184 => 
            array (
                'permission_id' => 71,
                'role_id' => 3,
            ),
            185 => 
            array (
                'permission_id' => 72,
                'role_id' => 1,
            ),
            186 => 
            array (
                'permission_id' => 72,
                'role_id' => 2,
            ),
            187 => 
            array (
                'permission_id' => 72,
                'role_id' => 3,
            ),
            188 => 
            array (
                'permission_id' => 73,
                'role_id' => 1,
            ),
            189 => 
            array (
                'permission_id' => 73,
                'role_id' => 2,
            ),
            190 => 
            array (
                'permission_id' => 73,
                'role_id' => 3,
            ),
            191 => 
            array (
                'permission_id' => 74,
                'role_id' => 1,
            ),
            192 => 
            array (
                'permission_id' => 74,
                'role_id' => 2,
            ),
            193 => 
            array (
                'permission_id' => 74,
                'role_id' => 3,
            ),
            194 => 
            array (
                'permission_id' => 75,
                'role_id' => 1,
            ),
            195 => 
            array (
                'permission_id' => 75,
                'role_id' => 2,
            ),
            196 => 
            array (
                'permission_id' => 75,
                'role_id' => 3,
            ),
            197 => 
            array (
                'permission_id' => 76,
                'role_id' => 1,
            ),
            198 => 
            array (
                'permission_id' => 76,
                'role_id' => 2,
            ),
            199 => 
            array (
                'permission_id' => 76,
                'role_id' => 3,
            ),
            200 => 
            array (
                'permission_id' => 77,
                'role_id' => 1,
            ),
            201 => 
            array (
                'permission_id' => 77,
                'role_id' => 2,
            ),
            202 => 
            array (
                'permission_id' => 77,
                'role_id' => 3,
            ),
            203 => 
            array (
                'permission_id' => 78,
                'role_id' => 1,
            ),
            204 => 
            array (
                'permission_id' => 78,
                'role_id' => 2,
            ),
            205 => 
            array (
                'permission_id' => 78,
                'role_id' => 3,
            ),
            206 => 
            array (
                'permission_id' => 79,
                'role_id' => 1,
            ),
            207 => 
            array (
                'permission_id' => 79,
                'role_id' => 2,
            ),
            208 => 
            array (
                'permission_id' => 79,
                'role_id' => 3,
            ),
            209 => 
            array (
                'permission_id' => 80,
                'role_id' => 1,
            ),
            210 => 
            array (
                'permission_id' => 80,
                'role_id' => 2,
            ),
            211 => 
            array (
                'permission_id' => 80,
                'role_id' => 3,
            ),
            212 => 
            array (
                'permission_id' => 81,
                'role_id' => 1,
            ),
            213 => 
            array (
                'permission_id' => 81,
                'role_id' => 2,
            ),
            214 => 
            array (
                'permission_id' => 81,
                'role_id' => 3,
            ),
            215 => 
            array (
                'permission_id' => 82,
                'role_id' => 1,
            ),
            216 => 
            array (
                'permission_id' => 82,
                'role_id' => 2,
            ),
            217 => 
            array (
                'permission_id' => 82,
                'role_id' => 3,
            ),
            218 => 
            array (
                'permission_id' => 83,
                'role_id' => 1,
            ),
            219 => 
            array (
                'permission_id' => 83,
                'role_id' => 2,
            ),
            220 => 
            array (
                'permission_id' => 83,
                'role_id' => 3,
            ),
            221 => 
            array (
                'permission_id' => 84,
                'role_id' => 1,
            ),
            222 => 
            array (
                'permission_id' => 84,
                'role_id' => 2,
            ),
            223 => 
            array (
                'permission_id' => 84,
                'role_id' => 3,
            ),
            224 => 
            array (
                'permission_id' => 85,
                'role_id' => 1,
            ),
            225 => 
            array (
                'permission_id' => 85,
                'role_id' => 2,
            ),
            226 => 
            array (
                'permission_id' => 85,
                'role_id' => 3,
            ),
            227 => 
            array (
                'permission_id' => 86,
                'role_id' => 1,
            ),
            228 => 
            array (
                'permission_id' => 86,
                'role_id' => 3,
            ),
            229 => 
            array (
                'permission_id' => 87,
                'role_id' => 1,
            ),
            230 => 
            array (
                'permission_id' => 87,
                'role_id' => 3,
            ),
            231 => 
            array (
                'permission_id' => 88,
                'role_id' => 1,
            ),
            232 => 
            array (
                'permission_id' => 88,
                'role_id' => 3,
            ),
            233 => 
            array (
                'permission_id' => 89,
                'role_id' => 1,
            ),
            234 => 
            array (
                'permission_id' => 89,
                'role_id' => 3,
            ),
            235 => 
            array (
                'permission_id' => 90,
                'role_id' => 1,
            ),
            236 => 
            array (
                'permission_id' => 90,
                'role_id' => 2,
            ),
            237 => 
            array (
                'permission_id' => 90,
                'role_id' => 3,
            ),
            238 => 
            array (
                'permission_id' => 91,
                'role_id' => 1,
            ),
            239 => 
            array (
                'permission_id' => 91,
                'role_id' => 4,
            ),
            240 => 
            array (
                'permission_id' => 92,
                'role_id' => 1,
            ),
            241 => 
            array (
                'permission_id' => 92,
                'role_id' => 4,
            ),
            242 => 
            array (
                'permission_id' => 93,
                'role_id' => 1,
            ),
            243 => 
            array (
                'permission_id' => 93,
                'role_id' => 4,
            ),
        ));
        
        
    }
}