<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('roles')->insert([
            'name' => 'admin',
            'detail' => 'Quản lý tất cả công việc',
        ]);

          
        DB::table('roles')->insert([
            'name' => 'Sinh viên',
            'detail' => 'Học sinh tại trường',
        ]);

        DB::table('roles')->insert([
            'name' => 'Giáo viên',
            'detail' => 'Giáo viên giảng dạy tại trường',
        ]);
    }
}
