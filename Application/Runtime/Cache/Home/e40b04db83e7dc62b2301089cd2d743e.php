<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="zh-cn"> <!--<![endif]-->
<head>
    
        <title>商品详情</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="/Public/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/assets/css/shop.style.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="/Public/assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="/Public/assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Public/assets/plugins/scrollbar/src/perfect-scrollbar.css">
    <link rel="stylesheet" href="/Public/assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="/Public/assets/plugins/sky-forms/version-2.0.1/css/custom-sky-forms.css">
    <link rel="stylesheet" href="/Public/assets/plugins/master-slider/quick-start/masterslider/style/masterslider.css">
    <link rel='stylesheet' href="/Public/assets/plugins/master-slider/quick-start/masterslider/skins/default/style.css">

    <!-- Style Switcher -->
    <link rel="stylesheet" href="/Public/assets/css/plugins/style-switcher.css">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="/Public/assets/css/theme-colors/default.css" id="style_color">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="/Public/assets/css/custom.css">
    
</head>

<body class="header-fixed">

<div class="wrapper">
    <!-- 头部模块 v5 -->
    <div class="header-v5 header-static">
        <!-- Topbar模块 v3 -->
        <div class="topbar-v3">
            <div class="search-open">
                <div class="container">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="search-close"><i class="icon-close"></i></div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <!-- Topbar 导航模块 -->
                        <ul class="left-topbar">
                            <li>
                                <a>货币 (人民币)</a>
                                <ul class="currency">
                                    <li class="active">
                                        <a href="#">人民币 <i class="fa fa-check"></i></a>
                                    </li>
                                    <li><a href="#">美元</a></li>
                                    <li><a href="#">欧元</a></li>
                                </ul>
                            </li>
                            <li>
                                <a>语言 (中文)</a>
                                <ul class="language">
                                    <li class="active">
                                        <a href="#">中文<i class="fa fa-check"></i></a>
                                    </li>
                                    <li><a href="#">英语</a></li>
                                    <li><a href="#">日语</a></li>
                                    <li><a href="#">韩语</a></li>
                                </ul>
                            </li>
                        </ul><!--/end left-topbar-->
                    </div>
                    <div class="col-sm-6">
                        <ul class="list-inline right-topbar pull-right">
                            <li><a href="#">账户</a></li>
                            <li><a href="shop-ui-add-to-cart.html">购物车 (0)</a></li>
                            <li><a href="/index.php/Home/Lu/login.html">登录</a> | <a href="/index.php/Home/Lu/register.html">注册</a></li>
                            <li><i class="search fa fa-search search-button"></i></li>
                        </ul>
                    </div>
                </div>
            </div><!--/container-->
        </div>
        <!-- End Topbar模块 v3 -->

        <!-- 主导航模块 -->
        <div class="navbar navbar-default mega-menu" role="navigation">
            <div class="container">
                <!-- 为移动端匹配品牌和切换分组 -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">切换导航</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">
                        <img id="logo-header" src="/Public/assets/img/logo.png" alt="Logo">
                    </a>
                </div>

                <!-- 集合导航链接，表单和其他内容进行切换 -->
                <div class="collapse navbar-collapse navbar-responsive-collapse">
                    <!-- Badge -->
                    <ul class="list-inline shop-badge badge-lists badge-icons pull-right">
                        <li>
                            <a href="#"><i class="fa fa-shopping-cart"></i></a>
                            <span class="badge badge-sea rounded-x">3</span>
                            <ul id="scrollbar" class="list-unstyled badge-open contentHolder">
                                <li>
                                    <img src="/Public/assets/img/thumb/01.jpg" alt="">
                                    <button type="button" class="close">×</button>
                                    <div class="overflow-h">
                                        <span>Black Glasses</span>
                                        <small>1 x $400.00</small>
                                    </div>
                                </li>
                                <li>
                                    <img src="/Public/assets/img/thumb/02.jpg" alt="">
                                    <button type="button" class="close">×</button>
                                    <div class="overflow-h">
                                        <span>Black Glasses</span>
                                        <small>1 x $400.00</small>
                                    </div>
                                </li>
                                <li>
                                    <img src="/Public/assets/img/thumb/03.jpg" alt="">
                                    <button type="button" class="close">×</button>
                                    <div class="overflow-h">
                                        <span>Black Glasses</span>
                                        <small>1 x $400.00</small>
                                    </div>
                                </li>
                                <li class="subtotal">
                                    <div class="overflow-h margin-bottom-10">
                                        <span>Subtotal</span>
                                        <span class="pull-right subtotal-cost">$1200.00</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <a href="shop-ui-inner.html" class="btn-u btn-brd btn-brd-hover btn-u-sea-shop btn-block">View Cart</a>
                                        </div>
                                        <div class="col-xs-6">
                                            <a href="shop-ui-add-to-cart.html" class="btn-u btn-u-sea-shop btn-block">Checkout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- End Badge -->

                    <ul class="nav navbar-nav">
                        <!-- Pages -->
                        <li class="dropdown active">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                                欢迎语
                            </a>
                            <ul class="dropdown-menu">

                                <li><a>*<strong>欢迎进入手机端商城</strong></a></li>
                                <li><a>*<strong>你将体验到不一样的购物模式</strong></a></li>
                                <li><a>*<strong>祝你购物愉快</strong></a></li>
                                <li><a>*<strong>欢迎下次再来</strong></a></li>
                            </ul>
                        </li>
                        <!-- End Pages -->

                        <!-- Promotion -->
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                                列表购物
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a href="javascript:void(0);">服装</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">夹克</a></li>
                                        <li><a href="#">牛仔裤</a></li>
                                        <li><a href="#">卫衣</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="javascript:void(0);">鞋帽</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">皮鞋</a></li>
                                        <li><a href="#">凉鞋</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <!-- End Promotion -->

                        <!-- Gifts -->
                        <li class="dropdown mega-menu-fullwidth">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                                礼物
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="mega-menu-content">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-3 col-sm-12 col-xs-12 md-margin-bottom-30">
                                                    <h3 class="mega-menu-heading">情人节礼物</h3>
                                                    <p>情人节礼物...</p>
                                                    <button type="button" class="btn-u btn-u-dark">更多</button>
                                                </div>
                                                <div class="col-md-3 col-sm-4 col-xs-4 md-margin-bottom-30">
                                                    <a href="#"><img class="product-offers img-responsive" src="/Public/assets/img/blog/01.jpg" alt=""></a>
                                                </div>
                                                <div class="col-md-3 col-sm-4 col-xs-4 sm-margin-bottom-30">
                                                    <a href="#"><img class="product-offers img-responsive" src="/Public/assets/img/blog/02.jpg" alt=""></a>
                                                </div>
                                                <div class="col-md-3 col-sm-4 col-xs-4">
                                                    <a href="#"><img class="product-offers img-responsive" src="/Public/assets/img/blog/03.jpg" alt=""></a>
                                                </div>
                                            </div><!--/end row-->
                                        </div><!--/end container-->
                                    </div><!--/end mega menu content-->
                                </li>
                            </ul><!--/end dropdown-menu-->
                        </li>
                        <!-- End Gifts -->
                        <!-- Main Demo -->
                        <li><a href="../index.html">关于我们</a></li>
                        <!-- Main Demo -->
                    </ul>
                </div><!--/navbar-collapse-->
            </div>
        </div>
        <!-- End 主导航模块 -->
    </div>
    <!-- End 头部模块 v5 -->
















    

    <!--=== End Header v5 ===-->

    <!--=== Shop Product ===-->
    <div class="shop-product">
        <!-- Breadcrumbs v5 -->
        <div class="container">
            <ul class="breadcrumb-v5">
                <li><a href="index.html"><i class="fa fa-home"></i></a></li>
                <li><a href="#">Products</a></li>
                <li class="active">New</li>
            </ul>
        </div>
        <!-- End Breadcrumbs v5 -->

        <div class="container">
            <div class="row">
                <div class="col-md-6 md-margin-bottom-50">
                    <div class="ms-showcase2-template">
                        <!-- Master Slider -->
                        <div class="master-slider ms-skin-default" id="masterslider">
                            <div class="ms-slide">
                                <img class="ms-brd" src="/Public/assets/img/blank.gif" data-src="/Public/assets/upload/<?php echo ($goods['pic']); ?>" alt="lorem ipsum dolor sit">
                                <img class="ms-thumb" src="/Public/assets/upload/<?php echo ($goods['pic']); ?>" alt="thumb">
                            </div>
                            <?php if(is_array($pic)): foreach($pic as $key=>$v): ?><div class="ms-slide">
                                <img src="/Public/assets/img/blank.gif" data-src="/Public/assets/upload/<?php echo ($v['picname']); ?>" alt="lorem ipsum dolor sit">
                                <img class="ms-thumb" src="/Public/assets/upload/<?php echo ($v['picname']); ?>" alt="thumb">
                            </div><?php endforeach; endif; ?>
                        </div>
                        <!-- End Master Slider -->
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="shop-product-heading">
                        <h2><?php echo ($goods['goodsname']); ?></h2>
                        <ul class="list-inline shop-product-social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div><!--/end shop product social-->

                    <ul class="list-inline product-ratings margin-bottom-30">
                        <li><i class="rating-selected fa fa-star"></i></li>
                        <li><i class="rating-selected fa fa-star"></i></li>
                        <li><i class="rating-selected fa fa-star"></i></li>
                        <li><i class="rating fa fa-star"></i></li>
                        <li><i class="rating fa fa-star"></i></li>
                        <li class="product-review-list">
                            <span>(1) <a href="#">Review</a> | <a href="#"> Add Review</a></span>
                        </li>
                    </ul><!--/end shop product ratings-->

                    <p><?php echo ($goods['detail']); ?></p><br>

                    <ul class="list-inline shop-product-prices margin-bottom-30">
                        <li class="shop-red">$<?php echo ($goods['price']); ?></li>
                        <li class="line-through">$<?php echo ($goods['marketprice']); ?></li>
                        <li><small class="shop-bg-red time-day-left">4 days left</small></li>
                    </ul><!--/end shop product prices-->

                    <h3 class="shop-product-title">尺寸</h3>
                    <ul class="list-inline product-size margin-bottom-30">
                        <li>
                            <input type="radio" id="size-1" name="size">
                            <label for="size-1">S</label>
                        </li>
                        <li>
                            <input type="radio" id="size-2" name="size">
                            <label for="size-2">M</label>
                        </li>
                        <li>
                            <input type="radio" id="size-3" name="size" checked>
                            <label for="size-3">L</label>
                        </li>
                        <li>
                            <input type="radio" id="size-4" name="size">
                            <label for="size-4">XL</label>
                        </li>
                    </ul><!--/end product size-->

                    <h3 class="shop-product-title">颜色</h3>
                    <ul class="list-inline product-color margin-bottom-30">
                        <li>
                            <input type="radio" id="color-1" name="color">
                            <label class="color-one" for="color-1"></label>
                        </li>
                        <li>
                            <input type="radio" id="color-2" name="color" checked>
                            <label class="color-two" for="color-2"></label>
                        </li>
                        <li>
                            <input type="radio" id="color-3" name="color">
                            <label class="color-three" for="color-3"></label>
                        </li>
                    </ul><!--/end product color-->

                    <h3 class="shop-product-title">数量</h3>
                    <div class="margin-bottom-40">
                        <form name="f1" method="post" action="<?php echo U('Home/Windex/Cartlst');?>?id=<?php echo ($v['id']); ?>" class="product-quantity sm-margin-bottom-20">
                            <button type='button' class="quantity-button" name='subtract' onclick='javascript: subtractQty();' value='-'>-</button>
                            <input type='text' class="quantity-field" name='buynum' value="1" id='qty'/>
                            <button type='button' class="quantity-button" name='add' onclick='javascript: document.getElementById("qty").value++;' value='+'>+</button>
                            <input type="submit" class="btn-u btn-u-sea-shop btn-u-lg" value="Add to Cart"/>
                        </form>
                    </div><!--/end product quantity-->

                    <ul class="list-inline add-to-wishlist add-to-wishlist-brd">
                        <li class="wishlist-in">
                            <i class="fa fa-heart"></i>
                            <a href="#">Add to Wishlist</a>
                        </li>
                        <li class="compare-in">
                            <i class="fa fa-exchange"></i>
                            <a href="#">Add to Compare</a>
                        </li>
                    </ul>
                    <p class="wishlist-category"><strong>Categories:</strong> <a href="#">Clothing,</a> <a href="#">Shoes</a></p>
                </div>
            </div><!--/end row-->
        </div>
    </div>
    <div class="content-md container">
    </div>
    <div class="container">
        <div class="heading heading-v1 margin-bottom-20">
            <h2>你可能喜欢的商品</h2>
        </div>
        <div class="illustration-v2 margin-bottom-60">
            <div class="customNavigation margin-bottom-25">
                <a class="owl-btn prev rounded-x"><i class="fa fa-angle-left"></i></a>
                <a class="owl-btn next rounded-x"><i class="fa fa-angle-right"></i></a>
            </div>

            <ul class="list-inline owl-slider-v4">
                <?php if(is_array($allgoods)): foreach($allgoods as $key=>$v): ?><li class="item">
                    <a href="#"><img class="img-responsive" src="/Public/assets/upload/<?php echo ($v['pic']); ?>" alt=""></a>
                    <div class="product-description-v2">
                        <div class="margin-bottom-5">
                            <h4 class="title-price"><a href="#"><?php echo ($v['goodsname']); ?></a></h4>
                            <span class="title-price">$<?php echo ($v['price']); ?></span>
                        </div>
                        <ul class="list-inline product-ratings">
                            <li><i class="rating-selected fa fa-star"></i></li>
                            <li><i class="rating-selected fa fa-star"></i></li>
                            <li><i class="rating-selected fa fa-star"></i></li>
                            <li><i class="rating fa fa-star"></i></li>
                            <li><i class="rating fa fa-star"></i></li>
                        </ul>
                    </div>
                </li><?php endforeach; endif; ?>
            </ul>
        </div>
    </div>
    <!--=== End Illustration v2 ===-->

    <!--=== Shop Suvbscribe ===-->




















    <!-- 商品订阅模块 -->
    <div class="shop-subscribe">
        <div class="container">
            <div class="row">
                <div class="col-md-8 md-margin-bottom-20">
                    <h2>订阅我们每周<strong>通讯</strong></h2>
                </div>
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="输入你的Email地址">
                        <span class="input-group-btn">
                            <button class="btn" type="button"><i class="fa fa-envelope-o"></i></button>
                        </span>
                    </div>
                </div>
            </div>
        </div><!--/end container-->
    </div>
    <!-- End 商品订阅模块 -->

    <!-- Footer模块 v4 -->
    <div class="footer-v4">
        <div class="footer">
            <div class="container">
                <div class="row">
                    <!-- 关于我们模块 -->
                    <div class="col-md-4 md-margin-bottom-40">
                        <a href="index.html"><img class="footer-logo" src="/Public/assets/img/logo-2.png" alt=""></a>
                        <p>京东致力于成为一家为社会创造最大价值的公司。经过13年砥砺前行，京东在商业领域一次又一次突破创新，取得了跨越式发展。</p>
                        <br>
                        <ul class="list-unstyled address-list margin-bottom-20">
                            <li><i class="fa fa-angle-right"></i>美国加州圣地亚哥金坷垃市</li>
                            <li><i class="fa fa-angle-right"></i>电话: 800 123 3456</li>
                            <li><i class="fa fa-angle-right"></i>传真: 800 123 3456</li>
                            <li><i class="fa fa-angle-right"></i>Email: info@aaa.com</li>
                        </ul>
                        <!--社会化分享按钮组件-->
                        <ul class="list-inline shop-social jiathis_style_24x24">
                            <li><a class="jiathis_button_weixin"></a></li>
                            <li><a class="jiathis_button_qzone"></a></li>
                            <li><a class="jiathis_button_tsina"></a></li>
                            <li><a class="jiathis_button_tqq"></a></li>
                            <li><a class="jiathis_button_renren"></a></li>
                        </ul>
                        <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
                        <!--End 社会化分享按钮组件-->
                    </div>
                    <!-- End 关于我们模块 -->

                    <!-- 帮助中心模块列表 -->
                    <div style="float: left">
                        <h1>欢迎下次光临！</h1>
                        <h2>欢迎下次光临！</h2>
                        <h3>欢迎下次光临！</h3>
                        <h4>欢迎下次光临！</h4>
                        <h5>欢迎下次光临！</h5>
                        <h6>欢迎下次光临！</h6>
                    </div>
                    <div style="float: right">
                        <h1>欢迎下次光临！</h1>
                        <h2>欢迎下次光临！</h2>
                        <h3>欢迎下次光临！</h3>
                        <h4>欢迎下次光临！</h4>
                        <h5>欢迎下次光临！</h5>
                        <h6>欢迎下次光临！</h6>
                </div>
            </div><!--/end continer-->
        </div><!--/footer-->

        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p>
                            Copyright © 2004 - 2017  京西JC.com 版权所有
                            <a target="_blank" href="#">Jarvis</a> | <a href="#">隐私政策</a> | <a href="#">服务条款</a>
                        </p>
                    </div>
                    <!--<div class="col-md-6">  
                        <ul class="list-inline sponsors-icons pull-right">
                            <li><i class="fa fa-cc-paypal"></i></li>
                            <li><i class="fa fa-cc-visa"></i></li>
                            <li><i class="fa fa-cc-mastercard"></i></li>
                            <li><i class="fa fa-cc-discover"></i></li>
                        </ul>
                    </div>-->
                </div>
            </div>
        </div><!--/copyright-->
    </div>
    <!-- End Footer模块 v4 -->
