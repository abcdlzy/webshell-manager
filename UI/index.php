<?php
/**
 * Created by PhpStorm.
 * User: abcdlzy
 * Date: 15/1/18
 * Time: 下午9:39
 */

?>
<!doctype html>
<html>
<head>

    <meta charset="utf-8">

    <title>WebShell分布式管理系统</title>
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/VarelaRound.css">

    <link rel="stylesheet" href="css/processbar.css" media="screen" type="text/css" />
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/grid.css" rel="stylesheet">
    <link href="css/nivo.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/element.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/select/cs-select.css" />
    <link rel="stylesheet" type="text/css" href="css/select/cs-skin-border.css" />
    <link rel="stylesheet" type="text/css" href="css/select/cs-skin-underline.css" />
    <link rel="stylesheet" href="css/index.css"/>
    <!--

    <link rel="stylesheet" type="text/css" href="css/select/cs-skin-boxes.css" />
    <link rel="stylesheet" type="text/css" href="css/select/cs-skin-circular.css" />
    <link rel="stylesheet" type="text/css" href="css/select/cs-skin-elastic.css" />
    <link rel="stylesheet" type="text/css" href="css/select/cs-skin-overlay.css" />
    <link rel="stylesheet" type="text/css" href="css/select/cs-skin-rotate.css" />
    <link rel="stylesheet" type="text/css" href="css/select/cs-skin-slide.css" />
    -->

    <link href="assets/css/vendor/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/vendor/animate/animate.min.css">
    <link type="text/css" rel="stylesheet" media="all" href="assets/js/vendor/mmenu/css/jquery.mmenu.all.css" />
    <link rel="stylesheet" href="assets/js/vendor/videobackground/css/jquery.videobackground.css">
    <link rel="stylesheet" href="assets/css/vendor/bootstrap-checkbox.css">
    <link rel="stylesheet" href="assets/js/vendor/rickshaw/css/rickshaw.min.css">
    <link rel="stylesheet" href="assets/js/vendor/morris/css/morris.css">
    <link rel="stylesheet" href="assets/js/vendor/tabdrop/css/tabdrop.css">
    <link rel="stylesheet" href="assets/js/vendor/summernote/css/summernote.css">
    <link rel="stylesheet" href="assets/js/vendor/summernote/css/summernote-bs3.css">
    <link rel="stylesheet" href="assets/js/vendor/chosen/css/chosen.min.css">
    <link rel="stylesheet" href="assets/js/vendor/chosen/css/chosen-bootstrap.css">
    <link rel="stylesheet" href="assets/js/vendor/datatables/css/dataTables.bootstrap.css">
    <link rel="stylesheet" href="assets/js/vendor/datatables/css/ColVis.css">
    <link rel="stylesheet" href="assets/js/vendor/datatables/css/TableTools.css">
    <link rel="stylesheet" href="assets/js/vendor/datepicker/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" href="assets/js/vendor/typeahead/css/typeahead.js-bootstrap.css">

    <link href="assets/css/minimal.css" rel="stylesheet">



    <script src="./js/jquery.js"></script>

    <!--[if lt IE 7]>
    <script src="./js/IE7.js"></script>
    <![endif]-->
    <!--[if lt IE 8]>
    <script src="./js/IE8.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="./js/html5.js"></script>
    <script src="./js/IE9.js"></script>
    <script src="./js/ie.js"></script>
    <![endif]-->

    <script src="./js/crypto/core-min.js"></script>
    <script src="./js/crypto/x64-core-min.js"></script>
    <script src="./js/crypto/aes-min.js"></script>
    <script src="./js/crypto/cipher-core-min.js"></script>
    <script src="./js/crypto/enc-base64-min.js"></script>
    <script src="./js/crypto/enc-utf16-min.js"></script>
    <script src="./js/crypto/evpkdf-min.js"></script>
    <script src="./js/crypto/format-hex-min.js"></script>
    <script src="./js/crypto/hmac-min.js"></script>
    <script src="./js/crypto/lib-typedarrays-min.js"></script>
    <script src="./js/crypto/md5-min.js"></script>

    <script src="./js/crypto/mode-ecb-min.js"></script>


    <script src="./js/crypto/pbkdf2-min.js"></script>
    <script src="./js/crypto/rabbit-legacy-min.js"></script>
    <script src="./js/crypto/rabbit-min.js"></script>
    <script src="./js/crypto/rc4-min.js"></script>
    <script src="./js/crypto/ripemd160-min.js"></script>
    <script src="./js/crypto/sha1-min.js"></script>
    <script src="./js/crypto/sha512-min.js"></script>
    <script src="./js/crypto/tripledes-min.js"></script>
    <script src="./js/rollups/aes.js"></script>
    <script src="./js/rollups/hmac-md5.js"></script>
    <script src="./js/rollups/hmac-ripemd160.js"></script>
    <script src="./js/rollups/hmac-sha1.js"></script>
    <script src="./js/rollups/hmac-sha512.js"></script>
    <script src="./js/rollups/md5.js"></script>
    <script src="./js/rollups/pbkdf2.js"></script>
    <script src="./js/rollups/rabbit-legacy.js"></script>
    <script src="./js/rollups/rabbit.js"></script>
    <script src="./js/rollups/rc4.js"></script>
    <script src="./js/rollups/ripemd160.js"></script>
    <script src="./js/rollups/sha1.js"></script>
    <script src="./js/rollups/sha512.js"></script>
    <script src="./js/rollups/tripledes.js"></script>

    <script src="./js/RSA/asn1hex.js"></script>
    <script src="./js/RSA/base64.js"></script>
    <script src="./js/RSA/jsbn.js"></script>
    <script src="./js/RSA/jsbn2.js"></script>
    <script src="./js/RSA/prng4.js"></script>
    <script src="./js/RSA/rng.js"></script>
    <script src="./js/RSA/rsa.js"></script>
    <script src="./js/RSA/rsa2.js"></script>
    <script src="./js/RSA/rsa-pem.js"></script>
    <script src="./js/RSA/rsa-sign.js"></script>
    <script src="./js/RSA/sha1.js"></script>
    <script src="./js/RSA/sha256.js"></script>
    <script src="./js/RSA/x509.js"></script>



    <!--
    <script src="./js/crypto/sha3-min.js"></script>
    <script src="./js/crypto/sha224-min.js"></script>
    <script src="./js/crypto/sha256-min.js"></script>
    <script src="./js/crypto/sha384-min.js"></script>
    <script src="./js/rollups/hmac-sha224.js"></script>
    <script src="./js/rollups/hmac-sha256.js"></script>
    <script src="./js/rollups/hmac-sha3.js"></script>
    <script src="./js/rollups/hmac-sha384.js"></script>
    <script src="./js/rollups/sha3.js"></script>
    <script src="./js/rollups/sha224.js"></script>
    <script src="./js/rollups/sha256.js"></script>
    <script src="./js/rollups/sha384.js"></script>
    <script src="./js/crypto/mode-cfb-min.js"></script>
    <script src="./js/crypto/mode-ctr-gladman-min.js"></script>
    <script src="./js/crypto/mode-ctr-min.js"></script>
    <script src="./js/crypto/mode-ofb-min.js"></script>
    <script src="./js/crypto/pad-ansix923-min.js"></script>
    <script src="./js/crypto/pad-iso10126-min.js"></script>
    <script src="./js/crypto/pad-iso97971-min.js"></script>
    <script src="./js/crypto/pad-nopadding-min.js"></script>
    <script src="./js/crypto/pad-zeropadding-min.js"></script>
