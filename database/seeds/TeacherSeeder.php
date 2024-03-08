<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

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
        DB::table('teachers')->insert([
            'id' => $uuid->toString(),
            'name' => '张老师',
            'username' => 'zhanglaoshi',
            'password' => Hash::make('poper'),
        ]);
    }
}
