<?php
namespace Home\Controller;
use Org\Util\Message;
use Think\Controller;
class LuController extends Controller
{
    public function index()
    {
        $this->display('index/login');
    }

    /*public function register(){
        $this->display("index/register");
    }*/
    //发送手机短语验证码
    function sendCode(){

        //$message=new Message();
        //$target = "http://106.ihuyi.cn/webservice/Message.class.php?method=Submit";

/*msm.php代码复制开始*/

        $target = "http://106.ihuyi.cn/webservice/sms.php?method=Submit";
        $mobile = $_POST['mobile'];
        $send_code = $_POST['send_code'];
        $sendcode=session("sendcode",$send_code);
//        dump($sendcode);
//        die;
        $mobile_code =$this->random(4,1);
        /*dump($mobile_code);
        die;*/

        if(empty($mobile)){
            exit('手机号码不能为空');
            //$this->back()->with("msg","密码不能为空");
        }

        if(empty($_SESSION['send_code']) or $send_code!=$_SESSION['send_code']){
            //防用户恶意请求
            exit('请求超时，请刷新页面后重试');
        }
        /*自己的APIKEY秘密*/
        $apiid="C98686393";
        $apikey="5b294cc5a895cb515e1b0c082aca7b4e";
        $post_data = "account={$apiid}&password={$apikey}&mobile=".$mobile."&content=".rawurlencode("您的验证码是：".$mobile_code."。请不要把验证码泄露给其他人。");
        //$post_data = "account={$apiid}&password={$apikey}&mobile=".$mobile."&content=".rawurlencode($mobile_code);
//密码可以使用明文密码或使用32位MD5加密
        $me=$this->Post($post_data,$target);
        echo  $me;
        /*$gets = $message->xml_to_array($me);*/
        //$gets =$message->xml_to_array(Post($post_data, $target));
        $gets =$this->xml_to_array($me);
        //dump($gets);
        //die;
        if($gets['SubmitResult']['code']==2){
            $_SESSION['mobile'] = $mobile;
            $_SESSION['mobile_code'] = $mobile_code;
        }

        $gets['SubmitResult']['msg'];
    }


    function random($length = 6 , $numeric = 0) {
        PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
        if($numeric) {
            $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
        } else {
            $hash = '';
            $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789abcdefghjkmnpqrstuvwxyz';
            $max = strlen($chars) - 1;
            for($i = 0; $i < $length; $i++) {
                $hash .= $chars[mt_rand(0, $max)];
            }
        }
        return $hash;
    }
    function Post($curlPost,$url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        $return_str = curl_exec($curl);
        curl_close($curl);
        return $return_str;
    }
//xml格式数据转换为数组格式
    function xml_to_array($xml){
        $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
        if(preg_match_all($reg, $xml, $matches)){
            $count = count($matches[0]);
            for($i = 0; $i < $count; $i++){
                $subxml= $matches[2][$i];
                $key = $matches[1][$i];
                if(preg_match( $reg, $subxml )){
                    $arr[$key] = $this->xml_to_array( $subxml );
                }else{
                    $arr[$key] = $subxml;
                }
            }
        }
        return $arr;
    }

/*    msm.php代码复制   结束*/