-->

</head>

<body>

<div id="login">

    <h2><span class="fontawesome-lock"></span>登陆</h2>

    <form action="javascript:void(0);" method="POST">

        <fieldset>

            <p><label for="server">服务器URL</label></p>
            <p><input type="server" id="server" value="<?php echo @$_SERVER['HTTPS'] != "on"?"http":"https";echo '://'.$_SERVER["HTTP_HOST"].substr(substr($_SERVER["PHP_SELF"],0,strrpos($_SERVER["PHP_SELF"],'/')),0,strrpos(substr($_SERVER["PHP_SELF"],0,strrpos($_SERVER["PHP_SELF"],'/')),'/'));?>" onBlur="if(this.value=='')this.value='localhost'" onFocus="if(this.value=='localhost')this.value=''"></p>

            <p><label for="password">密码</label></p>
            <p><input type="password" id="password" value="" onBlur="if(this.value=='')this.value=''" onFocus="if(this.value=='password')this.value=''"></p>

            <p><input type="submit" value="提交" onclick="javascript:startLogin();"></p>
            <p>
                <input value="非登录模式" onclick="javascript:goNoLoginMode();" type="button">
            </p>
        </fieldset>

    </form>

</div>

<!-- end login -->

<div id="progress" style="display: none;">
    <h2><span class="fontawesome-key"></span>验证登陆</h2>
    <fieldset>
        <div class="loader">
            <div class="progress-bar"><div class="progress-stripes"></div><div class="percentage">0%</div></div>
        </div>
        <br/>
        <span id="progressbar-info">测试测试。。。</span>
    </fieldset>
