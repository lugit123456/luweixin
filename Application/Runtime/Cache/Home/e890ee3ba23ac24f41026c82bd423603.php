<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>注册</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="/Public/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Public/assets/css/shop.style.css">
     
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="/Public/assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="/Public/assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/Public/assets/plugins/scrollbar/src/perfect-scrollbar.css">
    <!-- <link rel="stylesheet" href="/Public/assets/plugins/sky-forms/version-2.0.1/css/sky-forms.css"> -->
    <link rel="stylesheet" href="/Public/assets/css/pages/log-reg-v3.css">
    
    <!-- Style Switcher -->
    <link rel="stylesheet" href="/Public/assets/css/plugins/style-switcher.css">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="/Public/assets/css/theme-colors/default.css" id="style_color">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="/Public/assets/css/custom.css">
</head>

<body class="header-fixed">
<?php if(isset($alert)): ?><script>
            alert("<?php echo ($alert); ?>");
        </script><?php endif; ?>
<!--=== Style Switcher ===-->
<i class="style-switcher-btn fa fa-cogs hidden-xs"></i>
<div class="style-switcher animated fadeInRight">
    <div class="style-swticher-header">
        <div class="style-switcher-heading">Style Switcher</div>
        <div class="theme-close"><i class="icon-close"></i></div>
    </div>

    <div class="style-swticher-body">
        <!-- Theme Colors -->
        <div class="style-switcher-heading">Theme Colors</div>
        <ul class="list-unstyled">
            <li class="theme-default" data-style="green"></li>
            <li class="theme-blue" data-style="blue"></li>
            <li class="theme-orange" data-style="orange"></li>
            <li class="theme-red" data-style="red"></li>
            <li class="theme-light" data-style="light"></li>
            <li class="theme-purple last" data-style="purple"></li>
            <li class="theme-aqua" data-style="aqua"></li>
            <li class="theme-brown" data-style="brown"></li>
            <li class="theme-dark-blue" data-style="dark-blue"></li>
            <li class="theme-light-green" data-style="light-green"></li>
            <li class="theme-dark-red" data-style="dark-red"></li>
            <li class="theme-teal last theme-active" data-style="default"></li>
        </ul>

        <!-- Theme Type -->
        <div class="style-switcher-heading">Theme Type</div>
        <div class="row no-col-space">
            <div class="col-xs-6">
                <a href="../index.html" class="btn-u btn-u-xs btn-u-dark btn-block">Main Demo</a>
            </div>
            <div class="col-xs-6">
                <a href="../One-Page/index.html" class="btn-u btn-u-xs btn-u-dark btn-block">One Page</a>
            </div>
        </div>
    </div>
</div><!--/style-switcher-->
<!--=== End Style Switcher ===-->
 
