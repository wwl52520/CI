<?php ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>消费记录</title>
    <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/skin_/nav.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/skin_/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/skin_/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/skin_/table.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/jquery.grid.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/admin.css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>other/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>other/js/WdatePicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>other/js/Common.js"></script>
    <style>
        .newcz_div{width: 90%;height:40px;background: url(__PUBLIC__/frame/img/skin_/toolbarbg.png) repeat-x;}
        .newcz_div ul {}
        .newcz_div ul li{float: left;margin:0 20px 0 10px;height:40px;line-height: 40px;}
        .news_div{width:100%}
        .news_div_ul{width:100%;height:33px;background: url(__PUBLIC__/frame/img/skin_/thbg.png) repeat-x;background: #e3e3e3}
        .news_div_ul li{height:25px !important;line-height: 30px !important;padding: 0 10px 0 6px !important;}
        .news_div ul li{height: 80px;line-height: 80px;float: left;text-align:center;padding:10px 10px 6px 6px;word-wrap:break-word;word-break:break-all;overflow:hidden;border-bottom:1px solid #e6e6e6;}

        .l1{width: 18%}
        .l2{width: 15%;text-align: center}
        .l3{width: 18%;}
        .l4{width: 25%;}
        .l5{width: 15%;}
        .search{width:90%;height:40px;margin: 30px}
        .search ul{}
        .search ul li{float:left;width:320px;text-align:center;font-size: 14px;height:40px;line-height: 40px}
        .search ul li input,select{height:30px;width: 173px;padding-left:5px;}
        .serbtn{width: 70px;height:30px;height:30px;margin-top:5px;}
        .pages {margin:35px 35%}
        .user_list ul{width: 100%;height:35px;float: left}
        .news_div ul li{height: 35px;line-height: 35px;}
    </style>

</head>

<body>
    <div id="container">
        <?php $this->load->view('header') ?>
        <div id="bd">
            <?php $this->load->view('Left_Nav') ?>

            <div id="main">
                <div class="location">
                    <a href="javascript:history.back(-1);" class="back"><i class="iconfont icon-up"></i><span>返回 &nbsp;&nbsp; ></span></a>
                    <a href="javascript:;"><i class="iconfont icon-home"></i><span>首页&nbsp;&nbsp; ></span></a>
                    <i class="arrow iconfont icon-arrow-right"></i>
                    <span>管理中心</span>
                </div>
                <div class="line10"></div>
                <div class='newcz_div'>
                    <ul>
                        <li><a href="<?php echo base_url() ?>user_recharge/show">增加</a><li>
                        <li><input id="delall" type="checkbox"  onclick="all_id()">全选<li>
                        <li><p onclick="deletes()">删除</p><li>
                    </ul>
                </div>

                <div class="ui-table-tbody ui-scroll-webkit" style="min-height:390px;overflow: inherit">
                    <div class="__tbodyMain ui-table-main" style="display: block; width: 100%; right: 100px;left:1px">
                        <div class='news_div'>
                            <ul  class="news_div_ul">
                                <li class='l5'>选择</li>
                                <li class='l1'>用户名</li>
                                 <li class='l2'>金额</li>
                                <li class='l4'>备注</li>
                                <li  class='l2'>生成时间</li>
                            </ul>
                            <div class="user_list">
                                <?php foreach ($user_amount as $list) : ?>
                                    <ul>
                                        <li class='l5'><input type="checkbox"class="allid"  value="<?php echo $list['id'] ?>"/></li>
                                        <li class='l1'><?php echo $list['user_name'] ?></li>
                                        <li  class='l2'><?php
                                                if ($list['value'] > 0) {
                                                    echo"+" . $list['value'];
                                                } else {
                                                    echo"-" . $list['value'];
                                                }
                                                ?></li>
                                        <li  class='l4'><?php echo $list['remark'];?></li>
                                        <li  class='l2'><?php echo $list['add_time']; ?></li>
                                     
                                    </ul>
                                <?php endforeach; ?>
                            </div>

                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>