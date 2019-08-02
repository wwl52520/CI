<?php ?>
<html
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>查看消息内容</title>
        <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
        <style>
            .title{width: 300px!important}
            .title span{    width: 100%;line-height: 38px; margin-left: 10px;}
            .uploads{padding: 0!important}
            .content{width:90%!important;margin-left: 10px!important;}
            .content textarea{line-height: 38px; }
        </style>
        
       
        
        
        
    </head>
    <div id="main">
        <div class="layui-row new_nav">
            <span class="layui-breadcrumb" lay-separator="">
                <a href="#" onclick="javascript :history.back(-1);"><i class="layui-icon icon iconfont">&#xe62f;</i>返回上一页</a>
                <a href="<?php echo site_url()?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
                <a href="javascript:;">编辑短消息</a>
            </span>
        </div>
        <form class="layui-form layui-form-pane"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this">编辑消息内容</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item  tab_content layui-show" pane>
                        
                        <div class="layui-form-item" >
                            <label class="layui-form-label">短信类型</label>
                            <div class="layui-input-inline title">
                                <span><?=$list['type']?></span>
                            </div>
                         
                        </div>
                        <div class="layui-form-item" >
                            <label class="layui-form-label">发件人</label>
                            <div class="layui-input-inline title">
                                <span><?=$list['post_user_name']?></span>
                            </div>
                         
                        </div>

                        <div class="layui-form-item" >
                            <label class="layui-form-label">收件人</label>
                            <div class="layui-input-inline title">
                                <span><?=$list['accept_user_name']?></span>
                            </div>
                        </div>
                        
                           <div class="layui-form-item" >
                            <label class="layui-form-label">发送时间</label>
                            <div class="layui-input-inline title">
                                <span><?=$list['post_time']?></span>
                            </div>
                        </div>
                            
                           <div class="layui-form-item" >
                            <label class="layui-form-label">阅读状态</label>
                            <div class="layui-input-inline title">
                                <span><?=$list['is_read']?></span>
                            </div>
                        </div>
                          <div class="layui-form-item" >
                            <label class="layui-form-label">阅读时间</label>
                            <div class="layui-input-inline title">
                                <span><?=$list['read_time']?></span>
                            </div>
                        </div>
                        
                            <div class="layui-form-item" >
                            <label class="layui-form-label">标题</label>
                            <div class="layui-input-inline title">
                                <span><?=$list['title']?></span>
                            </div>
                        </div>
                        
                        <div class="layui-form-item form_btn" style="width:100%" >
                                    <label class="layui-form-label">内容</label>
                                <div class="layui-input-inline content">
                                      <textarea  style="width: 60%;height:250px;border: none" ><?=$list['content']?></textarea>
                                </div>
                            </div>
                        
                        
                        
                    </div>
                </div>
                
        </form>
    </div>
    <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/iconfont.js"></script>
     <script type="text/javascript" src="<?php echo base_url(); ?>other/kindeditor/kindeditor.js"></script>  
        <script charset="utf-8" src="<?php echo base_url(); ?>other/kindeditor/lang/zh-CN.js"></script>
    <script>
                                    layui.use(['jquery', 'form', 'layer', 'element'], function () {
                                        var form = layui.form;
                                        var upload = layui.upload;
                                        var element = layui.element;
                                        var laydate = layui.laydate;
                                        window.jQuery = window.$ = layui.jquery;


                                        $("input[name='accept_user_name']").blur(function () {
                                            var $uname = $(this).val();
                                           
                                            if($uname.length<6)
                                            {
                                                $(".loads").text("× 会员号不存在小于6位数！");
                                                  $(".loads").addClass('oks');
                                            }
                                            else
                                            {
                                             $(".loads").text("正在检测...");
                                            $.ajax({
                                                url: '<?php echo site_url() . $this->router->fetch_class(); ?>/get_username',
                                                type: 'post',
                                                data: {
                                                    'uname': $uname
                                                },
                                                error: function () {}, success: function (data) {
                                                    if (data == 0) {
                                                        $("input[name='accept_user_name']").focus();
                                                        $(".loads").text("× 用户信息输入错误，请重新确认");
                                                        $(".loads").addClass("red");
                                                    } else {
                                                        $(".loads").addClass('oks');
                                                        $(".loads").text("√");
                                                    }
                                                }
                                            });
                                            }
                                        });
                                        
                                            var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
					resizeType : 1,
					allowPreviewEmoticons : false,
					allowImageUpload : false,
					items : [
						'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
						'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
						'insertunorderedlist', '|', 'emoticons', 'image', 'link']
				});
			});
                                    });
    </script>      
   <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/common.js"></script>
        </body>
</html>