<div class="wrapper">
    <!--=== Header v5 ===-->   
    <div class="header-v5 header-static">
        <!-- Topbar v3 -->
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
                        <!-- Topbar Navigation -->
                        <ul class="left-topbar">
                            <li>
                                <a>Currency (USD)</a>
                                <ul class="currency">
                                    <li class="active">
                                        <a href="#">USD <i class="fa fa-check"></i></a>
                                    </li>
                                    <li><a href="#">Euro</a></li>
                                    <li><a href="#">Pound</a></li>
                                </ul>
                            </li>
                            <li>
                                <a>Language (EN)</a>
                                <ul class="language">
                                    <li class="active">
                                        <a href="#">English (EN)<i class="fa fa-check"></i></a>
                                    </li>
                                    <li><a href="#">Spanish (SPN)</a></li>
                                    <li><a href="#">Russian (RUS)</a></li>
                                    <li><a href="#">German (GRM)</a></li>
                                </ul>
                            </li>
                        </ul><!--/end left-topbar-->
                    </div>
                    <div class="col-sm-6">
                        <ul class="list-inline right-topbar pull-right">
                            <li><a href="#">Account</a></li>
                            <li><a href="shop-ui-add-to-cart.html">Wishlist (0)</a></li>
                            <li><a href="shop-ui-login.html">Login</a> | <a href="shop-ui-register.html">Register</a></li>
                            <li><i class="search fa fa-search search-button"></i></li>
                        </ul>
                    </div>
                </div>
            </div><!--/container-->
        </div>
        <!-- End Topbar v3 -->

        <!-- Navbar -->
        <div class="navbar navbar-default mega-menu" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">
                        <img id="logo-header" src="/Public/assets/img/logo.png" alt="Logo">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
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
                                Pages
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="index.html">Shop UI</a></li>
                                <li><a href="shop-ui-inner.html">Product Page</a></li>
                                <li><a href="shop-ui-filter-grid.html">Filter Grid Page</a></li>
                                <li><a href="shop-ui-filter-list.html">Filter List Page</a></li>
                                <li><a href="shop-ui-add-to-cart.html">Checkout</a></li>
                                <li><a href="shop-ui-login.html">Login</a></li>
                                <li class="active"><a href="shop-ui-register.html">Register</a></li>
                            </ul>
                        </li>
                        <!-- End Pages -->

                        <!-- Promotion -->
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                                Promotion
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-submenu">
                                    <a href="javascript:void(0);">Jeans</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Skinny Jeans</a></li>
                                        <li><a href="#">Bootcut Jeans</a></li>
                                        <li><a href="#">Straight Cut Jeans</a></li>
                                    </ul>    
                                </li>
                                <li class="dropdown-submenu">
                                    <a href="javascript:void(0);">Shoes</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Sandals</a></li>
                                        <li><a href="#">Heels</a></li>
                                    </ul>    
                                </li>
                            </ul>
                        </li>
                        <!-- End Promotion -->

                        <!-- Gifts -->
                        <li class="dropdown mega-menu-fullwidth">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                                Gifts
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="mega-menu-content">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-3 col-sm-12 col-xs-12 md-margin-bottom-30">
                                                    <h3 class="mega-menu-heading">Pellentes que nec diam lectus</h3>
                                                    <p>Proin pulvinar libero quis auctor pharet ra. Aenean fermentum met us orci, sedf eugiat augue pulvina r vitae. Nulla dolor nisl, molestie nec aliquam vitae, gravida sodals dolor...</p>
                                                    <button type="button" class="btn-u btn-u-dark">Read More</button>
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

                        <!-- Books -->
                        <li class="dropdown mega-menu-fullwidth">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">
                                Books
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="mega-menu-content">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-2 col-sm-6">
                                                    <h3 class="mega-menu-heading">Clothe</h3>
                                                    <ul class="list-unstyled style-list">
                                                        <li><a href="#">New in</a></li>
                                                        <li><a href="#">Coats &amp; Jackets</a></li>
                                                        <li><a href="#">Jeans</a></li>
                                                        <li><a href="#">Dresses</a></li>
                                                        <li><a href="#">Shorts</a> <span class="label label-danger-shop">New</span></li>
                                                        <li><a href="#">Skirts</a></li>
                                                        <li><a href="#">T-Shirts</a></li>
                                                    </ul>
                                                    <h3 class="mega-menu-heading">Shoes</h3>
                                                    <ul class="list-unstyled style-list">
                                                        <li><a href="#">Boots</a></li>
                                                        <li><a href="#">FLats</a></li>
                                                        <li><a href="#">Heels</a></li>
                                                        <li><a href="#">Sandals</a></li>
                                                        <li><a href="#">Sports</a></li>
                                                    </ul>
                                                </div>

                                                <div class="col-md-2 col-sm-6">
                                                    <h3 class="mega-menu-heading">Accessories</h3>
                                                    <ul class="list-unstyled style-list">
                                                        <li><a href="#">All accessories</a></li>
                                                        <li><a href="#">Bags &amp; Purses</a></li>
                                                        <li><a href="#">Scarvs &amp; Hats</a></li>
                                                        <li><a href="#">Jewellery</a></li>
                                                        <li><a href="#">Fragrance &amp; Beauty</a></li>
                                                    </ul>
                                                    <h3 class="mega-menu-heading">Lingerie</h3>
                                                    <ul class="list-unstyled style-list">
                                                        <li><a href="#">Linger</a> <span class="label label-danger-shop">New</span></li>
                                                        <li><a href="#">Slippers</a></li>
                                                    </ul>
                                                    <h3 class="mega-menu-heading">Nightwear</h3>
                                                    <ul class="list-unstyled style-list">
                                                        <li><a href="#">Nightwear</a></li>
                                                        <li><a href="#">Socks</a></li>
                                                        <li><a href="#">Tights</a></li>
                                                    </ul>
                                                </div>

                                                <div class="col-md-2 col-sm-6">
                                                    <h3 class="mega-menu-heading">Mixed</h3>
                                                    <ul class="list-unstyled style-list">
                                                        <li><a href="#">New in</a></li>
                                                        <li><a href="#">Coats &amp; Jackets</a> <span class="label label-danger-shop">New</span></li>
                                                        <li><a href="#">Jeans</a></li>
                                                        <li><a href="#">Dresses</a></li>
                                                        <li><a href="#">Shorts</a></li>
                                                        <li><a href="#">Skirts</a></li>
                                                        <li><a href="#">T-shirts</a></li>
                                                        <li><a href="#">Boots</a></li>
                                                        <li><a href="#">Flats</a></li>
                                                        <li><a href="#">Heels</a></li>
                                                        <li><a href="#">Sandals</a></li>
                                                        <li><a href="#">Sports</a></li>
                                                        <li><a href="#">Socks</a></li>
                                                        <li><a href="#">Tights</a></li>
                                                    </ul>
                                                </div>        

                                                <div class="col-md-2 col-sm-6">
                                                    <h3 class="mega-menu-heading">Clothe</h3>
                                                    <ul class="list-unstyled style-list">
                                                        <li><a href="#">New in</a></li>
                                                        <li><a href="#">Coats &amp; Jackets</a></li>
                                                        <li><a href="#">Jeans</a></li>
                                                        <li><a href="#">Dresses</a></li>
                                                        <li><a href="#">Shorts</a> <span class="label label-danger-shop">New</span></li>
                                                        <li><a href="#">Skirts</a></li>
                                                        <li><a href="#">T-shirts</a></li>
                                                    </ul>
                                                    <h3 class="mega-menu-heading">Shoes</h3>
                                                    <ul class="list-unstyled style-list">
                                                        <li><a href="#">Boots</a></li>
                                                        <li><a href="#">Flats</a></li>
                                                        <li><a href="#">Heels</a></li>
                                                        <li><a href="#">Sandals</a></li>
                                                        <li><a href="#">Sports</a></li>
                                                    </ul>
                                                </div>

                                                <div class="col-md-2 col-sm-6">
                                                    <h3 class="mega-menu-heading">Accessories</h3>
                                                    <ul class="list-unstyled style-list">
                                                        <li><a href="#">All accessories</a></li>
                                                        <li><a href="#">Bags &amp; Purses</a></li>
                                                        <li><a href="#">Scarvs &amp; Hats</a></li>
                                                        <li><a href="#">Jewellery</a></li>
                                                        <li><a href="#">Fragrance &amp; Beauty</a></li>
                                                    </ul>
                                                    <h3 class="mega-menu-heading">Lingerie</h3>
                                                    <ul class="list-unstyled style-list">
                                                        <li><a href="#">Linger</a> <span class="label label-danger-shop">New</span></li>
                                                        <li><a href="#">Slippers</a></li>
                                                    </ul>
                                                    <h3 class="mega-menu-heading">Nightwear</h3>
                                                    <ul class="list-unstyled style-list">
                                                        <li><a href="#">Nightwear</a></li>
                                                        <li><a href="#">Socks</a></li>
                                                        <li><a href="#">Tights</a></li>
                                                    </ul>
                                                </div>

                                                <div class="col-md-2 col-sm-6">
                                                    <h3 class="mega-menu-heading">Mixed</h3>
                                                    <ul class="list-unstyled style-list">
                                                        <li><a href="#">New in</a></li>
                                                        <li><a href="#">Coats &amp; Jackets</a> <span class="label label-danger-shop">New</span></li>
                                                        <li><a href="#">Jeans</a></li>
                                                        <li><a href="#">Dresses</a></li>
                                                        <li><a href="#">Shorts</a></li>
                                                        <li><a href="#">Skirts</a></li>
                                                        <li><a href="#">T-shirts</a></li>
                                                        <li><a href="#">Boots</a></li>
                                                        <li><a href="#">Flats</a></li>
                                                        <li><a href="#">Heels</a></li>
                                                        <li><a href="#">Sandals</a></li>
                                                        <li><a href="#">Sports</a></li>
                                                        <li><a href="#">Socks</a></li>
                                                        <li><a href="#">Tights</a> <span class="label label-danger-shop">New</span></li>
                                                    </ul>
                                                </div>
                                            </div><!--/end row-->
                                        </div><!--/end container-->
                                    </div><!--/end mega menu content-->  
                                </li>
                            </ul><!--/end dropdown-menu-->
                        </li>
                        <!-- End Books -->

                        <!-- Clothes -->
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" data-delay="1000">
                                Clothes
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Jeans</a></li>
                                <li><a href="#">T-shirts</a></li>
                                <li><a href="#">Shorts</a></li>
                            </ul>
                        </li>
                        <!-- End Clothes -->

                        <!-- Main Demo -->
                        <li><a href="../index.html">Main Demo</a></li>
                        <!-- Main Demo -->
                    </ul>
                </div><!--/navbar-collapse-->
            </div>    
        </div>            
        <!-- End Navbar -->
    </div>
    <!--=== End Header v5 ===-->

    <!--=== Breadcrumbs v4 ===-->
    <div class="breadcrumbs-v4">
        <div class="container">
            <span class="page-name">Log In</span>
            <h1>Maecenas <span class="shop-green">enim</span> sapien</h1>
            <ul class="breadcrumb-v4-in">
                <li><a href="index.html">Home</a></li>
                <li><a href="">Product</a></li>
                <li class="active">Log In</li>
            </ul>
        </div><!--/end container-->
    </div> 
    <!--=== End Breadcrumbs v4 ===-->

    <!--=== Registre ===-->
    <div class="log-reg-v3 content-md margin-bottom-30">
        <div class="container">
            <div class="row">
                <div class="col-md-7 md-margin-bottom-50">
                    <h2 class="welcome-title">Welcome to Unify</h2>
                    <p>Suspendisse et tincidunt ipsum, et dignissim urna. Vestibulum nisl tortor, gravida at magna et, suscipit vehicula massa.</p><br>
                    <div class="row margin-bottom-50">
                        <div class="col-sm-4 md-margin-bottom-20">
                            <div class="site-statistics">
                                <span>20,039</span>
                                <small>Products</small>
                            </div>    
                        </div>
                        <div class="col-sm-4 md-margin-bottom-20">
                            <div class="site-statistics">
                                <span>54,283</span>
                                <small>Reviews</small>
                            </div>    
                        </div>
                        <div class="col-sm-4">
                            <div class="site-statistics">
                                <span>376k</span>
                                <small>Sale</small>
                            </div>    
                        </div>
                    </div>
                    <div class="members-number">
                        <h3>Join more than <span class="shop-green">13,000</span> members worldwide</h3>
                        <img class="img-responsive" src="/Public/assets/img/map.png" alt="">
                    </div>    
                </div>

                <div class="col-md-5">
                    <form id="sky-form4" class="log-reg-block sky-form"  onblur='regis(this)' method="post" enctype="multipart/form-data" >
                        <!--action="<?php echo U('Home/Lu/register');?>"-->
                        <h2>注册</h2>
                        <div class="login-input reg-input">
                            <section>
                                <label class="input">
                                    <input type="text" name="username" placeholder="请输入用户名" onblur='fun1(this)' class="form-control" value=""/>
                                </label>
                            </section>
                            <label class="select margin-bottom-15">
                                <!--<select name="gender" class="form-control">-->
                                <select name="lastname" class="form-control">
                                    <option value="0" selected disabled>性别</option>
                                    <option value="1">男</option>
                                    <option value="2">女</option>
                                    <option value="3">保密</option>
                                </select>
                            </label>
                            <section>
                                <label class="input">
                                    <input type="password" name="password" placeholder="请输入密码" id="password" class="form-control">
                                </label>
                            </section>                                
                            <section>
                                <label class="input">
                                    <input type="password" name="passwordConfirm" placeholder="请再次输入密码" class="form-control">
                                </label>
                            </section>

