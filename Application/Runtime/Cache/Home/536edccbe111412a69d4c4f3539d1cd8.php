<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body>
<div id="status" style="font-size: 80px;color: red">你摇了0次，加油啊！！！</div>

</body>
    <script>
    var shake=4000,
            last_update=0,
            count=0,
            x=y=z=last_x=last_y=last_z=0;
    if(window.DeviceMotionEvent){
        window.addEventListener("devicemotion",deviceMotionHandler,false);
    }else{
        alert("本设备不支持devicemotion事件");
    }
    console.log(new Date().valueOf());
    function deviceMotionHandler(eventData){
        var acceleration = eventData.accelerationIncludingGravity,
                currTime=new Date().valueOf(),
                diffTime=currTime-last_update;

        if(diffTime>100){
            last_update=currTime;
            x=acceleration.x;
            y=acceleration.y;
            z=acceleration.z;
            var speed=Math.abs(x+y+z-last_x-last_y-last_z)/diffTime*10000//数值越大，摇的越多
            var status=document.getElementById("status");
            if(speed>shake){
                count++;
                status.innerHTML = "你已经摇了"+count+"次，加油啊！！！" ;
            }
            last_x = x;
            last_y = y;
            last_z = z;
        }
    }
</script>
</html>