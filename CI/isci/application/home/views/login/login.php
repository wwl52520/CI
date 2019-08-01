<?php ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>注册</title> <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/skin_/login.css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>other/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript">
            $(function ()
            {
                $("#bd").css('height', $(window).height());
            })

        </script>
    </head>
    <body>
        <div id="container">
            <div id="bd">
                <div id="main">
                    <div class="login-box">
                        <form name="login" class="demoform" method='post' action="<?php echo base_url(); ?>login/login" >
                            <div id="logo"></div>
                            <h1></h1>
                            <div class="input username" id="username">
                                <label for="userName">用户名</label>
                                <span></span>
                                <input type="text"  name="username"  />
                            </div>
                            <div class="input psw" >
                                <label for="password">密&nbsp;&nbsp;&nbsp;&nbsp;码</label>
                                <span></span>
                                <input type="password" " name="password"  />
                            </div>
                            <div class="input validate" id="validate">
                                <label for="valiDate">验证码</label>
                                <input type="text" id="valiDate" name="code" placeholder="输入验证码">
                                <div class="value">
                                    <img  src="<?php echo site_url('login/verification_code'); ?>"  onclick=this.src="<?php echo site_url('login/verification_code/_'); ?>"+Math.random() />
                                </div>
                            </div>

                            <div id="btn" class="loginButton">
                                <input type="submit" class="button" value="登录" name="btn"  />
                                <input type="text" style="display:none;" name="ac">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </body>
</html>
