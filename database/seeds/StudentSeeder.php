<?php

use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $uuid = Uuid::uuid1();
        DB::table('students')->insert([
            'id' => $uuid->toString(),
            'name' => '王同学',
            'username' => 'wangtongxue',
            'password' => Hash::make('poper'),
        ]);
        $uuid = Uuid::uuid1();
        DB::table('students')->insert([
            'id' => $uuid->toString(),
            'name' => '李同学',
            'username' => 'litongxue',
            'password' => Hash::make('poper'),
        ]);
    }
}
