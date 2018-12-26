<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <!--<script src="/Public/assets/plugins/jquery/jquery-1.8.3.min.js"></script>-->
</head>
<body>
<!--<form action="<?php echo U('Home/Lu/face');?>" method="POST" enctype="multipart/form-data" role="form">-->
<form action="<?php echo U('Home/Lu/twoface');?>" method="post" enctype="multipart/form-data">
    <input type="file" name="file" id="file" title="上传图片" onchange="getPhoto(this)"  style="height: 100px;width: 250px;background-color:#008db2;" value="选择照片进行识别"/>
    <div class="ge_pic_icon_Infor">
        <img src="images/moren.jpg"/>
    </div>
    <input type="submit" id="submit" value="开始识别"  style="height: 100px;width: 550px;background-color:#008db2;">
</form>
<script type="text/javascript" src="/Public/home/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
    var imgurl = "";
    function getPhoto(node) {
        var imgURL = "";
        try{
            var file = null;
            if(node.files && node.files[0] ){
                file = node.files[0];
            }else if(node.files && node.files.item(0)) {
                file = node.files.item(0);
            }
            //Firefox 因安全性问题已无法直接通过input[file].value 获取完整的文件路径
            try{
                imgURL =  file.getAsDataURL();
            }catch(e){
                imgRUL = window.URL.createObjectURL(file);
            }
        }catch(e){
            if (node.files && node.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    imgURL = e.target.result;
                };
                reader.readAsDataURL(node.files[0]);
            }
        }
        creatImg(imgRUL);
        return imgURL;
    }

    function creatImg(imgRUL){
        var textHtml = "<img src='"+imgRUL+"'width='30%' height='30%'/>";
        $(".ge_pic_icon_Infor").html(textHtml);
    }
</script>
<br><br><br>
<div class="Sharing">
    <div class="bdsharebuttonbox bdshare-button-style0-16" data-bd-bind="1441079683326"><a href="#" class="bds_more" data-cmd="more">分享到：</a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>
    <script>
        window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{"bdSize":16},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"16"},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
    </script>
</div>
</body>
</html>