<!--                            <section>
                                <label class="input">
                                    <input type="password" name="passwordConfirm" placeholder="请再次输入密码" class="form-control">
                                </label>
                            </section>-->

                            <scrtion>
                            <tr height="50">
                                <td align="right" style="color:red">&nbsp;手机： &nbsp;</td>
                                <td><input id="mobile" name="mobile" type="text" size="25" style="color:#000;margin-bottom: 13px;width: 245px;" />
                                    <input id="code1" type="hidden" value="<?php echo ($send_code); ?>"/>
                                    <input id="zphone" style="color:#000;width: 112px;" type="button" value=" 获取手机验证码 " onClick="get_mobile_code()">
                                    <!-- <a style="color:#000" onClick="get_mobile_code()" id="zphone">获取手机验证码</a>-->
                                 </td><br>
                             </tr>
                             </scrtion>

                             <section>
                             <tr height="50">
                                 <td align="right">&nbsp;手机验证码： &nbsp;</td>
                                 <td> <input type="text" size="8" id="mobile_code" name="mobile_code" class="inputBg" style="color:black;width: 318px;"/>
                                 </td>
                             </tr>
                                 <input id="mobile_code2" type="hidden" value="<?php echo ($mobile_code); ?>"/>
                                 </section>

                         </div>

                         <section>
                         <label class="checkbox margin-bottom-10">
                             <input type="checkbox" name="checkbox"/>
                             <i></i>
                             订阅我们的通讯获取最新优惠
                         </label>
                             </section>

                         <section>
                         <label class="checkbox margin-bottom-20">
                             <input type="checkbox" name="terms" id="tiaokuan" value="1" />
                             <i></i>
                             我已阅读同意<a href="#">条款和条件</a>
                         </label>
                             </section>

                         <button class="btn-u btn-u-sea-shop btn-block margin-bottom-20" type="submit" onClick="regis(reg)">注册</button>
                     </form>

                     <div class="margin-bottom-20"></div>
                     <p class="text-center">你已经有一个帐户？<a href="<?php echo U('Home/Lu/login');?>">登录</a></p>
                 </div>
             </div><!--/end row-->
        </div><!--/end container-->
    </div>