</div>

<div id="mask" class="maskospanel">

<div id="panel_page_wrap"   style="display: none">

    <header>

        <div class="logo-container">
            <i id="loading" class="fa fa-connectdevelop" style="font-size: 50px;"></i> WebShell分布式管理系统

        </div><!-- Logo Side ENDS -->

        <nav>

            <ul id="menu">
                <!--
                <li>
                    <div class="menu-abs-bg background-color"></div>
                    <div class="home-icon menu-specs">
                        <a href="#" onclick="javascript:panelChange('home');" title="Home Page">主面板</a>
                        <span>基础信息显示</span>
                    </div>
                </li>
                -->
                <li>
                    <div class="menu-abs-bg background-color"></div>
                    <div class="link-icon menu-specs">
                        <a href="#" onclick="javascript:panelChange('WebShell');" >WebShell管理</a>
                        <span>Webshell的管理与操作</span>
                    </div>
                </li>
                <!--
                <li>
                    <div class="menu-abs-bg background-color"></div>
                    <div class="connection-w menu-specs">
                        <a href="#" onclick="javascript:panelChange('activeLink');">活动链路管理</a>
                        <span>查看当前活跃的链路</span>
                    </div>
                </li>
                -->
                <li>
                    <div class="menu-abs-bg background-color"></div>
                    <div class="blog-icon menu-specs">
                        <a href="#" onclick="javascript:panelChange('CertManage');" >证书管理</a>
                        <span>进行证书的查看与管理</span>
                    </div>
                </li>
                <li>
                    <div class="menu-abs-bg background-color"></div>
                    <div class="services-icon menu-specs">
                        <a href="#" onclick="javascript:panelChange('SystemSetting');">系统设置</a>
                        <span>进行基础的系统配置设置</span>
                    </div>
                </li>


            </ul><!-- Menu ENDS -->

        </nav><!-- Nav ENDS -->



    </header><!-- Left Side ENDS -->


    <div class="rightSide" id="rightSide">




    </div><!-- RightSide ENDS -->

</div><!-- Page Wrap ENDS -->

    </div>

<div id="toTop"></div>
<!-- Placed at the end of the document so the pages load faster -->


<div class="bg-1" id="noLoginMode" style="display: none;">


<!-- Wrap all page content here -->
<div id="wrap">
    <!-- Make page fluid -->
    <div class="row">
        <!-- Page content -->
        <div id="contentNLM" class="col-md-12 full-page login">


            <div class="inside-block">
                <img src="assets/images/logo-big.png" alt class="logo">
                <h1>WebShell 连接控制面板</h1>
                <h5>简易的WebShell连接方法，无需配置数据库</h5>

                <form id="form-signin" class="form-signin" action="javascript:void(0);">
                    <section>
                        <div class="input-group">
                            <input type="text" class="form-control" id="noLoginModeURL" name="url" placeholder="WebShell URL">
                            <div class="input-group-addon"><i class="fa fa-link"></i></div>
                        </div>
                        <div class="input-group">
                            <input type="password" class="form-control" id="noLoginModePASS"  name="pass" placeholder="WebShell Pass">
                            <div class="input-group-addon"><i class="fa fa-key"></i></div>
                        </div>
                    </section>
                    <section class="log-in">
                        <button class="btn btn-greensea" onclick="connectShell()">连接WebShell</button>
                        <span>&nbsp;</span>
                        <button class="btn btn-slategray" onclick="backLogin()">返回</button>
                        </section>
                </form>
            </div>


        </div>
        <!-- /Page content -->
    </div>
</div>
<!-- Wrap all page content end -->
</div>


<!--shell panel start-->

