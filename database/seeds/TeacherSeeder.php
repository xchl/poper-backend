<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uuid = Uuid::uuid1();
        $teacher = \App\Models\Teacher::create([
            'id' => $uuid->toString(),
            'name' => '张老师',
            'username' => 'zhanglaoshi',
            'password' => Hash::make('poper'),
        ]);
        $teacher->roles()->save(\Encore\Admin\Auth\Database\Role::where('slug', 'teacher')->first());
    }
}
