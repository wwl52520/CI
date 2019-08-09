<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>首页</title> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/login.css" media="all" />
          
       


        
    </head>
    <body>

        <div class="layui-canvs"></div>
        <div class="layui-layout layui-layout-login">
            <h1>
                <strong>WLCMS管理系统后台</strong>
                <em>Management System</em>
            </h1>
            <form  class="layui-form" method='post' action="<?php echo site_url('Login/login'); ?>" >

                <div class="layui-form-item layui-login-parent"  >
                    <i class="layui-icon">&#xe66f;</i> 
                    <div class="layui-input-inline layui-login-parent_inline" >
                        <input type="text" name="username" placeholder="输入用户名" required lay-verify="required" class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item layui-login-parent"  >
                    <i class="layui-icon">&#xe673;</i> 
                    <div class="layui-input-inline layui-login-parent_inline" >
                        <input type="text" name="password" placeholder="输入密码" required lay-verify="required" class="layui-input" >
                    </div>
                </div>

                <div class="layui-form-item layui-login-parent"  >
                    <div class="layui-row">

                        <i class="layui-icon">&#xe672;</i> 
                        <div class="layui-input-inline" >
                            <input type="text" name="code" placeholder="输入验证码" required lay-verify="required" class="layui-input" >
                        </div>
                        <div class="layui-input-inline" style="width:100px">
                            <img src="<?php echo site_url('Login/verification_code'); ?>" alt="" class="verifyImg" id="verifyImg" onClick="this.src = '<?php echo site_url('Login/verification_code/_'); ?>' + Math.random()">
                        </div>
                    </div>

                    <div class="layui-submit larry-login">
                        <input type="submit" value="立即登陆" name="btn" style="width: 100%" class="layui-btn"/>
                    </div>
                    </from>
                    <div class="layui-login-text">
                        <p>© 2016-2019 Larry 版权所有</p>
                        <p>鄂xxxxxx</p>
                    </div>
                </div>
                     <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.all.js"></script>
                <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/login.js"></script>
                  <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/jsplug/jparticle.jquery.js"></script>
                <script type="text/javascript">
                             $(document).ready(function () {
                                    $(".layui-canvs").jParticle({
                                        background: "#141414",
                                        color: "#E6E6E6"
                                    });
                                });
                                
                                    //屏幕发生变化，高度相应变化
                       $(window).resize(function(){
                             $(".layui-canvs,.layui-canvs canvas").width($(document).width());
                              $(".layui-canvs,.layui-canvs canvas").height($(window).height());
                         });   
                                
                                
                </script>
                </body>
                </html>
