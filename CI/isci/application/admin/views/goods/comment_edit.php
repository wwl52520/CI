<?php ?>
<html
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>商品评论——回复</title>
        <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/layui/css/layui.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/layui/css/iconfont.css" media="all" />
        <style>
            .uploads{padding: 0!important}
            .title span{display:inline-block;margin: 10px 0 0 10px;font-size: 12px}
        </style>

    </head>
    <body>
        <div id="main">
            <div class="layui-row new_nav">
                <span class="layui-breadcrumb" lay-separator="">
                    <a href="<?php echo "<script>history.go(-1);</script>"; ?>"><i class="layui-icon icon iconfont">&#xe62f;</i>返回上一页</a>
                    <a href="<?php echo site_url()?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
                    <a href="javascript:;">评论管理</a>
                </span>
            </div>
            <form class="layui-form layui-form-pane" action="<?php echo site_url() ?>Goods_comment/edit"    method="post"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
                <div class="layui-tab">
                    <ul class="layui-tab-title">
                        <li class="layui-this">回复评论信息</li>
                    </ul>
                    
                    <div class="layui-tab-content">
                        <div class="layui-tab-item  tab_content layui-show">
                            <div class="layui-form-item" >
                                <label class="layui-form-label">信息标题</label>
                                <div class="layui-input-inline title">
                                    <input type="hidden" name="title" value="<?=$list['title']?>">
                                    <span><?=$list['title']?></span>
                                </div>
                            </div>
                            
                            <div class="layui-form-item" >
                                <label class="layui-form-label">评论用户</label>
                                <div class="layui-input-inline title">
                                    <span><?=$list['user_name']?></span>
                                </div>
                            </div>
                             <div class="layui-form-item" >
                                <label class="layui-form-label">用户IP</label>
                                <div class="layui-input-inline title">
                                    <span><?=$list['user_ip']?></span>
                                </div>
                            </div>
                                 <div class="layui-form-item" >
                                <label class="layui-form-label">用户IP</label>
                                <div class="layui-input-inline title">
                                    <span><?=$list['content']?></span>
                                </div>
                            </div>
                            
                                <div class="layui-form-item" >
                                <label class="layui-form-label">评论时间</label>
                                <div class="layui-input-inline title">
                                    <span><?= date('Y/m/d h:i:s',$list['add_time'])?></span>
                                </div>
                            </div>
                        <div class="layui-form-item" >
                                <label class="layui-form-label">审核状态</label>
                                <div class="layui-input-block" >
                                    <input type="hidden" name="status" value="0" >
                                    <input type="checkbox" name="status"  checked lay-skin="switch" value="<?php echo $list['status'];?>" lay-filter="status" lay-text="未审核|已审核">
                                </div>
                            </div>
                            
                            <div class="layui-form-item layui-form-text ">
                                <label class="layui-form-label">回复内容</label>
                                <div class="layui-input-block">
                                    <textarea name="reply_content" placeholder="请输入内容" class="layui-textarea"><?php echo $list['reply_content'];?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item form_btn">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            <input type="hidden" name="id" value="<?php echo $list['id']?>">
                        </div>
                    </div>
            </form>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/iconfont.js"></script>
        <script>
           layui.use(['jquery', 'form','upload', 'element'], function () {
                var form = layui.form;
                var upload = layui.upload;
                var element = layui.element;
                window.jQuery = window.$ = layui.jquery;
       
                 //switch事件监听
    form.on('switch(status)', function (data) {

        if (data.elem.checked === true) {
            if ($(data.elem).val() == 0) {
                $(data.othis).addClass("layui-form-onswitch");
                $(data.othis).children("em").text("已审核");
                $(data.elem).prev().attr("value", 1);
                $(data.elem).attr("value", 1);
         
            } else {
                data.othis.removeClass("layui-form-onswitch");
                $(data.othis).children("em").text("未审核");
                $(data.elem).attr("value", 0);
                 $(data.elem).prev().attr("value", 0);
           
            }

        } else {
            if ($(data.elem).val() == 0) {
                $(data.othis).addClass("layui-form-onswitch");
                $(data.othis).children("em").text("已审核");
                $(data.elem).attr("value", 1);
                  $(data.elem).prev().attr("value", 1);
             
            } else {
                $(data.othis).removeClass("layui-form-onswitch");
                $(data.othis).children("em").text("未审核");
                $(data.elem).attr("value", 0);
                  $(data.elem).prev().attr("value", 0);
           
            }
        }

    });

    //加载完判断按钮状态
    window.onload = function () {
        $("input[name='status']").each(function () {
            if ($(this).val() == 0) {
                $(this).next('div').removeClass('layui-form-onswitch');
                $(this).next('div').children("em").text("未审核");
            } else {
          $(this).next('div').addClass('layui-form-onswitch');
                $(this).next('div').children("em").text("已审核");
            }
        });

    };
            });
        </script>
        
           <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/common.js"></script>
    </body>
</html>