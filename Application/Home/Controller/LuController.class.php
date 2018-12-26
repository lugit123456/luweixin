<?php
namespace Home\Controller;
use Org\Util\Message;
use Think\Controller;
class LuController extends Controller
{
    public function index()
    {
        $this->display();
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

        //$this->display("index/register",$sendcode);
//        dump($sendcode);
        //die;
        $mobile_code =$this->random(4,1);
        $mobile_code2=session("sendcode",$mobile_code);
        //$this->display("index/register",$mobile_code);
        //dump($mobile_code);
        /*dump($mobile_code);*/
        //die;

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
                $member = M("member");
                $info = $member->where("uname='$uname'")->select();
                if ($_POST['mobile'] != $_SESSION['mobile'] or $_POST['mobile_code'] != $_SESSION['mobile_code'] or empty($_POST['mobile']) or empty($_POST['mobile_code'])) {
                    $data = '验证码或手机号码输入错误';
                    //echo "验证码或手机号码输入错误";
                    $this->assign("alert", $data);
                    $this->display("index/register");
                }
                else {
                        if ($data['password'] == $data['passwordConfirm']) {
                            $member = M("member");
                            $member->add($data);
                            $add = $member->where($data)->find();
                            $add = $add['id'];
                            $data = '恭喜你，用户注册成功';

                            $this->assign("alert", $data);
                            $this->display("Index/index", "id='$add'");
                            $_SESSION['uname'] = $data['uname'];
                            $_SESSION['mid'] = $add;
                        }
                        /*else {
                            $data = '密码输入不一致，请重新输入';
                            $this->assign("alert", $data);
                            $this->display("index/register");
                        }*/
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
                $this->assign("id",$id);
                $this->display("Index/index");
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

    function uname(){
        if($_POST){
            $username=$_POST["username"];
            $member = M("member");
            $info = $member->where("uname=$username")->find();
            if(count($info) != 0){
                echo "此账户名已被注册";
            }
        }else{
            $this->display("index/register");
        }
    }



    function face(){
        $this->display("index/face");
    }


    function face1(){
        if (!empty($_FILES['file'])) {
            $config = array(
                'maxSize' => 3145728,
                'rootPath' => "C:/code/lutp/Public/home/images/face_image/",
                'savePath' => '',
                'exts' => array('jpg', 'gif', 'png', 'jpeg'),
                'autoSub' => false,
            );
            $upload = new \Think\Upload($config);// 实例化上传类
            $info = $upload->uploadOne($_FILES['file']);
            if($info['size']>1240000 ||$info['size']==""){
                echo "<script>alert('未上传图片，或者图片超过1M');history.go(-1);</script>";
            }else {
                $facename = $info['savename'];
                     function curlPost($url, $data, $method)
                {
                    $ch = curl_init();   //1.初始化
                    curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
                    //4.参数如下
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Encoding: gzip, deflate'));//gzip解压内容
                    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

                    if ($method == "POST") {//5.post方式的时候添加数据
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    }
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $tmpInfo = curl_exec($ch);//6.执行

                    if (curl_errno($ch)) {//7.如果出错
                        return curl_error($ch);
                    }
                    curl_close($ch);//8.关闭
                    return $tmpInfo;
                }
//(图片路径）↓
                $filename = "C:/code/lutp/Public/home/images/face_image/$facename";
                $data = array
                (
                    'api_key' => "IjJb-NHVnV1_hJLI3xaDnxlIlo_BoB_v",
                    'api_secret' => "N5hDLPyyDr9oQiiPc8aOBGfBqBefAECq",
                    "image_file" => new \CURLFile($filename),
                    "return_attributes" => "gender,age,emotion,ethnicity,beauty,skinstatus,headpose",
                );
                $url = "https://api-cn.faceplusplus.com/facepp/v3/detect";
                $method = "POST";
                //$files=curlPost($url,$data,$method);
                $files = curlPost($url, $data, $method);
                $files = json_decode($files, true);
                if (!empty($files['faces'][0]['attributes'])) {


                    $emotion = $files['faces'][0]['attributes']['emotion'];//情绪识别结果
                    $beauty = $files['faces'][0]['attributes']['beauty'];//颜值程度
                    $gender = $files['faces'][0]['attributes']['gender'];//性别
                    $age = $files['faces'][0]['attributes']['age'];//年龄
                    $skinstatus = $files['faces'][0]['attributes']['skinstatus'];//面部特征
                    $ethnicity = $files['faces'][0]['attributes']['ethnicity'];//人种分析

                    /*echo "伤心程度:" . $emotion['sadness'] . "<br/>"
                        . "平静程度:" . $emotion['neutral'] . "<br>"
                        . "厌恶程度:" . $emotion['surprise'] . "<br/>"
                        . "高兴程度:" . $emotion['happiness'] . "<br/>"
                        . "惊讶程度:" . $emotion['surprise'] . "<br/>"
                        . "恐惧程度:" . $emotion['fear'] . "<br/>"
                        . "恐惧程度:" . $emotion['fear'] . "<br/>"
                        . "女性认为颜值程度:" . $beauty['female_score'] . "<br/>"
                        . "男性认为颜值程度:" . $beauty['male_score'] . "<br/>"
                        . "性别:" . $gender['value'] . "<br/>"
                        . "年龄:" . $age['value'] . "<br/>"
                        . "年龄:" . $age['value'] . "<br/>"
                        . "健康状态:" . $skinstatus['health'] . "<br/>"
                        . "青春痘:" . $skinstatus['acne'] . "<br/>"
                        . "色斑:" . $skinstatus['stain'] . "<br/>"
                        . "黑眼圈:" . $skinstatus['dark_circle'] . "<br/>"
                        . "人种分析:" . $ethnicity['value'] . "<br/>";
                    unlink($facename);
                }*/
                    if($gender['value']=="Male"){
                        echo "性别:" . "男" . "<br/>";
                        if($beauty['female_score']<40){
                            echo  "女性认为颜值程度:" ."这男的好丑啊" . "<br/>"
                                . "男性认为颜值程度:" . "这男的没法看，太丑" . "<br/>";
                        }elseif($beauty['female_score']>=40 && $beauty['female_score']<50){
                            echo  "女性认为颜值程度:" ."不算太丑" . "<br/>"
                                . "男性认为颜值程度:" . "不算太丑" . "<br/>";
                        }elseif($beauty['female_score']>=50 && $beauty['female_score']<60){
                            echo  "女性认为颜值程度:" ."一般" . "<br/>"
                                . "男性认为颜值程度:" . "一般" . "<br/>";
                        }elseif($beauty['female_score']>=60 && $beauty['female_score']<70){
                            echo  "女性认为颜值程度:" ."较帅" . "<br/>"
                                . "男性认为颜值程度:" . "较帅" . "<br/>";
                        }elseif($beauty['female_score']>=70 && $beauty['female_score']<80){
                            echo  "女性认为颜值程度:" ."一个字：帅！" . "<br/>"
                                . "男性认为颜值程度:" . "一个字：帅！" . "<br/>";
                        }elseif($beauty['female_score']>=80 && $beauty['female_score']<90){
                            echo  "女性认为颜值程度:" ."我的男神！" . "<br/>"
                                . "男性认为颜值程度:" . "这哥们帅的我都心动了！" . "<br/>";
                        }elseif($beauty['female_score']>=90 && $beauty['female_score']<100){
                            echo  "女性认为颜值程度:" ."你已经帅出了天际，无法用语言形容！吴亦凡都没你帅！" . "<br/>"
                                . "男性认为颜值程度:" . "你已经帅出了天际，无法用语言形容！吴亦凡都没你帅！！" . "<br/>";
                        }
                    }else{
                        echo "性别:" . "女" . "<br/>";
                        if($beauty['female_score']<40){
                            echo  "女性认为颜值程度:" ."这女的好丑啊" . "<br/>"
                                . "男性认为颜值程度:" . "这女的没法看，太丑" . "<br/>";
                        }
                        elseif($beauty['female_score']<40){
                            echo  "女性认为颜值程度:" ."不算太丑" . "<br/>"
                                . "男性认为颜值程度:" . "不算太丑，可以做朋友" . "<br/>";
                        }elseif($beauty['female_score']>=40 && $beauty['female_score']<60){
                            echo  "女性认为颜值程度:" ."一般" . "<br/>"
                                . "男性认为颜值程度:" . "一般" . "<br/>";
                        }elseif($beauty['female_score']>=60 && $beauty['female_score']<70){
                            echo  "女性认为颜值程度:" ."较漂亮" . "<br/>"
                                . "男性认为颜值程度:" . "这女生挺漂亮的" . "<br/>";
                        }elseif($beauty['female_score']>=70 && $beauty['female_score']<80){
                            echo  "女性认为颜值程度:" ."很漂亮！" . "<br/>"
                                . "男性认为颜值程度:" . "哇！快看，美女啊！！" . "<br/>";
                        }elseif($beauty['female_score']>=80 && $beauty['female_score']<90){
                            echo  "女性认为颜值程度:" ."大美女！" . "<br/>"
                                . "男性认为颜值程度:" . "她已经是我女神了，谁都别和我抢！" . "<br/>";
                        }elseif($beauty['female_score']>=90 && $beauty['female_score']<100){
                            echo  "女性认为颜值程度:" ."你已经美出了天际，无法用语言形容！凤姐都没你漂亮！" . "<br/>"
                                . "男性认为颜值程度:" . "你已经帅出了天际，无法用语言形容！凤姐都没你漂亮！！" . "<br/>";
                        }
                    }echo "年龄:" . $age['value']."岁" . "<br/>"
                        . "健康状态:" . $skinstatus['health'] . "<br/>"
                        . "女性认为颜值程度:" .$beauty['female_score']. "<br/>"
                        . "男性认为颜值程度:" .$beauty['female_score']. "<br/>";
                        /*. "人种分析:" . $ethnicity['value'] . "<br/>";*/
                    if($ethnicity['value']=="Asian"){
                        echo "人种：亚洲人";
                    }elseif($ethnicity['value']=="White"){
                        echo "人种：白人";
                    }else{
                        echo "人种：黑人";
                    }
                    unlink($filename);
            }
                else {
                    unlink($filename);
                    echo "<script>alert('识别失败，请重试');history.go(-1);</script>";
                }
            }
        }else{
            echo("file直接跳出");
        }
    }



    function face2(){
        $this->display("index/face2");
    }

    public function twoface()
    {
        if (!empty($_FILES['file'])) {
            $config = array(
                'maxSize' => 3145728,
                'rootPath' => "C:/code/lutp/Public/home/images/face_image/",
                'savePath' => '',
                'exts' => array('jpg', 'gif', 'png', 'jpeg'),
                'autoSub' => false,
            );
            $upload = new \Think\Upload($config);// 实例化上传类
            $info = $upload->uploadOne($_FILES['file']);
            $face['imagename'] = $info["savename"];
            $facename = $info["savename"];
            /*var_dump($info);
            die;*/
            if ($info['size'] == "" || $info['size'] > 1200000){
                echo "<script>alert('未上传图片，或者图片超过1M');history.go(-1);</script>";
            } else {
                function curlPost($url, $data, $method)
                {
                    $ch = curl_init();   //1.初始化
                    curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
                    //4.参数如下
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept-Encoding: gzip, deflate'));//gzip解压内容
                    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
                    if ($method == "POST"){//5.post方式的时候添加数据
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    }
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $tmpInfo = curl_exec($ch);//6.执行

                    if (curl_errno($ch)) {//7.如果出错
                        return curl_error($ch);
                    }
                    curl_close($ch);//8.关闭
                    return $tmpInfo;
                }
//(图片路径）↓
                $fa = M("face");
                $face['ip'] = $_SERVER["REMOTE_ADDR"];
                $ip = $_SERVER["REMOTE_ADDR"];
                $face['imageip'] = "C:/code/lutp/Public/home/images/face_image/$facename";
                $getip = $fa->where("ip='{$ip}'")->getField("imagename");
                if ($getip != "") {
                    $face1 = "C:/code/lutp/Public/home/images/face_image/$facename";
                    $face2 = "C:/code/lutp/Public/home/images/face_image/$getip";
                    $data = array
                    (
                        'api_key' => "IjJb-NHVnV1_hJLI3xaDnxlIlo_BoB_v",
                        'api_secret' => "N5hDLPyyDr9oQiiPc8aOBGfBqBefAECq",
                        "image_file1" => new \CURLFile($face1),
                        "image_file2" => new \CURLFile($face2),
                        "return_attributes" => "gender,age,emotion,ethnicity,beauty,skinstatus,headpose",
                    );
                    $url = "https://api-cn.faceplusplus.com/facepp/v3/compare";
                    $method = "POST";
                    $files = curlPost($url, $data, $method);
                    $files = json_decode($files, true);
                    if($files['confidence']!=""){
                        if ($files['confidence'] < 85) {
                            unlink($face1);
                            echo "<script>alert('不是同一个人{$files['confidence']}');history.go(-1);</script>";
                        }else{
                            unlink($face1);
                            echo "<script>alert('是同一个人{$files['confidence']}');history.go(-1);</script>";
                        }
                    }else{
                        unlink($face1);
                        echo "<script>alert('识别失败，请重试');history.go(-1);</script>";
                    }
                } else {
                    $info = $fa->data($face)->add();
                    echo "<script>alert('已上传，请上传需识别的照片');history.go(-1);</script>";
                }
            }

        }
    }

    public function zhaocha(){//找茬小游戏
        $this->display("index/zhaocha");
    }

    public function yaoyiyao(){//摇一摇小游戏
        $this->display("index/yaoyiyao");
    }
}