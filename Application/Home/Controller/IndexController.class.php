<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function indexLayout(){//公共页面
        $this->display("public/indexLayout");
    }

    public function index(){

        $aa= New \Home\Controller\WeixinController();
       $url=$aa->geturl(100000,2);//微信引入

        $date=M("goodsInfo");
        $info=$date->query("select * from iphone_goods_info");
        $infoto=$date->query("select * from iphone_goods_info order by sellnum desc limit 0,4");
        $this->assign("url", $url);
        $this->assign("newinfo",$info);
        $this->assign("numinfo",$infoto);
        $this->display();
    }


}
/*  $datepath=M("category");
   $infopath=$datepath->query("select path from iphone_category where pid=0");
   $arr="";
   foreach($infopath as $v){
       $arr.=$v['path'].",";
   }
   $arr=substr($arr,0,-1);
   $sql="select id,catename,path from iphone_category where pid in ($arr)";
   $datepath=M("category")->query($sql);
   $inss=$this->pathss($datepath);
   print_r($inss);
   die;*/
 /*   function pathss($i){
        $datepath=M("category");
       for($j=0;$j<count($i);$j++){
           $mmm=$i[$j]['id'];
           $mm[$j]=$datepath->where("id=$mmm")->getField("pid");
       }
//print_r($mm);
        return $mm;
    }*/




/*
    function pathss($i){
        $datepath=M("category");
        for($j=0;$j<count($i);$j++){

            $ii=array_pop(explode(",",$i[$j]['path']));

            $sql="select path from iphone_category where pid=$ii";
           $num=$datepath->query($sql);
            //dump($num);
               if(count($num)===0){
                   $ioio[$j]=$datepath->where("id=$ii")->find();
                 //  dump($ioio);

                }else{

                    $this->pathss($num);
               }
        }
       // print_r($ioio);
        return $ioio;
}*/

