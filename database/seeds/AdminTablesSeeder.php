<?php


use App\Models\Administrator;
use Encore\Admin\Auth\Database\Menu;
use Encore\Admin\Auth\Database\Permission;
use Encore\Admin\Auth\Database\Role;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

/**
 * Created by xuchengliang
 * Date: 2024/3/9 19:24
 */
class AdminTablesSeeder extends \Illuminate\Database\Seeder
{

    public function run()
    {
        // create a user.
        Administrator::truncate();
        $uuid = \Ramsey\Uuid\Uuid::uuid1();
        Administrator::create([
            'id' => $uuid->toString(),
            'username' => 'admin',
            'password' => Hash::make('admin'),
            'name'     => 'Administrator',
        ]);

        // create a role.
        Role::truncate();
        Role::create([
            'name' => '管理员',
            'slug' => 'administrator',
        ]);
        $teacher = Role::create([
            'name' => '教师',
            'slug' => 'teacher',
        ]);

        // add role to user.
        Administrator::first()->roles()->save(Role::first());

        //create a permission
        Permission::truncate();
        Permission::insert([
            [
                'name'        => 'All permission',
                'slug'        => '*',
                'http_method' => '',
                'http_path'   => '*',
            ],
            [
                'name'        => 'Dashboard',
                'slug'        => 'dashboard',
                'http_method' => 'GET',
                'http_path'   => '/',
            ],
            [
                'name'        => 'Login',
                'slug'        => 'auth.login',
                'http_method' => '',
                'http_path'   => "/auth/login\r\n/auth/logout",
            ],
            [
                'name'        => 'User setting',
                'slug'        => 'auth.setting',
                'http_method' => 'GET,PUT',
                'http_path'   => '/auth/setting',
            ],
            [
                'name'        => 'Auth management',
                'slug'        => 'auth.management',
                'http_method' => '',
                'http_path'   => "/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs",
            ],
            [
                'name'        => 'student management',
                'slug'        => 'student.management',
                'http_method' => '',
                'http_path'   => "/students",
            ],
        ]);

        $teacher->permissions()->save(Permission::find(2));
        $teacher->permissions()->save(Permission::find(3));
        $teacher->permissions()->save(Permission::find(6));

        // add default menus.
        Menu::truncate();
        Menu::insert([
            [
                'parent_id' => 0,
                'order'     => 1,
                'title'     => 'Dashboard',
                'icon'      => 'fa-bar-chart',
                'uri'       => '/',
            ],
            [
                'parent_id' => 0,
                'order'     => 2,
                'title'     => 'Admin',
                'icon'      => 'fa-tasks',
                'uri'       => '',
            ],
            [
                'parent_id' => 2,
                'order'     => 3,
                'title'     => 'Users',
                'icon'      => 'fa-users',
                'uri'       => 'auth/users',
            ],
            [
                'parent_id' => 2,
                'order'     => 4,
                'title'     => 'Roles',
                'icon'      => 'fa-user',
                'uri'       => 'auth/roles',
            ],
            [
                'parent_id' => 2,
                'order'     => 5,
                'title'     => 'Permission',
                'icon'      => 'fa-ban',
                'uri'       => 'auth/permissions',
            ],
            [
                'parent_id' => 2,
                'order'     => 6,
                'title'     => 'Menu',
                'icon'      => 'fa-bars',
                'uri'       => 'auth/menu',
            ],
            [
                'parent_id' => 2,
                'order'     => 7,
                'title'     => 'Operation log',
                'icon'      => 'fa-history',
                'uri'       => 'auth/logs',
            ],
            [
                'parent_id' => 0,
                'order' => 3,
                'title' => '教师管理',
                'icon' => 'fa-users',
                'uri' => 'teachers',
            ],
            [
                'parent_id' => 0,
                'order' => 4,
                'title' => '学生管理',
                'icon' => 'fa-graduation-cap',
                'uri' => 'students',
            ]
        ]);

        // add role to menu.
        Menu::find(2)->roles()->save(Role::first());
        Menu::query()->where(['uri'=>'students'])->first()->roles()->save(Role::where(['slug'=>'teacher'])->first());
    }

}