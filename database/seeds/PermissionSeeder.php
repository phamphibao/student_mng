<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // permission students
        DB::table('permission')->insert([
            'id'   => 1,
            'name' => 'Sinh viên',
            'detail' => 'danh mục sinh viên',
            'key' => 'student',
            'id_parent' => 0,
        ]);

        DB::table('permission')->insert([
            'id'   => 2,
            'name' => 'Xem sinh viên',
            'detail' => 'Xem danh sách sinh viên',
            'key' => 'view-student',
            'id_parent' => 1,
        ]);

        DB::table('permission')->insert([
            'id'   => 3,
            'name' => 'Thêm sinh viên',
            'detail' => 'Thêm sinh viên mới',
            'key' => 'add-student',
            'id_parent' => 1,
        ]);

        DB::table('permission')->insert([
            'id'   => 4,
            'name' => 'Chỉnh sửa sinh viên',
            'detail' => 'Chỉnh sửa cập nhật thông tin sinh viên',
            'key' => 'edit-student',
            'id_parent' => 1,
        ]);

        DB::table('permission')->insert([
            'id'   => 5,
            'name' => 'Xóa sinh viên',
            'detail' => 'Xóa một sinh viên',
            'key' => 'delete-student',
            'id_parent' => 1,
        ]);

        // permission class
        DB::table('permission')->insert([
            'id'   => 6,
            'name' => 'Lớp học',
            'detail' => 'Danh mục lớp học',
            'key' => 'class',
            'id_parent' => 0
        ]);

        DB::table('permission')->insert([
            'id'   => 7,
            'name' => 'Xem danh sách lớp học',
            'detail' => 'Xem danh sách lớp học',
            'key' => 'view-class',
            'id_parent' => 6
        ]);

        DB::table('permission')->insert([
            'id'   => 8,
            'name' => 'Thêm lớp',
            'detail' => 'Thêm lớp mới',
            'key' => 'add-class',
            'id_parent' => 6
        ]);

        DB::table('permission')->insert([
            'id'   => 9,
            'name' => 'Chỉnh sửa lớp',
            'detail' => 'Chỉnh sửa, cập nhật thông tin lớp học',
            'key' => 'edit-class',
            'id_parent' => 6
        ]);

        DB::table('permission')->insert([
            'id'   => 10,
            'name' => 'Xóa lớp',
            'detail' => 'Xóa lớp học',
            'key' => 'delete-class',
            'id_parent' => 6
        ]);

        // permission teacher

        DB::table('permission')->insert([
            'id'   => 11,
            'name' => 'Giáo viên',
            'detail' => 'Danh mục giáo viên',
            'key' => 'teacher',
            'id_parent' => 0

        ]); 

        DB::table('permission')->insert([
            'id'   => 12,
            'name' => 'Xem danh sách giáo viên',
            'detail' => 'Xem danh sách của giáo viên',
            'key' => 'view-teacher',
            'id_parent' => 11

        ]); 

        DB::table('permission')->insert([
            'id'   => 13,
            'name' => 'Thêm giáo viên',
            'detail' => 'Thêm giáo viên mới',
            'key' => 'add-teacher',
            'id_parent' => 11

        ]);

        DB::table('permission')->insert([
            'id'   => 14,
            'name' => 'Chỉnh sửa giáo viên',
            'detail' => 'Chỉnh sửa cập nhật thông tin giáo viên',
            'key' => 'edit-teacher',
            'id_parent' => 11
        ]);

        DB::table('permission')->insert([
            'id'   => 15,
            'name' => 'Xóa giáo viên',
            'detail' => 'Xóa một giáo viên',
            'key' => 'delete-teacher',
            'id_parent' => 11
        ]);

        // permission faculty
        DB::table('permission')->insert([
            'id'   => 16,
            'name' => 'Khoa',
            'detail' => 'Danh mục khoa',
            'key' => 'faculty',
            'id_parent' => 0

        ]);


        DB::table('permission')->insert([
            'id'   => 17,
            'name' => 'Xem thông tin của khoa',
            'detail' => 'Xem danh sách thông tin khoa',
            'key' => 'view-faculty',
            'id_parent' => 16

        ]);

        DB::table('permission')->insert([
            'id'   => 18,
            'name' => 'Thêm khoa mới',
            'detail' => 'Thêm một khoa mới',
            'key' => 'add-faculty',
            'id_parent' => 16

        ]);
        
        DB::table('permission')->insert([
            'id'   => 19,
            'name' => 'Chỉnh sửa khoa',
            'detail' => 'Chỉnh sửa thông tin và cập nhật khoa',
            'key' => 'edit-faculty',
            'id_parent' => 16

        ]);

        DB::table('permission')->insert([
            'id'   => 20,
            'name' => 'Xóa khoa',
            'detail' => 'Xóa một khoa',
            'key' => 'delete-faculty',
            'id_parent' => 16
        ]);

        DB::table('permission')->insert([
            'id'   => 21,
            'name' => 'admin',
            'detail' => 'admin',
            'key' => 'isAdmin',
            'id_parent' => 2
        ]);

     

        for ($i=1; $i <=21 ; $i++) { 
            DB::table('roles_permission')->insert([
                'id'   => $i,
                'roles_id' => 1,
                'permission_id' => $i,
            ]);
        }
            
    }
}