</div>
    <!--=== End Registre ===-->     

    <!--=== Shop Suvbscribe ===-->
    <div class="shop-subscribe">
        <div class="container">
            <div class="row">
                <div class="col-md-8 md-margin-bottom-20">
                    <h2>subscribe to our weekly <strong>newsletter</strong></h2>
                </div>  
                <div class="col-md-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="请输入电子邮箱">
                        <span class="input-group-btn">
                            <button class="btn" type="button"><i class="fa fa-envelope-o"></i></button>
                        </span>
                    </div>    
                </div>
            </div>
        </div><!--/end container-->
    </div>
    <!--=== End Shop Suvbscribe ===-->

    <!--=== Footer v4 ===-->
    <div class="footer-v4">
        <div class="footer">
            <div class="container">
                <div class="row">
                    <!-- About -->
                    <div class="col-md-4 md-margin-bottom-40">
                        <a href="index.html"><img class="footer-logo" src="/Public/assets/img/logo-2.png" alt=""></a>
                        <p>About Unify dolor sit amet, consectetur adipiscing elit. Maecenas eget nisl id libero tincidunt sodales.</p>
                        <br>
                        <ul class="list-unstyled address-list margin-bottom-20">
                            <li><i class="fa fa-angle-right"></i>California, US, Lorem Lis Street, Orange, 25</li>
                            <li><i class="fa fa-angle-right"></i>Phone: 800 123 3456</li>
                            <li><i class="fa fa-angle-right"></i>Fax: 800 123 3456</li>
                            <li><i class="fa fa-angle-right"></i>Email: info@anybiz.co</li>
                        </ul>

                        <ul class="list-inline shop-social">
                            <li><a href="#"><i class="fb rounded-md fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="tw rounded-md fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="gp rounded-md fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="yt rounded-md fa fa-youtube"></i></a></li>
                        </ul>
                    </div>
                    <!-- End About -->                    

                    <!-- Simple List -->
                    <div class="col-md-2 col-sm-3">
                        <div class="row">
                            <div class="col-sm-12 col-xs-6">
                                <h2 class="thumb-headline">Secciones</h2>
                                <ul class="list-unstyled simple-list margin-bottom-20">
                                    <li><a href="#">Ultima Hora</a></li>
                                    <li><a href="#">Exclusiva</a></li>
                                    <li><a href="#">Documentos </a></li>
                                    <li><a href="#">Francisco papa</a></li>
                                    <li>...</li>
                                </ul>
                            </div>    

                            <div class="col-sm-12 col-xs-6">
                                <h2 class="thumb-headline">Temas</h2>
                                <ul class="list-unstyled simple-list">
                                    <li><a href="#">Ultima Hora</a></li>
                                    <li><a href="#">Exclusiva</a></li>
                                    <li><a href="#">Documentos </a></li>
                                    <li><a href="#">Francisco papa</a></li>
                                    <li>...</li>
                                </ul>
                            </div>
                        </div>
                    </div>    

                    <div class="col-md-2 col-sm-3">
                        <div class="row">
                            <div class="col-sm-12 col-xs-6">
                                <h2 class="thumb-headline">Utilidades</h2>
                                <ul class="list-unstyled simple-list margin-bottom-20">
                                    <li><a href="#">Ultima Hora</a></li>
                                    <li><a href="#">Exclusiva</a></li>
                                    <li><a href="#">Documentos </a></li>
                                    <li>...</li>
                                </ul>
                            </div>    

                            <div class="col-sm-12 col-xs-6">
                                <h2 class="thumb-headline">Documentos</h2>
                                <ul class="list-unstyled simple-list">
                                    <li><a href="#">Ultima Hora</a></li>
                                    <li><a href="#">Exclusiva</a></li>
                                    <li><a href="#">Documentos </a></li>
                                    <li><a href="#">Francisco papa</a></li>
                                    <li>...</li>
                                </ul>
                            </div>
                        </div>        
                    </div>

                    <div class="col-md-2 col-sm-3">
                        <div class="row">
                            <div class="col-sm-12 col-xs-6">
                                <h2 class="thumb-headline">Publicidad</h2>
                                <ul class="list-unstyled simple-list margin-bottom-20">
                                    <li><a href="#">Ultima Hora</a></li>
                                    <li><a href="#">Exclusiva</a></li>
                                    <li><a href="#">Documentos </a></li>
                                    <li><a href="#">Francisco papa</a></li>
                                    <li>...</li>
                                </ul>
                            </div>    

                            <div class="col-sm-12 col-xs-6">
                                <h2 class="thumb-headline">Contacto</h2>
                                <ul class="list-unstyled simple-list">
                                    <li><a href="#">Ultima Hora</a></li>
                                    <li><a href="#">Exclusiva</a></li>
                                    <li><a href="#">Documentos </a></li>
                                    <li><a href="#">Francisco papa</a></li>
                                    <li>...</li>
                                </ul>
                            </div>
                        </div>        
                    </div>

                    <div class="col-md-2 col-sm-3">
                        <div class="row">
                            <div class="col-sm-12 col-xs-6">
                                <h2 class="thumb-headline">Utilidades</h2>
                                <ul class="list-unstyled simple-list margin-bottom-20">
                                    <li><a href="#">Ultima Hora</a></li>
                                    <li><a href="#">Exclusiva</a></li>
                                    <li>...</li>
                                </ul>
                            </div>
                                
                            <div class="col-sm-12 col-xs-6">
                                <h2 class="thumb-headline">Documentos</h2>
                                <ul class="list-unstyled simple-list">
                                    <li><a href="#">Ultima Hora</a></li>
                                    <li><a href="#">Exclusiva</a></li>
                                    <li>...</li>
                                </ul>
                            </div>
                        </div>        
                    </div>
                    <!-- End Simple List -->
                </div><!--/end row-->
            </div><!--/end continer-->
        </div><!--/footer-->

        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">                     
                        <p>
                            2014 &copy; Unify. ALL Rights Reserved. 
                            <a target="_blank" href="https://twitter.com/htmlstream">Htmlstream</a> | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
                        </p>
                    </div>
                    <div class="col-md-6">  
                        <ul class="list-inline sponsors-icons pull-right">
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div> 
        </div><!--/copyright--> 
    </div>
    <!--=== End Footer v4 ===-->
