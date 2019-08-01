<?php ?>
<html
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>编辑消息内容</title>
        <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
        <style>
            .sort input{width: 80%!important;float: left}
            .sort span{line-height: 38px;margin-left: 2px}
            .uploads{padding: 0!important}
           
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
        <form class="layui-form layui-form-pane" action="<?php echo site_url() ?>User_message/add" method="post"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this">编辑消息内容</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item  tab_content layui-show" pane>
                        
                        <div class="layui-form-item" >
                            <label class="layui-form-label">收件人</label>
                            <div class="layui-input-inline title">
                                <input type="text" name="accept_user_name" readonly onfocus="this.removeAttribute('readonly');" required  placeholder="请输入用户名" autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux loads">*输入用户名，以英文逗号“,”分隔开</div>
                        </div>

                        <div class="layui-form-item" >
                            <label class="layui-form-label">标题</label>
                            <div class="layui-input-inline title">
                                <input type="text" name="title"  autocomplete="off" class="layui-input" value="">
                            </div>
                            <div class="layui-form-mid layui-word-aux">*40个字符以内</div>
                        </div>

                        <div class="layui-form-item" style="width:100%" >
                                    <label class="layui-form-label">内容</label>
                                <div class="layui-input-inline content">
                                      <textarea id="content" name="content" style="width: 94%;height:250px" >
                            </textarea>
                                </div>
                            </div>
                        
                        
                        
                    </div>
                </div>
                <div class="layui-form-item form_btn">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
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