<?php ?>
<html
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>编辑新闻</title>
        <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/skin_/nav.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/skin_/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/jquery.grid.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/admin.css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>other/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/js/WdatePicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/kindeditor/kindeditor.js"></script>  
        <script charset="utf-8" src="<?php echo base_url(); ?>other/kindeditor/lang/zh-CN.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/js/Common.js"></script>
        <style>
            #main{margin:0px 10px 0 40px;border: 1px solid #eee;padding: 40px}
            #main2{margin:0px 10px 0 40px;border: 1px solid #eee;padding: 40px}
            #main3{margin:0px 10px 0 40px;border: 1px solid #eee;padding: 40px}
            .subfild{ height:30px;  margin: 25px 20px 0px 40px}
            .subfild .span_one{ border:1px solid #eee;border-bottom: none;display:block;  width:85px; text-align:center; height:30px; line-height:24px;  font-size:14px;float:left;line-height: 30px}
            .subfild .span_two{border:1px solid #eee; border-bottom: none;display:block;  width:85px; text-align:center; height:30px; line-height:24px;  font-size:14px;float:left;line-height: 30px}
            .subfild .span_three{ border:1px solid #eee;border-bottom: none;display:block;  width:85px; text-align:center; height:30px; line-height:24px;  font-size:14px;float:left;line-height: 30px}
            .subfild-content {margin-bottom:25px;}
            .kv-item{height:30px}
            .kv-item.time .kv-item-content{ position:relative;}
            .kv-item.time .kv-item-content .time-icon{position:absolute;right:10px;top:6px;*top:8px;}
            .button{margin-left:40px;margin-top: 25px}
        </style>

<script>
    $(function()
    {
        $(".subfild span").click(function()
        {
            $index=$(this).index();
         $("form").eq($index).show().siblings('form').hide();
         
        })
    })
    </script>
            

    </head>
    <body>
        <div id="container">
            <?php $this->load->view('header'); ?>
            <div id="bd">
                <?php $this->load->view('Left_Nav') ?>
                <h3 class="subfild">
                    <span class="span_one">基本信息</span>
                    <span class="span_three">邮件发送设置</span>
                </h3>
                <form method="post" action="<?php echo base_url() ?>systems/set_systems"    class="demoform" enctype="multipart/form-data" style="width: 1600px">
                <div id="main" class="main" >
                    <div class="subfild-content base-info">
                            
                        <div class="kv-item ue-clear">
                            <label><span class="impInfo">*</span>主站名称</label>
                            <div class="kv-item-content">
                                <input type="text" name="company"  value="<?php echo $site['company']; ?>" />
                            </div>
                            <span class="Validform_checktip">**公司名称</span>
                        </div>
    
         
                        
                            <div class="kv-item ue-clear">
                            <label><span class="impInfo">*</span>通讯地址</label>
                            <div class="kv-item-content">
                                <input type="text" name="address" value="<?php echo $site['address'] ?>" />
                            </div>
                            <span class="Validform_checktip">**发件人的邮箱地址</span>
                        </div>
                        
                                                    <div class="kv-item ue-clear">
                            <label><span class="impInfo">*</span>联系电话</label>
                            <div class="kv-item-content">
                                <input type="text" name="tel"  value="<?php echo $site['tel'];?>" />
                            </div>

                        </div>
                                                      <div class="kv-item ue-clear">
                            <label><span class="impInfo">*</span>邮箱地址</label>
                            <div class="kv-item-content">
                                <input type="text" name="email"  value="<?php echo $site['email']; ?>" />
                            </div>
                        </div>
                                                       <div class="kv-item ue-clear">
                            <label><span class="impInfo">*</span>备案号</label>
                            <div class="kv-item-content">
                                <input type="text" name="copyright"  value="<?php echo $site['copyright']; ?>" />
                            </div>
                        </div>
                        
                    </div>
                    </div>
                    <div class="buttons">
                        <input class="button" id="allbtn" type="submit" value="保存" />
                        <input type='hidden' name='site' value='edit'>
                         <input type="hidden" name="id"  value="<?php echo $site['site_id']; ?>" />
                    </div>
                </form>
                
                <form method="post" action="<?php echo base_url() ?>systems/set_systems"  id='addnew' class="demoform" enctype="multipart/form-data" style="width: 1600px;display:none">
                <div id="main" class="main" >
                    <div class="subfild-content base-info">
           
                        <div class="kv-item ue-clear">
                            <label><span class="impInfo">*</span>SMTP服务器</label>
                            <div class="kv-item-content">
                                <input type="text" name="smtp_host"  value="<?php echo $email['smtp_host']; ?>" />
                            </div>
                            <span class="Validform_checktip">**发送邮件的SMTP服务器地址</span>
                        </div>
    
                        <div class="kv-item ue-clear">
                            <label><span class="impInfo">*</span>SMTP端口</label>
                            <div class="kv-item-content">
                                <input type="text" name="smtp_port"  class="sort" value="<?php echo $email['smtp_port']?>" />
                            </div>
                        </div>
         
                        
                            <div class="kv-item ue-clear">
                            <label><span class="impInfo">*</span>发件人地址</label>
                            <div class="kv-item-content">
                                <input type="text" name="smtp_user" value="<?php echo $email['smtp_user'] ?>" />
                            </div>
                            <span class="Validform_checktip">**发件人的邮箱地址</span>
                        </div>
                        
                                                    <div class="kv-item ue-clear">
                            <label><span class="impInfo">*</span>邮箱账号</label>
                            <div class="kv-item-content">
                                <input type="text" name="mail_form"  value="<?php echo $email['mail_form'];?>" />
                            </div>

                        </div>
                                                      <div class="kv-item ue-clear">
                            <label><span class="impInfo">*</span>邮箱密码</label>
                            <div class="kv-item-content">
                                <input type="password" name="mail_password"  value="<?php echo $email['mail_password']; ?>" />
                            </div>
                        </div>
                                                       <div class="kv-item ue-clear">
                            <label><span class="impInfo">*</span>收件人邮箱</label>
                            <div class="kv-item-content">
                                <input type="text" name="mail_to"  value="<?php echo $email['mail_to']; ?>" />
                            </div>
                        </div>
                        
                          <div class="kv-item ue-clear">
                            <label><span class="impInfo">*</span>发件人昵称</label>
                            <div class="kv-item-content">
                                <input type="text" name="mail_subject"  value="<?php echo $email['mail_subject'] ?>" />
                            </div>
  <span class="Validform_checktip">*对方收到邮件时显示的昵称</span>
                        </div>
                    </div>
                    </div>
                    <div class="buttons">
                        <input class="button" id="allbtn" type="submit" value="保存" />
                           <input type='hidden' name='email' value='edit'>
                    </div>
                </form>
                
                
                
            </div>
        </div>
    </body>
</html>