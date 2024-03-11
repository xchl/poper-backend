<?php

namespace App\Admin\Controllers;

use App\Models\Student;
use Encore\Admin\Auth\Database\Role;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Ramsey\Uuid\Uuid;

class StudentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Student';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Student());

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
        $show = new Show(Student::findOrFail($id));

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
        $form = new Form(new Student());

        $form->text('name')->rules('required|min:3|max:10');
        $form->text('username')->rules('required|alpha_num:mim3|max:10|unique:students,username');
        $form->text('password')->rules('required|alpha_num|min:3|max:10');

        return $form;
    }

    public function store()
    {
        $form = $this->form();
        $form->model()->id = Uuid::uuid1()->toString();
        $form->store();
    }
}