<div id="shellPanel" class="bg-1" style="display: none;" >

    <div class="mask"><div id="loader"></div></div>
    <!--/Preloader -->

    <!-- Wrap all page content here -->
    <div id="wrap">
        <!-- Make page fluid -->
        <div class="row">
            <!-- Fixed navbar -->
            <div class="navbar navbar-default navbar-fixed-top navbar-transparent-black mm-fixed-top" role="navigation" id="navbar">



                <!-- Branding -->
                <div class="navbar-header col-md-2">
                    <a class="navbar-brand" href="#" onclick="goShellList()">
                        返回
                    </a>
                    <div class="sidebar-collapse">
                        <a href="#">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                </div>
                <!-- Branding end -->


                <!-- .nav-collapse -->
                <div class="navbar-collapse">

                    <!-- Page refresh -->
                    <ul class="nav navbar-nav refresh">
                        <li class="divided">
                            <a href="#" class="page-refresh"><i class="fa fa-refresh"></i></a>
                        </li>
                    </ul>
                    <!-- /Page refresh -->

                    <!-- Quick Actions -->
                    <ul class="nav navbar-nav quick-actions">
                        <li class="divided">
                            <a class="dropdown-toggle button"  href="#">
                                <i class="fa fa-info"></i>
                                <span class="label label-transparent-black" id="nowShellOSInfo"><i class="fa fa-spinner fa-pulse"></i>数据请求中...</span>
                            </a>
                        </li>
                        <li class="divided">
                            <a class="dropdown-toggle button"  href="#">
                                <i class="fa fa-user"></i>
                                <span class="label label-transparent-black" id="nowShellUser"><i class="fa fa-spinner fa-pulse"></i>数据请求中...</span>
                            </a>
                        </li>
                        <li class="divided">
                            <a class="dropdown-toggle button"  href="#">
                                <i class="fa fa-group"></i>
                                <span class="label label-transparent-black" id="nowShellUserGroup"><i class="fa fa-spinner fa-pulse"></i>数据请求中...</span>
                            </a>
                        </li>
                    </ul>
                    <!-- /Quick Actions -->
                    <!-- Sidebar -->
                    <ul class="nav navbar-nav side-nav" id="sidebar">

                        <li class="collapsed-content">
                            <ul>
                                <li class="search"><!-- Collapsed search pasting here at 768px --></li>
                            </ul>
                        </li>

                        <li class="navigation" id="navigation">
                            <a href="#" class="sidebar-toggle" data-toggle="#navigation"><span class="label label-transparent-black" id="nowShellHost"><i class="fa fa-spinner fa-pulse"></i>数据请求中...</span></a>

                            <ul class="menu">

                                <li class="">
                                    <a href="#" onclick="changeShellFunction('fileManager')">
                                        <i class="fa fa-folder-open-o"></i> 文件管理
                                    </a>
                                </li>

                                <li >
                                    <a href="#" onclick="changeShellFunction('MYSQLManager')">
                                        <i class="fa fa-database"></i> MYSQL管理
                                    </a>
                                </li>

                                <li>
                                    <a href="#" onclick="changeShellFunction('exec')">
                                        <i class="fa fa-terminal"></i> 执行命令
                                    </a>
                                </li>

                                <li>
                                    <a href="#" onclick="changeShellFunction('var')">
                                        <i class="fa fa-gears"></i> PHP系统变量
                                    </a>
                                </li>


                                <li>
                                    <a href="#" onclick="changeShellFunction('portScan')">
                                        <i class="fa fa-search-plus"></i> 端口扫描
                                    </a>
                                </li>

                                <li>
                                    <a href="#" onclick="changeShellFunction('securityInfo')">
                                        <i class="fa fa-info"></i> 安全信息
                                    </a>
                                </li>

                                <li>
                                    <a href="#" onclick="changeShellFunction('eval')">
                                        <i class="fa fa-flash"></i> eval PHP代码
                                    </a>
                                </li>




                            </ul>
                        </li>
                    </ul>
                    <!-- Sidebar end -->
                </div>
                <!--/.nav-collapse -->

            </div>
            <!-- Fixed navbar end -->

            <!-- Page content -->
            <div id="content" class="col-md-12">
                <div class="main">
                    <!-- row -->
                    <div class="row">
                        <!-- col 12 -->
                        <div class="col-md-12">

                        <section class="tile transparent">
                    <div class="jumbotron bg-transparent-black-3">

                        <div class="text-center">
                            <h1>欢迎使用WebShell管理工具</h1>
                            <p>此工具作为网站管理工具可能带有攻击性,仅供安全研究与教学之用,风险自负!</p>
                            <p>请使用者注意使用环境并遵守国家相关法律法规！</p>
                        </div>

                    </div>


                </section>
                            </div></div></div>
            </div>
            <!-- Page content end -->


            <div id="mmenu" class="right-panel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs nav-justified">
                    <li class="active"><a href="#mmenu-users" data-toggle="tab"><i class="fa fa-users"></i></a></li>
                    <li class=""><a href="#mmenu-history" data-toggle="tab"><i class="fa fa-clock-o"></i></a></li>
                    <li class=""><a href="#mmenu-friends" data-toggle="tab"><i class="fa fa-heart"></i></a></li>
                    <li class=""><a href="#mmenu-settings" data-toggle="tab"><i class="fa fa-gear"></i></a></li>
                </ul>

            </div>

        </div>
        <!-- Make page fluid-->

    </div>

