<?php
namespace Home\Controller;

use Org\Util\Message;
use Think\Controller;
use Think\Db;

class WeixinController extends Controller
{

    private $token = "lucheng491";

    private $appId = "wxd56157d540a5f119";

    private $appSecret = "0898a0dcf4601030473d8c320cc258f8";

    public function index()
    {

	//ob_clean();
        if (isset($_GET["echostr"])) {
            //微信验证-第一次
            $this->valid();
        
        } else {

            $this->responseMsg();
        }
    }

		public function weather($keyword=''){
    $params = array(
        'appkey' => '47b34e2255648c0a37cd18598756a27a'
    );
    $url = 'https://way.jd.com/jisuapi/weather1';
    $all=json_decode($this->wx_http_request($url, $params ));
    foreach($all->result->result as $k=>$v){
            if($keyword==$v->city){
                $params = array(
                    'city' => $keyword,
                    'cityid' => $v->cityid,
                    'citycode' =>$v->citycode,
                    'appkey' => '47b34e2255648c0a37cd18598756a27a'
                );
                $url = 'https://way.jd.com/jisuapi/weather';
                $weather=json_decode($this->wx_http_request($url, $params));



                if(($weather->result->result->city)!=""){
                    $contentStr="城市:".$weather->result->result->city.
                        "\r\n天气:".$weather->result->result->daily[0]->night->weather.
                        "\r\n日期:".$weather->result->result->date.
                        "\r\n温度:".$weather->result->result->temp."~".$weather->result->result->templow.
                        "\r\n星期:".$weather->result->result->week.
                        "\r\n风级:".$weather->result->result->windpower;

                    foreach($weather->result->result->index as $v1){
                        @$contentStr.="\r\n".$v1->iname.":".$v1->ivalue."\r\n".$v1->detail;
                    }
                    return $contentStr;
                }else{
                    $contentStr="error";
                    return $contentStr;
                }




            }
}

}
public function wx_http_request($url, $params, $body="", $isPost=false, $isImage=false ) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url."?".http_build_query($params));
    if($isPost){
        if($isImage){
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: multipart/form-data;',
                    "Content-Length: ".strlen($body)
                )
            );
        }else{
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: text/plain'
                )
            );
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    }
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
	
    public function responseMsg()
    {
        // $domainName= ' http://1.panjichang1990.applinzi.com';
        // get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];//用户名胡勇  事件：关注公众号   粤剧拉拉
        // global $textTpl;
        $textTpl = "<xml>
                           <ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
        $newsTpl = "<xml>
		  <ToUserName><![CDATA[%s]]></ToUserName>
		  <FromUserName><![CDATA[%s]]></FromUserName>
		  <CreateTime>%s</CreateTime>
		  <MsgType><![CDATA[%s]]></MsgType>
		  <ArticleCount>%s</ArticleCount>
		  <Articles>
		  <item>
		  <Title><![CDATA[%s]]></Title>
		  <Description><![CDATA[%s]]></Description>
		  <PicUrl><![CDATA[%s]]></PicUrl>
		  <Url><![CDATA[%s]]></Url>
		  </item>
		  </Articles>
		  <FuncFlag>1</FuncFlag>
		  </xml>";
        $musicTpl = "<xml>
		  <ToUserName><![CDATA[%s]]></ToUserName>
		  <FromUserName><![CDATA[%s]]></FromUserName>
		  <CreateTime>%s</CreateTime>
		  <MsgType><!CDATA[%s]></MsgType>
		  <Music>
		  <Title><![CDATA[%s]]></Title>
		  <Description><![CDATA[%s]]></Description>
		  <MusicUrl><![CDATA[%s]]></MusicUrl>
		  <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
		  </Music>
		  <FuncFlag>0</FuncFlag>
		  </xml>";

        if (empty($postStr)) {
            echo "";
            exit();
        }

        // extract post data
        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);//讲post提交过了的数据转化为对象格式
        $fromUsername = $postObj->FromUserName;//胡勇
        $toUsername = $postObj->ToUserName;//粤剧拉拉
        $time = time();

        $token = $this->readtoken();
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$fromUsername";
        $result = json_decode(https_request($url));

        switch (strtolower(trim($postObj->MsgType))) {
            case "event": // 事件
                switch (strtolower(trim($postObj->Event))) {
                    case "subscribe": // 关注事件
                        $msgType = "text";
                        $res = M("user_lu")->where("user_openid='$result->openid'")->find();
                        if ($res) {
                            if ($res['user_active'] == 0) {
                                $data['user_active'] = 1;
                                M("user_lu")->where("user_openid='$result->openid'")->save($data);
                            }
                        } else {
                            $data['user_nickname'] = $result->nickname;
                            $data['user_openid'] = $result->openid;
                            M("user_lu")->add($data);

                        }
                        $info = M("user_lu")->where("user_openid='$result->openid'")->find();
                        $urls = $this->geturl($info['id'], 1);
                        $contentStr = "欢迎关注特斯拉无线传输公众号，我们将为您带来科普知识，全球尖端科技，前沿技术，为您带来不一样的体验！
                        本公众号可查询天气，您只用发送你要查询的地址，公众号会自动发送给您。发送“笑话”可为你发送一条笑话！luzhechengtian" . $urls;

                        if (isset($postObj->EventKey) && $postObj->EventKey) {
                            $arr = explode("_", $postObj->EventKey);
                            //1.用户未关注时
                            //   EventKey  事件key值，qrscene_为前缀，后面是二维码参数值
                            // 2.用户已关注时
                            //   EventKey  事件key值，是一个32位无符号整数，即创建二维码时的二维码的scene_id

                            $res1 = M("user_lu")->where("id='$arr[1]'")->find();
                            $user = M("user_lu")->where("user_openid='$result->openid'")->find();
                            if ($res1) {
                                if ($user['uesr_biaoshi'] == 0) {
                                    $data1['user_money'] = $res1["user_money"] + 1;
                                    $data2['uesr_biaoshi'] = 1;
                                    M("user_lu")->where("id = '$arr[1]'")->save($data1);
                                    M("user_lu")->where("user_openid = '$result->openid'")->save($data2);
                                }
                                $contentStr = "用户通过扫描'{$res1['user_nickname']}'的二维" . $arr[1] . "码关注tpnews" . $urls;
                            } else {
                                if ($user['uesr_biaoshi'] == 0) {
                                    $data3['uesr_biaoshi'] = 1;
                                    M("user_lu")->where("user_openid = '$result->openid'")->save($data3);
                                }
                                $contentStr = "用户通过扫描二微码关注tpnews" . $arr[1] . "用户通过扫描二微码关注tpnews" . $urls;
                            }
                        }


                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        break;
                    case "unsubscribe": // 取消关注事件
                        $data['user_active'] = 0;
                        $res = M("user_lu")->where("user_openid='$result->openid'")->save($data);
                        if ($res) {
                            $this->userAttentionCancel($fromUsername);
                            session("openid", null);
                            cookie("openid", null);
                        }

                        break;
                    case "scan": // 用户已关注时扫描二维码事件
                        $msgType = "text";
                        $contentStr = "扫描 " . $postObj->EventKey;
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        break;
                    case "location": // 上传地理位置事件
                        $msgType = "text";
                        $contentStr = "您上传地理位置";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        break;
                    case "click": // 自定义菜单事件
                        if ("天气" == $postObj->EventKey) {
                            $msgType = "text";
                            $contentStr = "我现在已收货5棵大白菜，10枚鸡蛋";
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        }
                        if ("笑话" == $postObj->EventKey) {
                            $and = rand(1, 10);
                            $content = M('joke')->where("id=$and")->select();
                            foreach ($content as $k => $v) {
                                $contentStr = $v['content'];
                                $msgType = "text";
                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                            }
                        }
                        break;
                    default:
                        $resultStr = "";
                }
                break;
            /*case "text":
                $keyword = "笑话";
                $msgType = "text";
                //$contentStr = Db::query('select * from iphone_joke where id = 1');
                //$member = M("joke");
                //$content=Db::query('select * from iphone_joke where id = 1');
                //$contentStr=Db::table('iphone_joke')->where('id',1)->select('content');
                $and=rand(0,10);
                $content=M('joke')->where("id=$and")->select();
                //$contentStr='select id from iphone_joke where id=1';
                foreach($content as $k=>$v){
                    $contentStr=$v['content'];
                }
                //$contentStr=$content[0];
           //$contentStr=Db::table("iphone_joke")->where("id",1)->select();
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);

            break;*/
            case "text":
                $keyword = trim($postObj->Content);//郑州
                //$contentStr= M('wheat')->where("city='$keyword'")->getField("content");
                $contentStr = $this->weather($keyword);
                if ($contentStr != "") {
                    $msgType = "text";
                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                } else {
                    if ($keyword == "笑话") {
                        $and = rand(1, 10);
                        $content = M('joke')->where("id=$and")->select();
                        foreach ($content as $k => $v) {
                            $contentStr = $v['content'];
                            $msgType = "text";
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                        }
                    } else {
                        $contentStr = "输入有误，请重新输入";
                        $msgType = "text";
                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                    }
                }
                break;



            case "image":
                $msgType = "text";
                $openid=$result->openid;
                $mediaid=(string)$postObj->MediaId;
                $path="C:/code/lutp/Public/home/images/face_image/face_$openid.jpg";
                $aa=$this->downimg($mediaid,$path);
                /*foreach($aa as $k=>$v){
                    $contentStr = "$v,$path";
                }*/

                $contentStr = "$aa,$path";
                /*$msgType = "text";*/
                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                break;


            case "pic_photo_or_album":
                                $content = "拍照或者相册：数量 ".$postObj->SendPicsInfo->Count;
                break;
            case "location":
            case "voice":
            case "video":
            case "shortvideo":                
            case "link":
                $resultStr = $this->transmitService($postObj);
                break;                
            default:
                $resultStr = "";
        }
