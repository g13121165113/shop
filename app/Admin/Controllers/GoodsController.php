<?php

namespace App\Admin\Controllers;

use \App\model\goods;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use \App\model\cates;

class GoodsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '\App\model\Goods';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Goods);

        $grid->column('goods_id', __('商品ID'));
        $grid->column('goods_name', __('商品名称'));
        $grid->column('goods_img', __('商品图片'));
        $grid->column('goods_desc', __('商品描述'));
        $grid->column('goods_price', __('商品售价'));
        $grid->column('cate_id', __('所属分类'));

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
        $show = new Show(Goods::findOrFail($id));

        $show->field('goods_id', __('商品ID'));
        $show->field('goods_name', __('商品名称'));
        $show->field('goods_img', __('商品图片'));
        $show->field('goods_desc', __('商品描述'));
        $show->field('goods_price', __('商品价格'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Goods);

        $form->text('goods_name', __('商品名称'));
        $form->file('goods_img', __('商品图片'));
        $form->textarea('goods_desc', __('商品描述'));
        $form->decimal('goods_price', __('商品售价'));
        $data = cates::where('is_del',1)->get()->toArray();
        $arr = [];
        foreach ($data as $k => $v){
            $arr[$v['cate_id']] = $v['cate_name'];
        }
        $form->select('cate_id', __('分类'))->options($arr);

        return $form;
    }
}
