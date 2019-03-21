<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>银行小不懂</title>
    <meta name="description" content="这是一个404页面">
    <meta name="keywords" content="404">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <base href="/dashboard/www/BankHelperAdministration/Public/">
    <link rel="icon" type="image/png" href="i/nav_icon.png">
    <link rel="apple-touch-icon-precomposed" href="i/app-icon72x72@2x.png">
    <meta name="apple-mobile-web-app-title" content="Amaze UI" />
    <link rel="stylesheet" href="css/amazeui.min.css"/>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/pintuer.css">
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
    以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar am-topbar-inverse admin-header">
    <div class="am-topbar-brand">
        <strong>银行小不懂</strong> <small>后台管理</small>
    </div>

    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
            <li class="am-dropdown" data-am-dropdown>
                <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                    <span class="am-icon-users"></span> 管理员 <span class="am-icon-caret-down"></span>
                </a>
                <ul class="am-dropdown-content">
                    <li><a href="../Home/PersonData"><span class="am-icon-user"></span> 资料</a></li>
                    <li><a href="../Home/ChangePwd"><span class="am-icon-cog"></span> 修改密码</a></li>
                    <li><a href="#"><span class="am-icon-power-off"></span> 退出</a></li>
                </ul>
            </li>
            <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
        </ul>
    </div>
</header>

<div class="am-cf admin-main">
    <!-- sidebar start -->
    <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
        <div class="am-offcanvas-bar admin-offcanvas-bar">
            <ul class="am-list admin-sidebar-list">
                <li><a href="../Home/index"><span class="am-icon-home"></span> 首页</a></li>
                <li><a href="../Home/User"><span class="am-icon-home"></span> 已注册用户</a></li>
                <li class="admin-parent">
                    <a class="am-cf" data-am-collapse="{target: '#collapse-apply'}"><span class="am-icon-file"></span> 用户申请 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
                    <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-apply">
                        <li><a href="../Home/ImportIn" class="am-cf"><span class="am-icon-check"></span> 定期转入<span class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span></a></li>
                    </ul>
                </li>
                <li class="admin-parent">
                    <a class="am-cf" data-am-collapse="{target: '#collapse-other'}"><span class="am-icon-file"></span> 其他 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
                    <ul class="am-list am-collapse admin-sidebar-sub am-in" id="collapse-other">
                        <li><a href="../Home/Feedback.html"><span class="am-icon-th"></span> 意见反馈</a></li>
                        <li><a href="../Home/RiskReport"><span class="am-icon-calendar"></span> 风险举报</a></li>
                    </ul>
                </li>
                <li><a href="#"><span class="am-icon-sign-out"></span> 退出账号</a></li>

            </ul>
        </div>
    </div>
    <!-- sidebar end -->

    <!-- content start -->
    
    <div class="admin-content">
        <div class="admin-content-body">
            <div class="panel admin-panel">
                <div class="panel-head"><strong class="icon-reorder"> 最新列表</strong></div>
                <div class="padding border-bottom">
                    <button type="button" class="button border-yellow" ><span class="icon-plus-square-o"></span> 全部审核通过</button>
                </div>
                <div id="load">
                    <table class="table table-hover">
                        <tr>
                            <th width="10%">申请ID</th>
                            <th width="20%">卡ID</th>
                            <th width="15%">转入数额(元)</th>
                            <th width="20%">定期时间(月)</th>
                            <th width="10%">申请时间</th>
                            <th width="15%">操作</th>
                        </tr>
                        <?php if(is_array($item1)): foreach($item1 as $key=>$tc): ?><tr>
                                <td><?php echo ($tc["id"]); ?></td>
                                <td><?php echo ($tc["c_id"]); ?></td>
                                <td><?php echo ($tc["num"]); ?></td>
                                <td><?php echo ($tc["duration"]); ?></td>
                                <td><?php echo ($tc["apply_time"]); ?></td>
                                <td><div class="button-group">
                                    <a class="button border-main" onclick="return pass(<?php echo ($tc["id"]); ?>)"><span class="icon-edit"></span> 审核通过</a>
                                    <a class="button border-red" onclick="return dispass(<?php echo ($tc["id"]); ?>)"><span class="icon-edit"></span> 审核拒绝</a>
                                </div>
                                </td>
                            </tr><?php endforeach; endif; ?>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- content end -->

</div>

<a href="#" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<footer>
    <hr>
    <p class="am-padding-left">© 2019 AllMobilize, Inc. Licensed under MIT license.</p>
</footer>

<!--[if lt IE 9]><![endif]-->
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="js/amazeui.ie8polyfill.min.js"></script>
<!--<![endif]-->
<script src="js/amazeui.min.js"></script>
<script src="js/app.js"></script>
<script src="js/layer/layer.js"></script>
<script src="js/page/common.js"></script>

    <script language="JavaScript">
        function pass(mid){
            if(confirm("您确定审核通过吗？"))
            {
//                var table = document.getElementsByClassName("table")
//                s="";
//                for(var i = 0; i<table.rows.length ; i++){
//                    var onerow = table.rows[i];
//                    for(var j = 0,l2 = onerow.cells.length; j< l2;j++){
//                        s += onerow.cells[j].innerText;
//                    }
//                    s+="\n"
//                }
                alert(mid);
            }
        }

        function dispass(mid){
            if(confirm("您确定拒绝该审核吗？"))
            {
//                var table = document.getElementsByClassName("table")
//                s="";
//                for(var i = 0; i<table.rows.length ; i++){
//                    var onerow = table.rows[i];
//                    for(var j = 0,l2 = onerow.cells.length; j< l2;j++){
//                        s += onerow.cells[j].innerText;
//                    }
//                    s+="\n"
//                }
//                alert("fuck");
            }
        }
    </script>

</body>
</html>