<!--/wrapper-->

<!--<script>
    layer.alert('{{session("msg")}}',{icon:5});
</script>-->


<!--<script src="/Public/assets/layer/layer.js" type="text/javascript"></script>-->
<!-- JS Global Compulsory -->
<script src="/Public/assets/plugins/jquery/jquery-1.8.3.min.js"></script>

<script src="/Public/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--<script src="/Publichome/layer/layer.js" type="text/javascript"></script>
<script src="/Publichome/js/jquery-1.9.1.min.js" type="text/javascript"></script>-->
<!-- JS Implementing Plugins -->
<script src="/Public/assets/plugins/back-to-top.js"></script>
<!-- Validation Form -->
<script src="/Public/assets/plugins/sky-forms/version-2.0.1/js/jquery.validate.min.js"></script>
<!-- Scrollbar -->

<script src="/Public/assets/plugins/scrollbar/src/perfect-scrollbar.js"></script>
<!-- JS Customization -->
<script src="/Public/assets/js/custom.js"></script>
<!-- JS Page Level -->           
<script src="/Public/assets/js/shop.app.js"></script>
<script src="/Public/assets/js/forms/page_registration.js"></script>
<script type="text/javascript" src="/Public/assets/js/plugins/style-switcher.js"></script>
<script>
    jQuery(document).ready(function() {
        App.init();
        Registration.initRegistration();
        StyleSwitcher.initStyleSwitcher();
    });
