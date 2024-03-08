<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_menu')->insert([
            [
                'parent_id' => 0,
                'order' => 3,
                'title' => '教师管理',
                'icon' => 'fa-users',
                'uri' => 'teachers',
                'permission' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'parent_id' => 0,
                'order' => 4,
                'title' => '学生管理',
                'icon' => 'fa-graduation-cap',
                'uri' => 'students',
                'permission' => '',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
