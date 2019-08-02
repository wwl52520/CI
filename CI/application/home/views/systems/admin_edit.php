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


        <script type="text/javascript">
            KindEditor.ready(function (K) {
                var editor1 = K.create('textarea[name="editor_id"]', {
                    cssPath: '"<?php echo base_url(); ?>other/kindeditor/plugins/code/prettify.css',
                    uploadJson: '"<?php echo base_url(); ?>other/kindeditor/php/upload_json.php',
                    fileManagerJson: '"<?php echo base_url(); ?>other/kindeditor/php/file_manager_json.php',
                    allowFileManager: true,
                    afterCreate: function () {
                        var self = this;
                        K.ctrl(document, 13, function () {
                            self.sync();
                            K('form[name=example]')[0].submit();
                        });
                        K.ctrl(self.edit.doc, 13, function () {
                            self.sync();
                            K('form[name=example]')[0].submit();
                        });
                    }
                });
            });

        </script>
   
    </head>
    <body>
        <div id="container">
            <?php $this->load->view('header'); ?>
            <div id="bd">
                <?php $this->load->view('Left_Nav') ?>
                <h3 class="subfild">
                    <span class="span_one">基本信息</span>
                </h3>
                <form method="post" action="<?php echo base_url() ?>admin/edit"  id='editnew' class="demoform" enctype="multipart/form-data" style="width: 1600px">
                    <div id="main" class="main" >
                        <div class="subfild-content base-info">
                            <div class="kv-item ue-clear">
                                <label>所属类别</label>
                                <div class="kv-item-content" >
                                    <select id="selecate">
                                        <option value="0">请选择</option>
                                        <?php foreach ($admin_role as $item): ?>
                                            <?php
                                            if ($item['id'] == $admin_list['role_id']) {
                                                echo"  <option selected='selected'  value=" . $item['id'] . ">" . $item['role_name'] . "</option>  ";
                                            } else {
                                                echo"  <option  value=" . $item['id'] . ">" . $item['role_name'] . "</option>  ";
                                            }
                                            ?>

                                        <?php endforeach; ?>
                                    </select>
                                    <input type="text"  style="display:none;"  name="newtype"  value="<?php echo $admin_list['role_id'] ?>">
                                </div>
                            </div>
                            <div class="kv-item ue-clear">
                                <label>显示状态</label>
                                <div class="kv-item-content xszt">
                                    <?php
                                    if ($admin_list['islock'] == 1) {
                                        echo "<a id='1' href='javascript:void(0)' class='selected'>启用</a>";
                                        echo " <a id='0' href='javascript:void(0)'>禁用</a>";
                                    } else {
                                        echo "<a  id='1' href='javascript:void(0)' >启用</a>";
                                        echo " <a id='0' href='javascript:void(0)' class='selected'>禁用</a>";
                                    }
                                    ?>
                                    <input type="hidden"  name="islock" value="<?php echo  $admin_list['islock']; ?>">
                                </div>
                            </div>
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>用户名</label>
                                <div class="kv-item-content">
                                    <input type="text" name="UserName" placeholder="用户名" value="<?php echo $admin_list['UserName'] ?> " />
                                </div>
                            </div>
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>登录密码</label>
                                <div class="kv-item-content">
                                    <input type="password" name="Password" placeholder="登录密码" value="<?php echo $admin_list['Password'];?> " />
                                </div>
                            </div>

                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>昵称</label>
                                <div class="kv-item-content">
                                    <input type="text" name="nikename" placeholder="昵称" value=" <?php echo $admin_list['nikename'] ?>" />
                                </div>
                            </div>
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>电话</label>
                                <div class="kv-item-content">
                                    <input type="text" name="telephone" placeholder="电话" value=" <?php echo $admin_list['telephone'] ?>" />
                                </div>
                            </div>

                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>上传图片</label>
                                <div class="kv-item-content file" style="width: 355px">
                                    <span class="text"> <?php echo $admin_list['img'] ?></span>
                                    <input type="file" name="userfile" id="userfile"/>
                                    <input type="button" class="button normal long2" value="浏览.."  style="top: -23px" />
                                </div>
                            </div>
                        </div>
                        <div class="buttons" > 
                            <input class="button"  type="submit" value="确认" />
                            <input type="hidden"  name='id' value="<?php echo $admin_list['ID'] ?>">

                        </div>
                    </div>

                </form>
            </div>
        </div>
    </body>
</html>