</script>
<!--[if lt IE 9]>
    <script src="/Public/assets/plugins/respond.js"></script>
    <script src="/Public/assets/plugins/html5shiv.js"></script>
    <script src="/Public/assets/js/plugins/placeholder-IE-fixes.js"></script>    
    <script src="/Public/assets/plugins/sky-forms/version-2.0.1/js/sky-forms-ie8.js"></script>
<![endif]-->
<!--[if lt IE 10]>
    <script src="/Public/assets/plugins/sky-forms/version-2.0.1/js/jquery.placeholder.min.js"></script>
<![endif]-->
</body>

<script language="javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

       function fun1(obj) {
           var v = obj.value;
           $.post("<?php echo U('home/Lu/uname');?>", {username: v}, function (data) {
               if(data){
                   alert(jQuery.trim(unescape(data)));
               }

           },"text");
       }

    function regis(obj) {
        var r = obj.value;
        $.post("<?php echo U('home/Lu/register');?>", {mobile:jQuery.trim($('#mobile').val()),send_code:$('#code1').val()}, function (reg) {
            alert(jQuery.trim(unescape(reg)));
        },"text");
    }

    function get_mobile_code(){
        $.post("<?php echo U('home/Lu/sendCode');?>", {mobile:jQuery.trim($('#mobile').val()),send_code:$('#code1').val()}, function(msg) {
            //console.log(msg);
            alert(jQuery.trim(unescape(msg)));
            //console.log(jQuery.trim(unescape(msg)));
            if(msg=='提交成功'){
                RemainTime();
            }
        });
    }
    var iTime = 59;
    var Account;
    function RemainTime(){
        document.getElementById('zphone').disabled = true;
        var iSecond,sSecond="",sTime="";
        if (iTime >= 0){
            iSecond = parseInt(iTime%60);
            iMinute = parseInt(iTime/60);
            if (iSecond >= 0){
                if(iMinute>0){
                    sSecond = iMinute + "分" + iSecond + "秒";
                }else{
                    sSecond = iSecond + "秒";
                }
            }
            sTime=sSecond;
            if(iTime==0){
                clearTimeout(Account);
                sTime='获取手机验证码';
                iTime = 59;
                document.getElementById('zphone').disabled = false;
            }else{
                Account = setTimeout("RemainTime()",1000);
                iTime=iTime-1;
            }
        }else{
            sTime='没有倒计时';
        }
        document.getElementById('zphone').value = sTime;
    }
</script>
</html>