<?php
namespace Home\Controller;
use Think\Controller;
class KindexController extends Controller {
    public function index(){
        $this->display();
    }

    public function goods_detail($id=''){
        $id=isset($_GET['id'])?"{$_GET['id']}":1;
        $model=M("goods_info");
        $goods=$model->where("id={$id}")->find();//某个商品的商品详情一维数组'
        $allgoods=$model->limit(0,6)->select();//所有商品的商品详情二维数组
        $model1=M("goods_pic");
        $pic=$model1->where("gid={$id}")->select();//某个商品的所有图片二维数组
        $this->assign("pic",$pic);
        $this->assign("goods",$goods);
        $this->assign("allgoods",$allgoods);
        $this->display("index/goods_detail");
    }

    public function goods_list(){
        $model=M("goods_info");
        $goods=$model->select();
        $this->assign("goods",$goods);
        $this->display("index/goods_list");
    }
}