    function register()
    {
        if (IS_POST) {//注册
            $data['uname'] = $_POST['username'];
            $data['sex'] = $_POST['lastname'];
            $data['phonenum'] = $_POST['mobile'];
            $data['passwordConfirm'] = md5($_POST['passwordConfirm']);
            $data['password'] = md5($_POST['password']);
            $uname = $_POST['username'];
            $tiaokuan = $_POST['tiaokuan'];
            $member = M("member");
            $info = $member->where("uname='$uname'")->select();
//            $target = "http://106.ihuyi.cn/webservice/Message.class.php?method=Submit";
//            $mobile = $_POST['mobile'];
//            $send_code = $_POST['send_code'];
//            $mobile_code = $message->random(4,1);
//            if(empty($mobile)){
//                exit('手机号码不能为空');
//            }
//
//            if(empty($_SESSION['send_code']) or $send_code!=$_SESSION['send_code']){
//                //防用户恶意请求
//                exit('请求超时，请刷新页面后重试');
//            }
//            /*自己的APIKEY秘密*/
//            $apiid="C59739321";
//            $apikey="b9251edf4242de8245c4d466bc27b94c";
//            $post_data = "account={$apiid}&password={$apikey}&mobile=".$mobile."&content=".rawurlencode("您的验证码是：".$mobile_code."。请不要把验证码泄露给其他人。");
////密码可以使用明文密码或使用32位MD5加密
//            $me=$message->Post($post_data, $target);
//            echo $me;
//            die;
//            $gets =  $message->xml_to_array($me);
//            if($gets['SubmitResult']['code']==2){
//                $_SESSION['mobile'] = $mobile;
//                $_SESSION['mobile_code'] = $mobile_code;
//            }
//            echo $gets['SubmitResult']['msg'];
            /*if($tiaokuan==1){
                    echo "请先同意条款和条件";
                    $this->display("index/register");*/
            if ($_POST['mobile'] != $_SESSION['mobile'] or $_POST['mobile_code'] != $_SESSION['mobile_code'] or empty($_POST['mobile']) or empty($_POST['mobile_code'])) {
                $data='验证码或手机号码输入错误';
                $this->assign("alert",$data);
                $this->display("index/register");
            }
                /*if(empty($_POST['mobile']))
                {
                    echo('手机号码为空');
                    $this->display("index/register");
                }
            if(empty($_POST['mobile_code']))
            {
                echo('手机验证码为空。请重新输入');
                $this->display("index/register");
            }

            if($_POST['mobile'] != $_SESSION['mobile'])
            {
                echo('手机号码不一致');
                $this->display("index/register");
            }

            if($_POST['mobile_code'] != $_SESSION['mobile_code'])
            {
                echo('验证码输入错误');
                $this->display("index/register");
            }*/
            else {
                    if (count($info) != 0) {
                        $data='此用户名已存在';
                        $this->assign("alert",$data);
                        $this->display("index/register");
                    } else {
                        if ($data['password'] == $data['passwordConfirm']) {
                            $member = M("member");
                            $member->add($data);
                            $add = $member->where($data)->find();
                            $add=$add['id'];
                            $data='恭喜你，用户添加成功';
                            $this->assign("alert",$data);
                            $this->display("Index/index","id='$add'");
                            $_SESSION['uname']=$data['uname'];
                            $_SESSION['mid']=$add;
                        } else {
                            $data='密码输入不一致，请重新输入';
                            $this->assign("alert",$data);
                            $this->display("index/register");
                        }

                        /*$member = M("member");
                        $add = $member->add($data);
                        $this->display("index/login");
                        exit("恭喜你，用户添加成功");*/
                    }
            }
        }
          /*  else{
                exit("请输入正确的电话号码");
            }*/


//            if(count($info)!=0){
//                echo "用户名已存在";
//                $this->display("index/register");
//            }
//            else{
//                $member = M("member");
//                $add = $member->add($data);
//                $this->display("index/login");
//                exit("添加成功");
//            }
//}
        else {
            $messag=new Message();
            $_SESSION['send_code']=$messag->random(4,1);
            $this->assign('send_code',$_SESSION['send_code']);
            $this->display("index/register");
        }

    }

    function login()//登录
    {
        if($_POST) {
            $data['uname'] = $_POST['username'];
            $data['password'] = md5($_POST['password']);
            $member = M("member");
            $info = $member->where($data)->find();
            /*dump($info);
            die;*/
            $id=$info['id'];
            if(count($info)!=0){
                $aler='恭喜你，登录成功';
                $this->assign("alert",$aler);
                $this->display("Index/index","id='$id'");
                $_SESSION['uname']=$data['uname'];
                $_SESSION['mid']=$id;

                //dump($_SESSION);
                //:U('index/login',"id='$id'");
                //$this->display('index/login',"id='$id'");
            }else{
                $aler='用户名或密码输入错误';
                $this->assign("alert",$aler);
                $this->display("index/login");
            }
        }else{
            $this->display("index/login");
        }


    }




}