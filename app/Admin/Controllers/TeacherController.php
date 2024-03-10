<?php

namespace App\Admin\Controllers;

use App\Models\Teacher;
use Encore\Admin\Auth\Database\Role;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Ramsey\Uuid\Uuid;

class TeacherController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Teacher';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Teacher());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('username', __('Username'));
//        $grid->column('password', __('Password'));
//        $grid->column('created_at', __('Created at'));
//        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Teacher::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('username', __('Username'));
//        $show->field('password', __('Password'));
//        $show->field('created_at', __('Created at'));
//        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Teacher());

        $form->text('name', __('Name'));
        $form->text('username', __('Username'));
        $form->password('password', __('Password'));

        return $form;
    }

    public function store()
    {
        $form = $this->form();
        $form->model()->id = Uuid::uuid1()->toString();
        $form->saved(function (Form $form) {
            $form->model()->roles()->save(Role::where('slug', 'teacher')->first());
        });
        $form->store();
    }
}
