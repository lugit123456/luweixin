<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <!--<script src="/Public/assets/plugins/jquery/jquery-1.8.3.min.js"></script>-->
</head>
<body>
<!--<form action="<?php echo U('Home/Lu/face');?>" method="POST" enctype="multipart/form-data" role="form">-->
    <form action="<?php echo U('Home/Lu/face1');?>" method="post" enctype="multipart/form-data">
<input type="file" name="file" id="file" title="上传图片" onchange="getPhoto(this)" value="点击上传照片" style="height: 100px;width: 250px;background-color:#008db2;">
        <div class="ge_pic_icon_Infor">
            <img src="images/moren.jpg"/>
        </div>
<input type="submit" id="submit" value="开始检测"  style="height: 200px;width: 550px;background-color:springgreen;">
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
</body>
</html>