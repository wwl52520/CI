<?php ?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>首页</title> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />

    </head
    <body style="overflow: hidden">
        <div class="layui-main-nav">
            <div class="layui-row">
                <div class="layui-col-md11">
                    <ul class="layui-nav">
                        <li  class=""><i class="layui-icon">&#xe68e;</i><span>后台首页</span></li>
                    </ul>

                </div>
                <div class="layui-col-md1">
                    <ul class="layui-nav">
                        <li  class="layui-nav-item">
                            <a href="javascript:;">
                                <i class="layui-icon">&#xe614;</i>页面操作</a>
                            <dl class="layui-nav-child"> <!-- 二级菜单 -->

                                <dd><a href="">密码修改</a></dd>
                                <dd><a href="">管理中心</a></dd>
                            </dl>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="layui-main-center">
                <div class="layui-row layui-col-space25">
                    <div class="layui-col-md3 ">
                        <div class="main-center-left layui-anim layui-anim-rotate">
                            <i class="layui-icon">&#xe613;</i>   
                        </div>
                        <div class="main-center-right">
                            <h1><?php echo $res_top[0]['num'];?></h1>
                            <span>用户总量</span>
                        </div>
                    </div>
                    <div class="layui-col-md3">
                        <div class="main-center-left layui-anim layui-anim-rotate layui-bg-red">
                            <i class="layui-icon ">&#xe612;</i>   
                        </div>
                        <div class="main-center-right">
                            <h1><?php echo $res_top[1]['num']; ;?></h1>
                            <span>今日注册用户</span>
                        </div>
                    </div>
                    <div class="layui-col-md3">
                        <div class="main-center-left layui-anim layui-anim-rotate layui-bg-green">
                            <i class="layui-icon">&#xe705;</i>   
                        </div>
                        <div class="main-center-right">
                            <h1><?php echo $res_top[2]['num'];;?></h1>
                            <span>文章总数</span>
                        </div>
                    </div>
                    <div class="layui-col-md3">
                        <div class="main-center-left layui-anim layui-anim-rotate layui-bg-black">
                            <i class="layui-icon  ">&#xe63c;</i>   
                        </div>
                        <div class="main-center-right">
                            <h1><?php echo $res_top[3]['num'];;?></h1>
                            <span>今日订单数</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="layui-row layui-col-space25  main-middle-left">
                <div class="layui-col-md6">
                    <!--系统概述-->

                    <div class="layui-collapse">
                        <div class="layui-colla-item" style="border-left:5px solid #E2E2E2">
                            <h2 class="layui-colla-title">系统概述</h2>
                            <div class="layui-colla-content main-middle-content layui-show">
                                <dl>
                                    <dd>站点名称：<?php echo $user['webname']; ?></dd>
                                    <dd>站点域名：<?php echo $user['weburl']; ?></dd>
                                    <dd>服务器名称：<?php echo $user['server_address']; ?></dd>
                                    <dd>服务器IP：<?php echo $user['server_address']; ?></dd>
                                    <dd>服务器版本：<?php echo $user['server_version']; ?></dd>
                                    <dd>附件目录：<?php echo "/Uploads"; ?></dd>
                                    <dd>PHP版本：<?php echo $user['php_version']; ?></dd>
                                    <dd>当前登录用户:<?php echo $user['UserName']; ?></dd>
                                </dl>
                            </div>
                        </div>
                    </div>

                    <div class="layui-collapse" style="margin-top:25px">
                        <div class="layui-colla-item" style="border-left:5px solid #E2E2E2">
                            <h2 class="layui-colla-title">网站信息统计{SEO数据统计}</h2>
                            <div class="layui-colla-content main-middle-content layui-show larry-seo-stats" id="larry-seo-stats">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-col-md6">
                    <div class="layui-collapse">
                        <div class="layui-colla-item" style="border-left:5px solid #E2E2E2">
                            <h2 class="layui-colla-title">最新订单</h2>
                            <div class="layui-colla-content main-middle-content layui-show">
                                <dl>

                                    <dd><div class="layui-row main-middle-center-right" style="border-bottom: 1px solid #e3e3e3">

                                            <div class="layui-col-md1">会员名</div>
                                            <div class="layui-col-md5">订单号</div>
                                            <div class="layui-col-md2">金额</div>
                                            <div class="layui-col-md2">状态</div>

                                            <div class="layui-col-md2">生成时间</div>
                                        </div>
                                    </dd>
                                   <?php foreach ($res_order as $order):?>
                                    <dd><div class="layui-row main-middle-center-right">
                                            <div class="layui-col-md1"><?=$order['user_name'];?></div>
                                            <div class="layui-col-md5"><?=$order['recharge_no'];?></div>
                                            <div class="layui-col-md2"><?=$order['amount'];?></div>
                                            
                                            <div class="layui-col-md2">
                                                    <?php
                                                    if ($order['status'] == 1) {
                                                        echo '已完成';
                                                    } else {
                                                        echo '未完成';
                                                    }
                                                    ?>
                                                </div>
                                            <div class="layui-col-md2"><?php  echo date('Y-m-d H:i',$order['add_time']); ?></div>
                                        </div>
                                    </dd>
                                 <?php endforeach;?>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="layui-collapse" style="margin-top:25px">
                        <div class="layui-colla-item" style="border-left:5px solid #E2E2E2">
                            <h2 class="layui-colla-title">系统公告</h2>
                            <div class="layui-colla-content main-middle-content layui-show xtgg">
                                <p>  最新通知这里是最新通知最新通知这里是最新通知最新通知这里是最新通知最新通知这里是最新通知最新通知这里是最新通知最新通知这里是最新通知最新通知这里是最新通知最新通知这里是最新通知最新通知这里是最新通知最新通知这里是最新通知这里是最新通知最新通知这里是最新通知最新通知这里是最新通知最新通知这里是最新通知最新通知这里是最新通知这里是最新通知最新通知这里是最新通知最新通知这里是最新通知最新通知这里是最新通知最新通知这里是最新通知</p>
                            </div>
                        </div>
                    </div>

                    <div class="layui-collapse" style="margin-top:22px">
                        <div class="layui-colla-item" style="border-left:5px solid #E2E2E2">
                            <h2 class="layui-colla-title">最新文章</h2>
                            <div class="layui-colla-content main-middle-content layui-show xtgg">
                                <dl>
                                    <dd><div class="layui-row main-middle-center-right" style="border-bottom: 1px solid #e3e3e3">
                                            <div class="layui-col-md2">作者</div>
                                            <div class="layui-col-md5">标题</div>
                                            <div class="layui-col-md2">阅读量</div>
                                            <div class="layui-col-md3">发布时间</div>
                                        </div>
                                    </dd>
                                       <?php foreach ($res_news as $news):?>
                                    <dd>
                                        <div class="layui-row main-middle-center-right">
                                            <div class="layui-col-md2"><?=$news['author'];?></div>
                                            <div class="layui-col-md5"><?=$news['title'];?></div>
                                            <div class="layui-col-md2"><?=$news['click'];?></div>
                                            <div class="layui-col-md3"><?=date('Y-m-d H',$news['addate']) ?></div>
                                        </div>
                                    </dd>
                                   <?php endforeach;?>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.js"></script>
<script>
    layui.use(['jquery', 'form', 'element'], function () {
        var element = layui.element;
        window.jQuery = window.$ = layui.jquery;
        $('body', parent.document).css({
            "overflow-y": "auto"
        });
   //session存储本页面，F5刷新时保证页面不会丢失
        //这里是设置了一个值，页面刷新时 页面会自动跳到main.php下面，该文件下则将设置的值赋给iframe的src，从而使地址得到保存
        /*
        var links = window.localStorage.getItem("thisurl");
        if (links != null) {
            $(".layui-iframe").attr('src', links);
        }
        */
    });
</script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/echarts.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/main.js"></script>
    </body>
</html>