</div><!--/wrapper-->
 <!-- js部分-->
    <!-- JS 全局必须调用 -->















<!-- JS Global Compulsory -->
<script src="/Public/assets/plugins/jquery/jquery.min.js"></script>
<script src="/Public/assets/plugins/jquery/jquery-migrate.min.js"></script>
<script src="/Public/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- JS Implementing Plugins -->
<script src="/Public/assets/plugins/back-to-top.js"></script>
<script src="/Public/assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
<!-- Master Slider -->
<script src="/Public/assets/plugins/master-slider/quick-start/masterslider/masterslider.min.js"></script>
<script src="/Public/assets/plugins/master-slider/quick-start/masterslider/jquery.easing.min.js"></script>
<!-- Scrollbar -->
<script src="/Public/assets/plugins/scrollbar/src/jquery.mousewheel.js"></script>
<script src="/Public/assets/plugins/scrollbar/src/perfect-scrollbar.js"></script>
<!-- JS Customization -->
<script src="/Public/assets/js/custom.js"></script>
<!-- JS Page Level -->
<script src="/Public/assets/js/shop.app.js"></script>
<script src="/Public/assets/js/plugins/owl-carousel.js"></script>
<script src="/Public/assets/js/plugins/master-slider.js"></script>
<script src="/Public/assets/js/forms/product-quantity.js"></script>
<script type="text/javascript" src="/Public/assets/js/plugins/style-switcher.js"></script>
<script>
    jQuery(document).ready(function() {
        App.init();
        OwlCarousel.initOwlCarousel();
        MasterSliderShowcase2.initMasterSliderShowcase2();
        StyleSwitcher.initStyleSwitcher();
    });
</script>

<!--[if lt IE 9]>
<script src="/Public/assets/plugins/respond.js"></script>
<script src="/Public/assets/plugins/html5shiv.js"></script>
<script src="/Public/assets/js/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->


















    <!--[if lt IE 9]>
    <script src="/Public/assets/plugins/respond.js"></script>
    <script src="/Public/assets/plugins/html5shiv.js"></script>
    <script src="/Public/assets/js/plugins/placeholder-IE-fixes.js"></script>
    <![endif]-->
    <!--Respond.js让IE6-8支持CSS3 Media Query
    html5shiv.js让IE6、IE7、IE8支持html5
    placeholder-IE-fixes.js让IE支持placeholder属性-->




</body>
</html>