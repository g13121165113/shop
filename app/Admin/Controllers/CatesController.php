<?php

namespace App\Admin\Controllers;

use \App\model\cates;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CatesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '\App\model\Cates';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Cates);

        $grid->column('cate_id', __('Cate id'));
        $grid->column('cate_name', __('Cate name'));
        $grid->column('p_id', __('P id'));

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
        $show = new Show(Cates::findOrFail($id));

        $show->field('cate_id', __('Cate id'));
        $show->field('cate_name', __('Cate name'));
        $show->field('p_id', __('P id'));
        $show->field('is_del', __('Is del'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Cates);

        $form->text('cate_name', __('分类名称'));
        $data = Cates::where('is_del',1)->get()->toArray();
        $cate = $this->demo($data);
        $arr = [0=>'顶级分类'];
        foreach ($cate as $k => $v){
            $arr[$v['cate_id']] = $v['cate_name'];
        }
        $form->select('p_id', __('父级分类'))->options($arr);

        return $form;
    }
    public function demo($data,$pid=0,$level=0){
        static $arr= [];
        foreach ($data as $k => $v) {
            if ($v['p_id']==$pid) {
                $v['level']=$level;
                $arr[$k]=$v;
                Self::demo($data,$v['cate_id'],$level+1);
            }
        }
        return $arr;
    }
}