//        if(is_array($postObj)){
//            if (isset($content[0]['PicUrl'])){
//                $resultStr = $this->transmitNews($postObj, $content);
//            }else if (isset($content['MusicUrl'])){
//                $resultStr = $this->transmitMusic($postObj, $content);
//            }
//        }else{
//            $resultStr = $this->transmitText($postObj, $content);
//        }
        echo $resultStr;
    }
    //接收文本消息
    private function receiveText($object)
    {
//         $keyword = trim($object->Content);
//         if($keyword == "时间" || $keyword == "测试"){
//             $content = date("Y-m-d H:i:s",time());
//             $result = $this->transmitText($object, $content);
//         }
//         //触发多客服模式
//         else if (strstr($keyword, "您好") || strstr($keyword, "你好") || strstr($keyword, "在吗") || strstr($keyword, "有人吗")){
//             $result = $this->transmitService($object);
//             return $result;
//         }
        $result = $this->transmitService($object);
        return $result;
    }
    //回复文本
    private function transmitText($object, $content)
    {
        $textTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[text]]></MsgType>
<Content><![CDATA[%s]]></Content>
</xml>";
        $result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
        return $result;
    }
    //回复文本
    private function transmitImage($object, $mediaId)
    {
    	$imageTpl="<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[image]]></MsgType>
<Image>
<MediaId><![CDATA[%s]]></MediaId>
</Image>
</xml>";
    	$result = sprintf($imageTpl, $object->FromUserName, $object->ToUserName, time(), $mediaId);
    	return $result;
    }
    //回复多客服消息
    private function transmitService($object)
    {
        $xmlTpl = "<xml>
<ToUserName><![CDATA[%s]]></ToUserName>
<FromUserName><![CDATA[%s]]></FromUserName>
<CreateTime>%s</CreateTime>
<MsgType><![CDATA[transfer_customer_service]]></MsgType>
</xml>";
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time());
        return $result;
    }
    // 回复图文消息
    private function transmitNews($object, $newsArray)
    {
        if (! is_array($newsArray)) {
            return;
        }
        $itemTpl = "    <item>
        <Title><![CDATA[%s]]></Title>
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
    </item>
";
        $item_str = "";
        foreach ($newsArray as $item) {
            $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);
        }
        $xmlTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[news]]></MsgType>
        <ArticleCount>%s</ArticleCount>
        <Articles>
        $item_str</Articles>
        </xml>";

        /*$xmlTpl="图文消息";*/
        $result = sprintf($xmlTpl, $object->FromUserName, $object->ToUserName, time(), count($newsArray));
        return $result;
    }
    
    /* 开启微信验证 */
    public function valid()
    {
        $echoStr = $_GET["echostr"];     
        // valid signature, option
        if ($this->checkSignature()) {
            echo $echoStr;
            exit();
        }
    }
    /* 开启微信验证 */
    private function checkSignature()
    {
        $signature = $_GET["signature"];//abc123
        $timestamp = $_GET["timestamp"];//520
        $nonce = $_GET["nonce"];//521
        
        $tmpArr = array(
            $this->token,
            $timestamp,
            $nonce
        );
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);   //1I1GCK7C1520521
        $tmpStr = sha1($tmpStr);//abc123
        
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }
    
    /* 生成微信的新的access_token */
    private function getAccessToken()
    {
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        $output = curl_exec($ch);
        curl_close($ch);
        if (empty($output)) {
            return "";
        }
        
        $result = json_decode($output);
        return $result->access_token;
    }

    /**
     * 获取access_token（公众号的全局唯一票据）
     * 在2小时内 从数据库里读取access_token；否则生成新的token存到数据库
     * access_token是公众号的全局唯一票据，公众号调用各接口时都需使用access_token。开发者需要进行妥善保存。access_token的存储至少要保留512个字符空间。access_token的有效期目前为2个小时，需定时刷新，重复获取将导致上次获取的access_token失效。
     */
    public function readtoken($is_refresh=0)
    {
    	
    		 
        $M_TOKEN = M('token');
        $token = $M_TOKEN->order('token_time desc')->find();
        $lasttime = strtotime($token['token_time']); // 在token这个表里，c按照time列降序排序，取出time列的第一个值（即limit 1）
        $timenow = time(); // 生成现在的时间，时间戳
           // 如果现在的时间减去最后一次存储的时间戳，如果小于7100，则再次sql，获取已经存储到表的token，若不是，则新生成token，并存储到数据库
        if ($timenow - $lasttime < 7200&&(!$is_refresh) && $token ) {
            $tokenread = $token['token_value'];
        } else {
        	      		
	            $newtoken = $this->getAccessToken();
	            $token_time=nowtime();
				M()->execute("insert into iphone_token (token_value,token_time) values('$newtoken','$token_time')");
	            $tokenread = $newtoken;

          
           
        }
        return $tokenread;
    }

    /**
     * 将新生成的access_token存储到数据库
     */
    public function savetoken($token)
    {
        $M_TOKEN = M('token');
        $data['token_time'] = nowtime();
        $data['token_value'] = $token;
        $M_TOKEN->add($data);
        // echo M('token')->getLastSql();
    }

    /**
     * 根据用户的openid获取用户的昵称
     */
    public function get_name($object)
    {

        $access_token = $this->readtoken();

        // 这里需要解决access_token 2个小时有效期的问题，
        // 一个思路是，新定义一个函数，只要一调用这个函数，则查找数据库上一个access_token生成的时间，对比现在的时间
        // 若超过2个小时，则用get方式获取新的access_token，并返回新的access_token，且存储到数据库中；
        // 若不到2个小时，则把数据库中已经存储的最新的access_token提取并返回；
        $openid = $object->FromUserName;        
        // 拼成获取用户信息的SSL get方式的API链接
        $infourl = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $access_token . "&openid=" . $openid . "&lang=zh_CN";
        $result = https_request($infourl);
        $utfresult = utf8_encode($result);
        $mm = json_decode($result, true);
        //token失效重新获取
        if($mm[errcode]=='42001'|| $mm[errcode]=='40001' || $mm[errcode]=='40014'){
        	$access_token = $this->readtoken(true);
        	// 拼成获取用户信息的SSL get方式的API链接
        	$infourl = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $access_token . "&openid=" . $openid . "&lang=zh_CN";
        	$result = https_request($infourl);
        	$utfresult = utf8_encode($result);
        	$mm = json_decode($result, true);
        }
        return trim($mm['nickname']);
    }

    /**
     * 第一步：用户同意授权，获取code
     * 获取openid跳转--snsapi_userinfo
     * 应用授权作用域，snsapi_base （不弹出授权页面，直接跳转，只能获取用户openid），snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、所在地。并且，即使在未关注的情况下，只要用户授权，也能获取其信息）
     *
     * @param unknown $r_url            
     */
    public function oauth()
    {
        $domainName=C("domainName");
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize";
        $url .= "?appid=$this->appId";
        $url .= "&redirect_uri=".$domainName."/index.php/Weixin/Weixin/oauth2";
        $url .= "&response_type=code&scope=snsapi_userinfo&state=128#wechat_redirect";
        redirect($url);
    }

    /**
     * 第一步：用户同意授权，获取code
     * 应用范围：登录注册绑定用户，我的仓库，积分，下单
     * 获取openid跳转----snsapi_base
     * 应用授权作用域，snsapi_base （不弹出授权页面，直接跳转，只能获取用户openid），snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、所在地。并且，即使在未关注的情况下，只要用户授权，也能获取其信息）
     *
     * @param unknown $r_url            
     */
    public function openid_redirect()
    {
        $r_url = "http://www.域名.com" . request_uri();
        //添加跳转地址
        $url_arr = parse_url($r_url);
        //判断是否有参数
        if(isset($url_arr[query])&&$url_arr[query]!=""){
        	$r_url.="&jump=".urlencode($r_url);
        }else{
        	$r_url.="?jump=".urlencode($r_url);
        }
      //  $r_url = "http://www.域名.com";
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize";
        $url .= "?appid=$this->appId";
        $url .= "&redirect_uri=".urlencode($r_url);
        $url .= "&response_type=code&scope=snsapi_base&state=123#wechat_redirect";
     //   echo $url;exit;
        header('Location: ' . $url);
        exit();
        //redirect($url);
    }

    /**
     * 第二步：通过code换取网页授权access_token
     * 应用范围：登录注册绑定用户，我的仓库，积分，下单
     * 根据code获取openid
     *
     * @param unknown $code            
     * @return string mixed
     */
    public function getOpenID($code)
    {
        $url = "https://api.weixin.qq.com/sns/oauth2/access_token";
        $url .= "?appid=$this->appId&secret=$this->appSecret&grant_type=authorization_code";
        $url .= "&code=$code";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        $output = curl_exec($ch);
        curl_close($ch);
        if (empty($output)) {
            return "";
        }
        
        $result = json_decode($output);
        $openid = $result->openid;
        session("openid", $openid);
        cookie("openid", $openid, 3600);
        
        session("unionid", $result->unionid);
        cookie("unionid",$result->unionid, 3600);
        //获取openid日志记录
        $log[openid]=$openid;
        $log[time]=nowtime();
        $log[code]=$result->unionid;
        $log[url]=$output;
        $log[ip]=getRealIp();
        $r_url = "http://www.域名.com" . request_uri();
        $log[curent_url]=$r_url;
        //M('openid_log')->add($log);
        
        return $openid;
    }

    /**
     *通过code换取网页授权access_token和scope
     */
    private function refreshAuthorAccessToken($code){
    	$url = "https://api.weixin.qq.com/sns/oauth2/refresh_token";
    	$url.="?appid=$this->appId&grant_type=refresh_token";
    	$url.="&refresh_token=$code";
    	echo $url;die;
    	$ch = curl_init($url);
    	curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_POST, 0);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    	$output = curl_exec($ch);
    	curl_close($ch);
    	if (empty($output)) { return ""; }
    
    	$result = json_decode($output);
    	$openid = $result->openid;
    	session("openid", $openid);
    	cookie("openid", $openid, 7100);
    
    	session("unionid", $result->unionid);
    	cookie("unionid",$result->unionid, 7100);
    	 
    	cookie("refresh_token",$result->refresh_token, 7100);
    	$resultAll[access_token]=$result->access_token;
    	$resultAll[openid]=$result->openid;
    	return $resultAll;
    }
    /**
     * 第一步：用户同意授权，获取code
     * 应用范围：登录注册绑定用户，我的仓库，积分，下单
     * 获取openid跳转----snsapi_base
     * 应用授权作用域，snsapi_base （不弹出授权页面，直接跳转，只能获取用户openid），snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、所在地。并且，即使在未关注的情况下，只要用户授权，也能获取其信息）
     *
     * @param unknown $r_url
     */
    public function openid_redirectnoAttention()
    {
    	$r_url = "http://www.域名.com" . request_uri();
    	//添加跳转地址
    	$url_arr = parse_url($r_url);
    	//判断是否有参数
    	if(isset($url_arr[query])&&$url_arr[query]!=""){
    		$r_url.="&jump=".urlencode($r_url);
    	}else{
    		$r_url.="?jump=".urlencode($r_url);
    	}
    	$url = "https://open.weixin.qq.com/connect/oauth2/authorize";
    	$url .= "?appid=$this->appId";
    	$url .= "&redirect_uri=".urlencode($r_url);
    	$url .= "&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
    	header('Location: ' . $url);
    	exit();
    }
    /**
     * 第二步：通过code换取网页授权access_token
     * 应用范围：登录注册绑定用户，我的仓库，积分，下单
     * 根据code获取openid
     *
     * @param unknown $code
     * @return string mixed
     */
    public function getOpenIDnoAttention($code)
    {
    	$url = "https://api.weixin.qq.com/sns/oauth2/access_token";
    	$url .= "?appid=$this->appId&secret=$this->appSecret&grant_type=authorization_code";
    	$url .= "&code=$code";
    	$ch = curl_init($url);
    	curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_POST, 0);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    
    	$output = curl_exec($ch);
    	curl_close($ch);
    	if (empty($output)) {
    		return "";
    	}
    
    	$result = json_decode($output);
    	$openid = $result->openid;
    	session("openid", $openid);
    	cookie("openid", $openid, 3600);
    	
    	session("unionid", $result->unionid);
    	cookie("unionid",$result->unionid, 3600);
    	
    	//cookie("refresh_token",$result->refresh_token, 7100);
    	$resultAll[access_token]=$result->access_token;
    	$resultAll[openid]=$result->openid;
    	return $resultAll;
    }
    /**
     * 获取用户信息
     * @param unknown $openid
     * @param unknown $access_token
     * @return string|mixed
     */
    public function noAttention_getInfoFour($openid,$access_token)
    {
    	$url = "https://api.weixin.qq.com/sns/userinfo?";
    	$url .= "access_token=$access_token&openid=$openid&lang=zh_CN";
    	$ch = curl_init($url);
    	curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	curl_setopt($ch, CURLOPT_POST, 0);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    	 
    	$output = curl_exec($ch);
    	curl_close($ch);
    	if (empty($output)) {
    		return "";
    	}
    	 
    	$result = json_decode($output,true);
    	session("headimgurl", $result[headimgurl]?$result[headimgurl]:"http://www.域名.com/Public/img/Home/header_default.jpg");
    	cookie("headimgurl", $result[headimgurl]?$result[headimgurl]:"http://www.域名.com/Public/img/Home/header_default.jpg", 3600);
    	session("nickname", $result[nickname]);
    	cookie("nickname", $result[nickname], 3600);
    	return $result;
    }
    /**
     * 当一些页面需要得到微信用户的openid，可以直接调取这个方法
     *
     * @param unknown $code
     * @return string mixed
     */
    public function noAttention_getInfo()
    {
    	$data_store=array();
    	if(C('data_store')=="cookie"){
    		$data_store=$_COOKIE;
    	}else{
    		$data_store=$_SESSION;
    	}
	
    	if ((! isset($data_store['openid'])||$data_store['openid']=="")||(!isset($data_store['headimgurl']))) {
    		 	
			if (isset ( $_GET ['code'] )) {
				
				// 授权后跳转的时候，可以获取code。如果用户同意授权，页面将跳转至 redirect_uri/?code=CODE&state=STATE。若用户禁止授权，则重定向后不会带上code参数，仅会带上state参数redirect_uri?state=STATE
				// 当第一次授权登录后，将用户的access_token和refresh_token和openid和当前时间，存到session里
				$code = $_GET ["code"];
				$openid_and_access_token = $this->getOpenIDnoAttention ( $code ); // 获取openid

				$openid = $openid_and_access_token [openid];
				$access_token = $openid_and_access_token [access_token];
				$info = $this->noAttention_getInfoFour ( $openid, $access_token );
				 				
				$this->init_relation($openid, $info);
				
				//$this->init_adopt_user($openid);
				/*
				 * if(!$headimgurl){ $openid_and_access_token = $this->refreshAuthorAccessToken($data_store['refresh_token']); // 获取openid $openid=$openid_and_access_token[openid]; $access_token=$openid_and_access_token[access_token]; } $this-> test_noAttention_getInfoFour($openid,$access_token);
				 */
				// 如果openid未获取到，重试获取
				if (! $access_token) {
					$this->openid_redirectnoAttention ();
				} else if (isset ( $_GET ['jump'] ) && $_GET ['jump'] != "") {
					// 跳转到纯净链接
					$url = $_GET ['jump'];
					header ( 'Location: ' . $url );
					exit ();
				}
			} else {
				$this->openid_redirectnoAttention (); // 跳转获取openid授权页面
			}
    	}
		if($_SERVER["HTTP_HOST"]!=C("bendiDomainName")){
			if(isset($data_store["openid"])&&$data_store["openid"]!=""&&$data_store["openid"]!=null){
				$openid=$data_store["openid"];
				 
				/* 	if(isset($_COOKIE["openid"])&&$_COOKIE["openid"]!=""&&$_COOKIE["openid"]!=null){
				 $openid=$_COOKIE["openid"];
				$unionid=$_COOKIE["unionid"]; */
				$weixin_user = $this->getUserInfoByOpenid($openid);
				$this->init_relation($openid, $weixin_user);
				//$this->init_adopt_user($openid);
			}
		}
    }
    /**
     * 初始化relation表数据
     */
    private function init_relation($openid,$weixin_user){
    	if($weixin_user["unionid"]){
	    	$unionid=$weixin_user["unionid"];
	    	// 查找用户信息
	    	$relation = getRelationByOpenid($openid);
	    	$relation_union=M('relation')->field(true)->where("relation_unionid='$unionid'")->find();
	    	$M = M("relation");
	    	// 有用户，更新
	    	if ($relation||$relation_union) {
	    		$relation_id=$relation?$relation[relation_id]:$relation_union[relation_id];
	    		$data[relation_img] = isset($weixin_user[headimgurl])&&$weixin_user[headimgurl]!=""?$weixin_user[headimgurl]:$relation[relation_img];//$weixin_user[nickname]
	    		$data[relation_nickname] = isset($weixin_user[nickname])&&$weixin_user[nickname]!=""?$weixin_user[nickname]:$relation[relation_nickname];
	    		$data[relation_province] = isset($weixin_user[province])&&$weixin_user[province]!=""?$weixin_user[province]:$relation[relation_province];
	    		$data[relation_city] = isset($weixin_user[city])&&$weixin_user[city]!=""?$weixin_user[city]:$relation[relation_city];
	    		$data[relation_openid] = $openid;
	    		if($unionid!=""){
	    			$data[relation_unionid] = $unionid;
	    		}
	    		$M->where("relation_id=$relation_id")->save($data);
	    		cookie("relation_id", $relation_id, 3600);
	    	} else {
	    		$data[relation_img] = $weixin_user[headimgurl];
	    		$data[relation_nickname] = $weixin_user[nickname];
	    		$data[relation_province] = $weixin_user[province];
	    		$data[relation_city] = $weixin_user[city];
	    		$data[relation_openid] = $openid;
	    		$data[relation_unionid] = $unionid!=""?$unionid:null;
	    		$M->add($data);
	    		$relation = getRelationByOpenid($openid);
	    		cookie("relation_id", $relation?$relation[relation_id]:"", 3600);
	    	}
    	}
    } 
    /**
     * 初始化relation表数据
     */
    private function init_adopt_user($openid){
    	$relation = getRelationByOpenid($openid);
    	if($relation){
    		$adopt_user=M('adopt_user')->where("relation_id=".$relation['relation_id'])->find();
    		if(!$adopt_user){
    			$adopt_user_data['relation_id']=$relation['relation_id'];
    			M('adopt_user')->add($adopt_user_data);
    		}
    	}
    }
    /**
     * 当一些页面需要得到微信用户的openid，可以直接调取这个方法
     *
     * @param unknown $code            
     * @return string mixed
     */
    public function newOpenId()
    {
/*         if($_SESSION['openid']=="oSRUAuMxLaQp6RQlsA0IHbtgk-ak"){
            session("openid",null);
        } */
    	$data_store=array();
    	if(C('data_store')=="cookie"){
    		$data_store=$_COOKIE;
    	}else{
    		$data_store=$_SESSION;    		
    	}
        if (! isset($data_store['openid'])||$data_store['openid']=="") {
        //if (! isset($_COOKIE['openid'])||$_COOKIE['openid']=="") {
        		 
           /*  //获取openid日志记录
           $log[code]=$_GET['code'];
            $log[time]=nowtime();
            $log[ip]=getRealIp();
            $r_url = "http://www.域名.com" . request_uri();
            $log[url]=$r_url;
            M('codetest_log')->add($log); */
            
            
            if (isset($_GET['code'])) {
                // 授权后跳转的时候，可以获取code。如果用户同意授权，页面将跳转至 redirect_uri/?code=CODE&state=STATE。若用户禁止授权，则重定向后不会带上code参数，仅会带上state参数redirect_uri?state=STATE
                // 当第一次授权登录后，将用户的access_token和refresh_token和openid和当前时间，存到session里
                $code = $_GET["code"];
            	$openid = $this->getOpenID($code); // 获取openid 
                //如果openid未获取到，重试获取  
                if(empty($openid)){
                    $this->openid_redirect();
                }else if(isset($_GET['jump'])&&$_GET['jump']!=""){
     				//跳转到纯净链接
     				$url=$_GET['jump'];
     				header('Location: ' . $url);
     				exit();
     			}
            } else {
                $this->openid_redirect(); // 跳转获取openid授权页面
            }
        }
        if($_SERVER["HTTP_HOST"]!=C("bendiDomainName")){
 	        if(isset($data_store["openid"])&&$data_store["openid"]!=""&&$data_store["openid"]!=null){
	            $openid=$data_store["openid"]; 
	            
        /* 	if(isset($_COOKIE["openid"])&&$_COOKIE["openid"]!=""&&$_COOKIE["openid"]!=null){
        		$openid=$_COOKIE["openid"];
	            $unionid=$_COOKIE["unionid"]; */
	            $weixin_user = $this->getUserInfoByOpenid($openid);
	            $unionid=$weixin_user["unionid"];
	            //cookie("unionid",$result->unionid, 3600);
	            session("unionid", $unionid);
	            cookie("unionid",$unionid, 3600);
	            // 查找用户信息
	            $relation = getRelationByOpenid($openid);
	            $relation_union=M('relation')->field(true)->where("relation_unionid='$unionid'")->find();
	            $M = M("relation");
	            // 有用户，更新
	            if ($relation||$relation_union) {
	            	$relation_id=$relation?$relation[relation_id]:$relation_union[relation_id];
	                $data[relation_img] = isset($weixin_user[headimgurl])&&$weixin_user[headimgurl]!=""?$weixin_user[headimgurl]:$relation[relation_img];//$weixin_user[nickname]
	                $data[relation_nickname] = isset($weixin_user[nickname])&&$weixin_user[nickname]!=""?$weixin_user[nickname]:$relation[relation_nickname];
	                $data[relation_province] = isset($weixin_user[province])&&$weixin_user[province]!=""?$weixin_user[province]:$relation[relation_province];
	                $data[relation_city] = isset($weixin_user[city])&&$weixin_user[city]!=""?$weixin_user[city]:$relation[relation_city];
	                $data[relation_openid] = $openid;
	                if($unionid!=""){
	                	$data[relation_unionid] = $unionid; 
	                }
	                $M->where("relation_id=$relation_id")->save($data);
	                cookie("relation_id", $relation_id, 3600);
	            } else {
	                $data[relation_img] = $weixin_user[headimgurl];
	                $data[relation_nickname] = $weixin_user[nickname];
	                $data[relation_province] = $weixin_user[province];
	                $data[relation_city] = $weixin_user[city];
	                $data[relation_openid] = $openid;
	                $data[relation_unionid] = $unionid!=""?$unionid:null;             
	                $M->add($data);
	                $relation = getRelationByOpenid($openid);
	                cookie("relation_id", $relation?$relation[relation_id]:"", 3600);
	            }          
	        }
        }
    }
    /**
     * 当一些页面需要得到微信用户的openid，可以直接调取这个方法
     *
     * @param unknown $code
     * @return string mixed
     */
    public function newOpenId2_bak()
    {
    	/*         if($_SESSION['openid']=="oSRUAuMxLaQp6RQlsA0IHbtgk-ak"){
    	 session("openid",null);
    	} */
    	
    	if (! isset($_SESSION['openid'])||$_SESSION['openid']=="") {
    
    		//获取openid日志记录
    		$log[code]=$_GET['code'];
    		$log[time]=nowtime();
    		$log[ip]=getRealIp();
    		$r_url = "http://www.域名.com" . request_uri();
    		$log[url]=$r_url;
    		M('codetest_log')->add($log);
    
    
    		if (isset($_GET['code'])) {
    			// 授权后跳转的时候，可以获取code。如果用户同意授权，页面将跳转至 redirect_uri/?code=CODE&state=STATE。若用户禁止授权，则重定向后不会带上code参数，仅会带上state参数redirect_uri?state=STATE
    			// 当第一次授权登录后，将用户的access_token和refresh_token和openid和当前时间，存到session里
    			$code = $_GET["code"];
    			$openid = $this->getOpenID($code); // 获取openid
    			//如果openid未获取到，重试获取
    			if(empty($openid)){
    				$this->openid_redirect2();
    			}else if(isset($_GET['jump'])&&$_GET['jump']!=""){
    				//跳转到纯净链接
    				$url=$_GET['jump'];
    				header('Location: ' . $url);
    			}
    		} else {
    			$this->openid_redirect2(); // 跳转获取openid授权页面
    		}
    	}
    	if(isset($_SESSION["openid"])&&$_SESSION["openid"]!=""&&$_SESSION["openid"]!=null){
    		$openid=$_SESSION["openid"];
    		$weixin_user = $this->getUserInfoByOpenid($openid);
    		// 查找用户信息
    		$relation = getRelationByOpenid($openid);
    		$M = M("relation");
    		// 有用户，更新
    		if ($relation) {
    			$data[relation_img] = isset($weixin_user[headimgurl])&&$weixin_user[headimgurl]!=""?$weixin_user[headimgurl]:$relation[relation_img];//$weixin_user[nickname]
    			$data[relation_nickname] = isset($weixin_user[nickname])&&$weixin_user[nickname]!=""?$weixin_user[nickname]:$relation[relation_nickname];
    			$M->where("relation_id=$relation[relation_id]")->save($data);
    		} else {
    			$data[relation_img] = $weixin_user[headimgurl];
    			$data[relation_nickname] = $weixin_user[nickname];
    			$data[relation_openid] = $openid;
    			$M->add($data);
    		}
    	}
    }
    /**
     * 第一步：用户同意授权，获取code
     * 应用范围：登录注册绑定用户，我的仓库，积分，下单
     * 获取openid跳转----snsapi_base
     * 应用授权作用域，snsapi_base （不弹出授权页面，直接跳转，只能获取用户openid），snsapi_userinfo （弹出授权页面，可通过openid拿到昵称、性别、所在地。并且，即使在未关注的情况下，只要用户授权，也能获取其信息）
     *
     * @param unknown $r_url
     */
    public function openid_redirect2()
    {
    	$r_url = "http://www.域名.com" . request_uri();
    	$url_arr = parse_url($r_url);
    	//判断是否有参数
    	if(isset($url_arr[query])&&$url_arr[query]!=""){
    		$r_url.="&jump=".urlencode($r_url);
    	}else{
    		$r_url.="?jump=".urlencode($r_url);
    	}
    	//  $r_url = "http://www.域名.com";
    	$url = "https://open.weixin.qq.com/connect/oauth2/authorize";
    	$url .= "?appid=$this->appId";
    	$url .= "&redirect_uri=".urlencode($r_url);
    	$url .= "&response_type=code&scope=snsapi_base&state=123#wechat_redirect";
    	//   echo $url;exit;
    	header('Location: ' . $url);
    	//redirect($url);
    }

    /**
     * 根据openid获取用户信息
     *
     * @author xd 20150727
     */
    public function getUserInfoByOpenid($openid)
    {
        $access_token=$this->readtoken();
        $infourl = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $access_token . "&openid=" . $openid . "&lang=zh_CN";
        $result = https_request($infourl);
        $utfresult = utf8_encode($result);
        $mm = json_decode($result, true);
        //token失效重新获取
        if($mm[errcode]=='42001'|| $mm[errcode]=='40001' || $mm[errcode]=='40014'){
        	$access_token = $this->readtoken(true);
        	$infourl = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=" . $access_token . "&openid=" . $openid . "&lang=zh_CN";
	        $result = https_request($infourl);
	        $utfresult = utf8_encode($result);
	        $mm = json_decode($result, true);
        }
        return $mm;
    }

    /**
     * 应用： 微信分享-第1步
     *
     * @return multitype:string NULL number unknown
     */
    public function getSignPackage()
    {
        $jsapiTicket = $this->getJsApiTicket();
        
        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol" . "www.域名.com" . "$_SERVER[REQUEST_URI]";
        
        $timestamp = time();
        $nonceStr = $this->createNonceStr();
        
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        
        $signature = sha1($string);
        
        $signPackage = array(
            "appId" => $this->appId,
            "nonceStr" => $nonceStr,
            "timestamp" => $timestamp,
            "url" => $url,
            "signature" => $signature,
            "rawString" => $string
        );

        return $signPackage;
    }

    /**
     * 功能：获取签名
     * 应用： 微信分享-第2步
     *
     * @return unknown
     */
    private function getJsApiTicket()
    {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        /* // 如果是企业号用以下 URL 获取 ticket
        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
        $res = json_decode(https_request($url));
        $ticket = $res->ticket; */
        
        $M_TOKEN = M('access_token');
        $token = $M_TOKEN->order('access_token_time desc')->find();
        $lasttime = strtotime($token['access_token_time']); // 在token这个表里，按照time列降序排序，取出time列的第一个值（即limit 1）
        $timenow = time(); // 生成现在的时间，时间戳
        // 如果现在的时间减去最后一次存储的时间戳，如果小于7100，则再次sql，获取已经存储到表的token，若不是，则新生成token，并存储到数据库
        if ($token && ($timenow - $lasttime < 5000)) {
            $ticket = $token['access_token_value'];
        } else {            
            $accessToken = $this->readtoken();
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res = json_decode(https_request($url));
            //token失效重新获取
            if($res->errcode=='42001' || $res->errcode=='40001' || $res->errcode=='40014'){
            	$accessToken = $this->readtoken(true);
            	$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            	$res = json_decode(https_request($url));
            }
            $ticket = $res->ticket;            
            
            $M_TOKEN = M('access_token');
            $data['access_token_time'] = nowtime();
            $data['access_token_value'] = $ticket;
            $M_TOKEN->add($data);
        }      
        
        return $ticket;
    }

    /**
     * 应用： 微信分享-第3步
     *
     * @return unknown
     */
    private function createNonceStr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i ++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
    /**
     * 用户取消关注
     * @param unknown $openid
     */
    public function userAttentionCancel($openid2){
        if($openid2!=""){
            // 查找用户信息
            $relation = getRelationByOpenid($openid2);
            $relation_id=$relation?$relation[relation_id]:"";
            // 查看是否有关注记录
            //$r = M("attention")->where("relation_id=$relation_id")->find();
            // 已关注更新数据
            $attention[attention_cancle_time] = nowtime();
            //$attention[relation_id]=$relation_id;
            $attention[attention_cancle] =2;
            // 添加关注记录
            $r_att = M("attention")->where("relation_id=$relation_id")->save($attention);
        }
    }
    /**
     * 用户关注
     * 参数$EventKey:二维码的场景值
     * @param unknown $openid
     */
    public function userAttention($openid2,$EventKey=''){
        
        
            if($openid2!=""){
            // 查找用户信息
            $relation = getRelationByOpenid($openid2);
            $weixin_user = $this->getUserInfoByOpenid($openid2);            
            $M = M("relation");
            // 没有用户，插入数据
            if (!$relation) {
                $data[relation_openid] = "$openid2";
                $data[relation_img] = $weixin_user[headimgurl];
                $data[relation_nickname] = $weixin_user[nickname];
                $data[relation_province] = $weixin_user[province];
                $data[relation_city] = $weixin_user[city];
                $relation_id = $M->add($data);
            } else {
                $relation_id=$relation[relation_id];
                $relation[relation_img] = $weixin_user[headimgurl];
                $relation[relation_nickname] = $weixin_user[nickname];
                $relation[relation_province] = $weixin_user[province];
                $relation[relation_city] = $weixin_user[city];
                $save_r = $M->where("relation_id=$relation_id")->save($relation);
            }
            
            // 查看是否有关注记录
            $r = M("attention")->where("relation_id=$relation_id")->find();
            // 未关注
            if ($r == false) {
                $attention[attention_time] = nowtime();
                $attention[relation_id]=$relation_id;
                $attention[attention_cancle] =1;
                // 添加关注记录
                $r_att = M("attention")->add($attention);
                // 赠送优惠券
                $M_USER_TICKET = M("user_ticket");
                $data_user_ticket[relation_id] = $relation_id;
                $data_user_ticket['user_ticket_value'] = 10; // 刮刮卡面值
                $data_user_ticket['user_ticket_max_money'] = 100; // 刮刮卡面值
                $data_user_ticket['user_ticket_begintime'] = date('Y-m-d  00:00:00', time()); // 最后一个人领奖时间
                $nowtime= nowtime(); // 最后一个人领奖时间
                $user_ticket_overtime=date("Y-m-d",strtotime("$nowtime+30day"));//优惠券在领到的15天后过期
                $data_user_ticket['user_ticket_overtime'] =$user_ticket_overtime; // 优惠券结束时间
                $data_user_ticket['user_ticket_num'] = uuid(); // 券号
                $data_user_ticket['user_ticket_time'] = nowtime(); // 优惠券获取时间
                $M_USER_TICKET->add($data_user_ticket); // 将中奖获得的代金券存到用户的代金券表中
                
               // 赠送鸡蛋
               $this->addeggs_getEggsOne($relation_id,$EventKey);//收鸡蛋第一窝活动，分享人加鸡蛋
              // $this->addeggs_winEggs($relation_id);//分享赢鸡蛋，分享人加鸡蛋
               // 插入鸡蛋记录-给关注人一个鸡蛋（只有通过分享这种方式，如A分享一个链接到朋友圈，B点击链接去关注剩蛋农场，A、B各得到一个鸡蛋，这里做的是B得到鸡蛋的操作）
               $this->addstore($relation_id,3,1);//给关注者加鸡蛋
               //$this->addgoods_christmas($relation_id);//圣诞拆礼包送礼品
               $this->add_landlord_connection($relation_id,$EventKey);//大地主活动-用户通过上下级关系增加记录
               //添加关注记录
               $this->add_attention_log($relation_id,$EventKey);
            }else{
                $attention[attention_cancle] =1;
                // 添加关注记录
                $r_att = M("attention")->where("relation_id=$relation_id")->save($attention);
            }
            //首次关注任务
            $api=A("Api");
            $user_id=isset($relation[user_id])?$relation[user_id]:"";
            $r=$api->doAttentionTask($relation_id,$user_id);
        }
    }
    /**
     * 新用户关注后，添加一条关注日志记录
     * @param unknown $relation_id
     */
    private function add_attention_log($relation_id,$EventKey=''){
    	$attention_log_data[relation_id]=$relation_id;
    	$attention_log_data[attention_log_key]=$EventKey;
    	$attention_log_data[attention_log_time]=nowtime();
    	M('attention_log')->add($attention_log_data);
    }
    /**
     * 新用户关注后，添加一条记录，老用户拉新用户的记录，分享者加鸡蛋
     * 大地主活动
     * @param unknown $relation_id
     */
    private function add_landlord_connection($relation_id,$EventKey=''){
        //通过扫带参数二维码关注
        if($EventKey){
            $active= substr($EventKey , 0 , 3);
            $qrcode_relation_id= substr($EventKey , 3);//通过扫描二维码，得到二维码中的$relation_id
            if($active=='100'){
            	//说明是争当大地主活动
                if($qrcode_relation_id!=$relation_id){
                    $data_landlord_connection[landlord_connection_old_relation_id]=	$qrcode_relation_id;
                    $data_landlord_connection[landlord_connection_new_relation_id]=$relation_id;
                    $data_landlord_connection[landlord_connection_new_attention_time]=nowtime();
                    M('landlord_connection')->add($data_landlord_connection);//添加老用户拉新用户记录
                    //在上下线关系总表添加记录
                    $this->add_connection_data($data_landlord_connection[landlord_connection_old_relation_id],$relation_id,4);//1：百万鸡蛋大放送 2剩蛋拆礼包 3：收蛋第一窝 4： 大地主
                    $this->addstore($qrcode_relation_id,16,1);//给分享人加鸡蛋
                    return;//防止当用户点击了链接，有通过长按二维码关注，   这时候走下边方法，这样在关系表了又加了一条记录               
                }
            }         
        }
        //通过点击链接关注
        // 查找分享来源
        $landlord_share = M("landlord_share")->where("landlord_share_new_relation_id='$relation_id'")->order("landlord_share_id DESC")->find();//以后点击为准
        if ($landlord_share) {
        
            $old_relation = $landlord_share[landlord_share_old_relation_id];
            $data_landlord_share['landlord_share_is_true'] = 1;
            M('landlord_share')->where("landlord_share_id=$landlord_share[landlord_share_id]")->save($data_landlord_share);//更新分享表
            $data_landlord_connection[landlord_connection_old_relation_id]=	$old_relation;
            $data_landlord_connection[landlord_connection_new_relation_id]=$relation_id;
            $data_landlord_connection[landlord_connection_new_attention_time]=nowtime();
            M('landlord_connection')->add($data_landlord_connection);//添加老用户拉新用户记录
            // 插入鸡蛋记录-给分享人一个鸡蛋
            $this->addstore($old_relation,16,1);//给分享人加鸡蛋
        //    return;
        }
    }

    /**
     * 圣诞拆礼包送礼品
     * @param unknown $relation_id
     */
    private function addgoods_christmas($relation_id){
        
        // 查找分享来源
        $christmas_share= M("christmas_share")->where("christmas_share_new_relation_id='$relation_id'")->order("christmas_share_id DESC")->find();//以先点击为准
        if ($christmas_share!=false) {        

            $old_relation_id = $christmas_share[christmas_share_old_relation_id];
            
                $attention_num_from_myself = M('')->query("SELECT count(*) num FROM christmas_share WHERE christmas_share_old_relation_id='$old_relation_id' and christmas_share_is_true=1");//已通过自己关注的人

                $relation = M("relation")->where("relation_id=$old_relation_id")->find();
                if($attention_num_from_myself[0]['num']*1>=6){

                    $christmas_person_prize= M("christmas_person_prize")->where("relation_id=$old_relation_id")->find();
                    if($christmas_person_prize==false){
                    	//领奖-看中什么奖
                        $M_CHRISTMAS_PRIZE = M('christmas_prize');
                        $prize_arr = $M_CHRISTMAS_PRIZE->where("christmas_prize_ratio!='0'")->select(); // 奖项
                        foreach ($prize_arr as $key => $val) {
                            $arr[$val['christmas_prize_id']] = $val['christmas_prize_ratio'];
                        }
                        $rid =get_rand($arr); // 根据概率获取奖项id
                        if((!$relation['user_id']) and $rid==1){
                            $rid=2;
                        }
                       // $prize_now = $M_CHRISTMAS_PRIZE->where("christmas_prize_id='$rid'")->find(); // 查看中奖的东西
                       $this->save_prize($rid,$old_relation_id,$relation['user_id']);
                    }
                    //$attention_num_left=7-$attention_num_from_myself['num']*1;//离7人关注差多少人
                    if($attention_num_from_myself[0]['num']==6){
                    	//当前人是第7人
                        $data[christmas_share_is_true]=1;
                    }else{
                        $data[christmas_share_is_true]=2;
                    }

                }else{
                    $data[christmas_share_is_true]=1;
                }
                M('christmas_share')->where("christmas_share_old_relation_id='$old_relation_id' and christmas_share_new_relation_id='$relation_id'")->save($data);
        }
    }
    private function save_prize($rid,$relation_id,$user_id){
        $data_christmas_person_prize['relation_id'] =$relation_id;
        $data_christmas_person_prize['christmas_prize_id'] =$rid;
        M('christmas_person_prize')->add($data_christmas_person_prize);     
        $christmas_prize=  M('christmas_prize')->where("christmas_prize_id='$rid'")->find(); // 查看中奖的东西
if ($christmas_prize[christmas_prize_type] == 3) {
            // 如果转盘的是实物
                $week_eggs_num = "";
                $guaguaka_prize_id_now_post=$christmas_prize[guaguaka_prize_id];
            $this->updatePrizeNumAndWareNumVip($relation_id, $christmas_prize[christmas_prize_value], $guaguaka_prize_id_now_post, $rid, $week_eggs_num);
        }  elseif ($christmas_prize[christmas_prize_type] == 5) {
            // 如果转盘的是余额
            $add_YuePrizeOrder = add_YuePrizeOrder($user_id, $christmas_prize[christmas_prize_value], "圣诞拆礼包10元");
            // $result_vip[money] = $add_YuePrizeOrder[money];
        }
    }


    // 创建菜单
       public function create_menu()
    {

            //$domainName=C("domainName");
           $domainName= 'http://lll.lkws.shop';

   $data = '{"button":[{"name":"商城","sub_button":[

   {"type":"view","name":"商城首页","url":"'.$domainName.'/index.php/Home/Index/index"}

   ]},


   {"name":"商品","sub_button":[
   {"type":"view","name":"商品列表","url":"'.$domainName.'/index.php/Home/Lu/login.html"},
   {"type":"view","name":"登录","url":"'.$domainName.'/index.php/Home/Lu/login.html"},
   {"type":"view","name":"注册","url":"'.$domainName.'/index.php/Home/Lu/register.html"}
   ]},

   {"name":"我的","sub_button":[
    {
                    "type": "pic_photo_or_album",
                    "name": "拍照或者相册发图",
                    "key": "rselfmenu_1_1",
                    "sub_button": [ ]
                },
   {"type":"view","name":"面部识别","url":"'.$domainName.'/index.php/Home/Lu/face.html"},
   {"type":"click","name":"讲笑话","key":"笑话"},
   {"type":"view","name":"颜值检测","url":"'.$domainName.'/index.php/Home/Lu/face.html"},
   ]}]}';

          $accessToken = $this->readtoken();// 获取access_token   987456123

         // $accessToken= "NgNRv6dsym8pmSQMS5CogMBHaZ7hBHIArGmrAXFNA8Dv6s4tDBDaP8VarCQit3xoB3adVEpO_-D39IXDUneDIdo-8aBNiyPGFKY97L9pNcZZEUj-K8ZGxTVpNRuvMxyNQCFbAIAVHK";
           $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $accessToken;
           //$res = https_request($url, $data);
           echo $res = https_request($url, $data);
           return json_decode($res, true);
       }

    /**
     * 获取带参数二维码ticket--被调取方法
     * expire_seconds 该二维码有效时间，以秒为单位。 最大不超过2592000（即30天），此字段如果不填，则默认有效期为30秒。 
     * 第二步
     * $is_id=1;--临时二维码。
     * $is_id=2;--永久二维码。 POST数据例子：{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 123}}}
     * $is_id=3;--永久二维码。 POST数据例子：使用以下POST数据创建字符串形式的二维码参数：{"action_name": "QR_LIMIT_STR_SCENE", "action_info": {"scene": {"scene_str": "123"}}}
     */
    public function getQrcodeTicket($scene_id,$is_id){
        if($is_id==1){
            $data ='{
             "expire_seconds":1800,
             "action_name": "QR_SCENE",
             "action_info": {
                "scene": {
                     "scene_id": '.$scene_id.'
                     }
                 }
              }';
        }elseif($is_id==2){
            $data = '{
            "action_name": "QR_LIMIT_SCENE",
             "action_info": {
             "scene": {
                     "scene_id": '.$scene_id.'
                     }
                 }
            }';
        }
        $accessToken = $this->readtoken();// 获取access_token
        $url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=$accessToken";
        $result=json_decode(https_request($url,$data));
        $ticket=$result->ticket;
        return $ticket;
    }
    public function geturl($scene_id,$is_id){//带参数二微码url
        $ticket=$this->getQrcodeTicket($scene_id,$is_id);//1 临时二微码 2 永久二微码
        $url="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($ticket);//urlencode()函数原理就是首先把中文字符转换为十六进制，然后在每个字符前面加一个标识符%。urldecode()函数与urlencode()函数原理相反，用于解码已编码的 URL 字符串，其原理就是把十六进制字符串转换为中文字符
        return $url;
    }
    
    /**
     * 下载二维码并保存到Upload/qrcode/目录下
     * @param unknown $url
     * @param unknown $scene_id
     */
    public function downQrcode($url,$scene_id){   	 
    	$imageInfo = $this->downloadImageFromWeiXin($url);   	 
    	$filename = DOC_ROOT."/Upload/qrcode/qrcode".$scene_id.".jpg";
    	$local_file = fopen($filename, 'w');
    	if (false !== $local_file){
    		if (false !== fwrite($local_file, $imageInfo["body"])) {
    			fclose($local_file);
    		}
    	}
    	return $filename; 	 
    }
    /**
     * 下载http图片到本地
     * @param unknown $url
     * @return multitype:
     */
    private function downloadImageFromWeiXin($url)
    {
    	$ch = curl_init($url);
    	curl_setopt($ch, CURLOPT_HEADER, 0);
    	curl_setopt($ch, CURLOPT_NOBODY, 0);    //只取body头
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	$package = curl_exec($ch);
    	$httpinfo = curl_getinfo($ch);
    	curl_close($ch);
    	return array_merge(array('body' => $package), array('header' => $httpinfo));
    }
    /**
     * 上传图片到微信服务器并返回media_id
     * @param unknown $filepath
     * @param string $object
     * @return Ambigous <\Weixin\Controller\mixed, mixed, string>
     */
    public function upload($filepath,$object=""){
    	$token=$this->readtoken();
    	if (class_exists ( '\CURLFile' )) {//关键是判断curlfile,官网推荐php5.5或更高的版本使用curlfile来实例文件
    		$filedata = array (
    	'fieldname' => new \CURLFile ( realpath ( $filepath ), 'image/jpeg' )
    		);
    	} else {
    		$filedata = array (
    	'fieldname' => '@' . realpath ( $filepath )
    		);
    	}
    	$url = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token=" . $token . "&type=image";
    	$result = $this->http_request_version( $url, $filedata );//调用upload函数
    	if (isset ( $result )) {
    		$data = json_decode ( $result );    		
    		if (isset ( $data->media_id )) {
    			//$result=$data->media_id;
     	$result=$this->transmitImage($object,$data->media_id );//这是我自己封装的返回消息函数
    		} else {
    			//$result="";
     	$result=$this->transmitText($object, "not set media_id" );//这是我自己封装的返回消息函数
    		}
    	} else {
    		//$result="";
     	$result=$this->transmitText($object, "no response" );//这是我自己封装的返回消息函数
    	}
    	return $result;
    }
    /**
     * 多版本http请求方法
     * @param unknown $url
     * @param unknown $filedata
     * @return mixed
     */
    private function http_request_version($url, $filedata) {
    	$curl = curl_init ();
    	if (class_exists ( '/CURLFile' )) {//php5.5跟php5.6中的CURLOPT_SAFE_UPLOAD的默认值不同
    		curl_setopt ( $curl, CURLOPT_SAFE_UPLOAD, true );
    	} else {
    		if (defined ( 'CURLOPT_SAFE_UPLOAD' )) {
    			curl_setopt ( $curl, CURLOPT_SAFE_UPLOAD, false );
    		}
    	}
    	curl_setopt ( $curl, CURLOPT_URL, $url );
    	curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
    	curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, FALSE );
    	if (! empty ( $filedata )) {
    		curl_setopt ( $curl, CURLOPT_POST, 1 );
    		curl_setopt ( $curl, CURLOPT_POSTFIELDS, $filedata );
    	}
    	curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
    	$output = curl_exec ( $curl );
    	curl_close ( $curl );
    	return $output;
    
    }
    /**
     * 发送文本消息(多客服)
     */
    public function setTextMessage($openid,$content){
    	$token=$this->readtoken();
    	$data='{
		    "touser":"'.$openid.'",
		    "msgtype":"text",
		    "text":
		    {
		         "content":"'.$content.'"
		    }
		}';
    	$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=$token";
    	$result = https_request($url, $data);
    }
    /**
     * 发送媒体消息(多客服)
     */
    public function setMediaMessage($openid,$msgtype,$media_id){
    	$token=$this->readtoken();
    	$data='{
		    "touser":"'.$openid.'",
		    "msgtype":"'.$msgtype.'",
		    "'.$msgtype.'":
		    {
		         "media_id":"'.$media_id.'"
		    }
		}';
    	$url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=$token";
    	$result = https_request($url, $data);
    }
}