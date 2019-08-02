<?php ?>
<html
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>系统参数设置</title>
    <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
         <style>
            .uploads{padding: 0!important}
            .checkbtn{width:80px!important}
            .layui-form-label{width:130px!important}
        </style>
</head>
    <body>
        <div id="main">
            <div class="layui-row new_nav">
                <span class="layui-breadcrumb" lay-separator="">
                    <a href="#" onclick="javascript :history.back(-1);"><i class="layui-icon icon iconfont">&#xe62f;</i>返回上一页</a>
                    <a href="<?php echo site_url()?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
                    <a href="javascript:;">系统参数设置</a>
                </span>
            </div>
            <form class="layui-form layui-form-pane" action="<?php echo site_url()?>Systems/edit" method="post"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
                <div class="layui-tab">
                    <ul class="layui-tab-title">
                        <li class="layui-this">系统基础信息</li>
                        <li>邮件发送配置</li>
                        <li>功能权限配置</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item tab_content  layui-show" >
                            <div class="layui-form-item" >
                                <label class="layui-form-label">主站名称</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="webname" required  lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo $data['webname']; ?>">
                                </div>
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">主站域名</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="weburl" required  lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo $data['weburl']; ?>">
                                </div>
                                  <div class="layui-form-mid layui-word-aux">请以http://开头</div>
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">通讯地址</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="webaddress" required  lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo $data['webaddress']; ?>">
                                </div>
                             
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">联系电话</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="webtel" required  lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo $data['webtel']; ?>">
                                </div>
                         
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">传真号码</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="webfax" required  lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo $data['webfax']; ?>">
                                </div>
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">邮箱地址</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="webmail" required  lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo $data['webmail']; ?>">
                                </div>
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">备案号</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="webcrod" required  lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo $data['webcrod']; ?>">
                                </div>
                            </div>
                        </div>
                    
                        <div class="layui-tab-item tab_content" pane> 
                             <div class="layui-form-item" >
                                <label class="layui-form-label">SMTP服务器</label>
                                <div class="layui-input-inline title ">
                                    <input type="text" name="smtp_host" required  lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo $data['smtp_host']; ?>">
                                </div>
                                  <div class="layui-form-mid layui-word-aux">*发送邮件的SMTP服务器地址</div>
                            </div>
                              <div class="layui-form-item" >
                                <label class="layui-form-label">SMTP端口</label>
                                <div class="layui-input-inline checkbtn">
                                    <input type="text" name="smtp_port" required  lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo $data['smtp_port']; ?>">
                                </div>
                               
                            </div>
                              <div class="layui-form-item" >
                                <label class="layui-form-label">发件人地址</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="smtp_user" required  lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo $data['smtp_user']; ?>">
                                </div>
                                  <div class="layui-form-mid layui-word-aux">*发件人的邮箱地址</div>
                            </div>
                              <div class="layui-form-item" >
                                <label class="layui-form-label">邮箱账号</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="mail_form" required  lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo $data['mail_form']; ?>">
                                </div>
                             
                            </div>
                            
                              <div class="layui-form-item" >
                                <label class="layui-form-label">邮箱密码</label>
                                <div class="layui-input-inline title">
                                    <input type="password" name="mail_password" required  lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo $data['mail_password']; ?>">
                                </div>
                  
                            </div>
                            
                                <div class="layui-form-item" >
                                <label class="layui-form-label">收件人邮箱</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="mail_to" required  lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo $data['mail_to']; ?>">
                                </div>
                  
                            </div>
                                
                                <div class="layui-form-item" >
                                <label class="layui-form-label">发件人昵称</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="mail_subject" required  lay-verify="required"  autocomplete="off" class="layui-input" value="<?php echo $data['mail_subject']; ?>">
                                </div>
                  <div class="layui-form-mid layui-word-aux">*对方收到邮件时显示的昵称</div>
                            </div>
                                </div>

                    <div class="layui-tab-item tab_content" pane> 
                            <div class="layui-form-item" >
                                <label class="layui-form-label">开启管理日志</label>
                                <div class="layui-input-inline checkbtn" >
                                    <input type="hidden" name="is_admin_log" value="0">
                                    <input type="checkbox" name="is_admin_log"   lay-skin="switch" value="<?php echo $data['is_admin_log'] ?>" lay-text="开启|关闭">
                                </div>
                                <div class="layui-form-mid layui-word-aux">*开启后将会记录管理员在后台的操作日志</div>
                            </div>

                            <div class="layui-form-item" >
                                <label class="layui-form-label">是否开启网站</label>
                                <div class="layui-input-inline checkbtn" >
                                    <input type="hidden" name="up_site" value="0">
                                    <input type="checkbox"  name="up_site"    lay-skin="switch" value="<?php echo $data['up_site'] ?>"  lay-text="开启|关闭">
                                </div>
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">开启评论审核</label>
                                <div class="layui-input-inline checkbtn" >
                                    <input type="hidden" name="is_msg" value="0">
                                    <input type="checkbox" name="is_msg"  lay-skin="switch" value="<?php echo $data['is_msg'] ?>"  lay-text="开启|关闭">
                                </div>
                                <div class="layui-form-mid layui-word-aux">*开启后评论将会审核才显示</div>
                            </div>

                            <div class="layui-form-item" >
                                <label class="layui-form-label">开启会员功能</label>
                                <div class="layui-input-inline checkbtn" >
                                    <input type="hidden" name="is_user" value="0">
                                    <input type="checkbox"  name="is_user"  lay-skin="switch" value="<?php echo $data['is_user'] ?>"  lay-text="开启|关闭">

                                </div>
                                <div class="layui-form-mid layui-word-aux">*关闭后关联会员的内容将失效</div>
                            </div>
                        
                        <div class="layui-form-item" >
                                <label class="layui-form-label">开启规格</label>
                                <div class="layui-input-inline checkbtn" >
                                    <input type="hidden" name="is_spec" value="0">
                                    <input type="checkbox"  name="is_spec"  lay-skin="switch" value="<?php echo $data['is_spec'] ?>"  lay-text="开启|关闭">

                                </div>
                                <div class="layui-form-mid layui-word-aux">*关闭后关联规格内容将失效</div>
                            </div>
                           <div class="layui-form-item" >
                                <label class="layui-form-label">开启商城</label>
                                <div class="layui-input-inline checkbtn" >
                                    <input type="hidden" name="is_shop" value="0">
                                    <input type="checkbox"  name="is_shop"  lay-skin="switch" value="<?php echo $data['is_shop'] ?>"  lay-text="开启|关闭">
                                </div>
                                <div class="layui-form-mid layui-word-aux">*关闭后关联相册内容将失效</div>
                            </div>
                        <div class="layui-form-item" >
                                <label class="layui-form-label">开启相册</label>
                                <div class="layui-input-inline checkbtn" >
                                    <input type="hidden" name="is_albums" value="0">
                                    <input type="checkbox"  name="is_albums"  lay-skin="switch" value="<?php echo $data['is_albums'] ?>"  lay-text="开启|关闭">
                                </div>
                                <div class="layui-form-mid layui-word-aux">*关闭后关联相册内容将失效</div>
                            </div>
                        
                        
                        <div class="layui-form-item" >
                                <label class="layui-form-label">开启附件</label>
                                <div class="layui-input-inline checkbtn" >
                                    <input type="hidden" name="is_enclosure" value="0">
                                    <input type="checkbox"  name="is_enclosure"  lay-skin="switch" value="<?php echo $data['is_enclosure'] ?>"  lay-text="开启|关闭">

                                </div>
                                <div class="layui-form-mid layui-word-aux">*关闭后关联附件内容将失效</div>
                            </div>
                        
                            <div class="layui-form-item layui-form-text ">
                                <label class="layui-form-label">网站关闭原因</label>
                                <div class="layui-input-block">
                                    <textarea name="close_anser" placeholder="请输入内容" class="layui-textarea"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>

            </form>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/iconfont.js"></script>
     <script>
          
                        layui.use(['jquery', 'form', 'laydate', 'layer', 'upload', 'element'], function () {
                            var form = layui.form;
                            var laydate = layui.laydate;
                            var element = layui.element;
                            window.jQuery = window.$ = layui.jquery;

 
                            //switch事件监听
                            form.on('switch', function (data) {
                                if (data.elem.checked === true) {
                                    if ($(data.elem).val() == 0) {
                                        $(data.othis).addClass("layui-form-onswitch");
                                        $(data.othis).children("em").text("开启");
                                        $(data.elem).prop("value", 1);
                                         $(data.elem).prev().prop("value", 1);
                                        $(data.othis).next().prop("value", 1);
                                    } else {
                                        data.othis.removeClass("layui-form-onswitch");
                                        $(data.othis).children("em").text("关闭");
                                        $(data.elem).prop("value", 0);
                                         $(data.elem).prev().prop("value", 0);
                                        $(data.othis).next().prop("value", 0);
                                    }

                                } else {
                                    if ($(data.elem).val() == 0) {
                                        $(data.othis).addClass("layui-form-onswitch");
                                        $(data.othis).children("em").text("开启");
                                        $(data.elem).attr("value", 1);
                                         $(data.elem).prev().prop("value", 1);
                                        $(data.othis).next().attr("value", 1);
                                    } else {
                                        $(data.othis).removeClass("layui-form-onswitch");
                                        $(data.othis).children("em").text("关闭");
                                         $(data.elem).prev().prop("value", 0);
                                        $(data.elem).attr("value", 0);
                                        $(data.othis).next().attr("value", 0);
                                    }
                                }

                            });
                            
                        
                            
                            
                            
                            
                            
                            
                        });
        </script>  
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
        <script>
                     window.onload = function () {
                                $('input:checkbox').each(function () {
                                    if ($(this).val() == 0) {
                                        $(this).next('div').removeClass('layui-form-onswitch');
                                        $(this).prev().attr("value","0");
                                        $(this).next('div').children("em").text("关闭");
                                    } else {
                                        $(this).prev().attr("value","1");
                                        $(this).next('div').addClass('layui-form-onswitch');
                                        $(this).next('div').children("em").text("开启");
                                    }
                                });
                                
                              
                              //修改系统配置后 重新加载左边栏目
                            $('#goods_left dd:gt(1)', parent.document).remove();
                            $.ajax({
                                url:'<?= site_url()?>Systems/res_left',
                                type:'post',
                                success:function(data)
                                {   
                                    //将传过来的json对象转为json数组 
                                   var jsonObj =  JSON.parse(data);
                                   if(jsonObj['is_spec']>0)
                                   {         
                                       $html="<dd><a href='javascript:;' data-url='<?= site_url()?>spec/index'><i class='layui-icon'>&#xe60a;</i>规格管理</a></dd>";
                                      $('#goods_left', parent.document).append($html);
                                   }
                                        if(jsonObj['is_msg']>0)
                                   {         
                                       $html="<dd><a href='javascript:;' data-url='<?= site_url()?>comment/index'><i class='layui-icon'>&#xe60a;</i>评论管理</a></dd>";
                                      $('#goods_left', parent.document).append($html);
                                   }
                                },
                                error:function()
                                {
                                    alert('222');
                                }
                            })
                            
                            };
                            
                            
                            
                            
                            
            </script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/common.js"></script>
    </body>
</html>