</div>

<!--shell panel end-->


<script src="assets/js/vendor/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/vendor/mmenu/js/jquery.mmenu.min.js"></script>
<script type="text/javascript" src="assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>
<script type="text/javascript" src="assets/js/vendor/nicescroll/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="assets/js/vendor/animate-numbers/jquery.animateNumbers.js"></script>
<script type="text/javascript" src="assets/js/vendor/videobackground/jquery.videobackground.js"></script>
<script type="text/javascript" src="assets/js/vendor/blockui/jquery.blockUI.js"></script>

<script src="assets/js/vendor/jgrowl/jquery.jgrowl.min.js"></script>
<script src="assets/js/vendor/typeahead/typeahead.min.js"></script>
<script src="assets/js/vendor/momentjs/moment-with-langs.min.js"></script>
<script src="assets/js/vendor/datepicker/bootstrap-datetimepicker.min.js"></script>
<script src="assets/js/vendor/chosen/chosen.jquery.min.js"></script>
<script src="assets/js/vendor/no-ui-slider/jquery.nouislider.min.js"></script>
<script src="assets/js/vendor/tabdrop/bootstrap-tabdrop.min.js"></script>
<script src="assets/js/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/js/vendor/datatables/ColReorderWithResize.js"></script>
<script src="assets/js/vendor/datatables/colvis/dataTables.colVis.min.js"></script>
<script src="assets/js/vendor/datatables/tabletools/ZeroClipboard.js"></script>
<script src="assets/js/vendor/datatables/tabletools/dataTables.tableTools.min.js" charset="utf-8" ></script>
<script src="assets/js/vendor/datatables/dataTables.bootstrap.js"></script>
<script src="assets/js/vendor/typeahead/typeahead.min.js"></script>
<script src="assets/js/minimal.min.js"></script>

<script>
    reloadBootstrap();

</script>


<script src="./js/base64.js"></script>
<script src="./js/isotope.js"></script>

<script src="./js/caroufredsel.js"></script>
<script src="./js/nivo.js"></script>
<script src="./js/jquery.mousewheel.js"></script>
<script src="./js/tinyscrollbar.js"></script>
<script src="./js/custom.js"></script>
<script src="./js/asyncLock.js"></script>
<script src="./js/jquery.fileDownload.js"></script>
<script src="./js/classie.js"></script>
<script src="./js/selectFx.js"></script>
<script src="./js/bootstrapLoader.js"></script>
<script src="./js/shellTools/exec.js"></script>
<script src="./js/shellTools/MYSQLQuery.js"></script>
<script src="./js/shellTools/fileTools.js"></script>
<script src="./js/shellTools/varAndSecInfo.js"></script>
<script src="./js/shellTools/portScan.js"></script>
<script src="./js/ajaxfileupload.js"></script>
<script src="./js/core.js"></script>
<script src="./js/progressbar.js"></script>

<div class="toast" id="toast_message" onclick="toastHide()">
    <div class="message-container processing-bg" >
        <div class="bg-with-icon processing-icon-bg aboutus-icon"></div>
        <div class="message-info"  >
            <span id="toast_message_text" style="white-space:nowrap;float: left;display: inline;">

            </span>
        </div>
    </div>
</div>
<div class="toast" id="toast_warning" onclick="toastHide()">
    <div class="message-container warning-bg" >
        <div class="bg-with-icon warning-icon-bg aboutus-icon"></div>
        <div class="message-info"  >
            <span id="toast_warning_text" style="white-space:nowrap;float: left;display: inline;">

            </span>

        </div>
    </div>
</div>
<div class="toast" id="toast_success" onclick="toastHide()">
    <div class="message-container success-bg" >
        <div class="bg-with-icon success-icon-bg aboutus-icon"></div>
        <div class="message-info"  >
<span id="toast_success_text" style="white-space:nowrap;float: left;display: inline;">

            </span>
        </div>
    </div>
</div>
<div class="toast" id="toast_notice" onclick="toastHide()">
    <div class="message-container notice-bg" >
        <div class="bg-with-icon notice-icon-bg aboutus-icon"></div>
        <div class="message-info"  >
<span id="toast_notice_text" style="white-space:nowrap;float: left;display: inline;">

            </span>
        </div>
    </div>
</div>


</body>
</html>