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
            #main2 .kv-item input[type=text]{width: 50px}
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
                    <span class="span_three">账户信息</span>
                </h3>

                <form method="post" action="<?php echo base_url() ?>user/edit"  id='edit' class="demoform" enctype="multipart/form-data" style="width: 1600px">
                    <div id="main" class="main" >
                        <div class="subfild-content base-info">
                            <div class="kv-item ue-clear">
                                <label>所属组别</label>
                                <div class="kv-item-content" id="selecate">
                                    <select>
                                        <?php
                                        foreach ($user_group as $group) {
                                            if ($group['id'] == $list['group_id']) {
                                                echo '<option value=' . $group['id'] . ' selected="selected" >' . $group['title'] . '</option>';
                                            }
                                            echo '<option value=' . $group['id'] . ' >' . $group['title'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <input type="text"  style="display:none;"  name="newtype"  value="<?php echo $list['group_id']; ?>">
                                </div>
                            </div>
                            <div class="kv-item ue-clear">
                                <label>显示状态</label>
                                <div class="kv-item-content xszt">
                                    <?php
                                    if ($list['status'] == "1") {
                                        echo "<a id='1'  href='javascript:void(0)' class='selected'>正常</a>";
                                        echo "<a id='2' href='javascript:void(0)' >禁用</a>";
                                        echo "<a  id='0' href='javascript:void(0)'>待审核</a>";
                                    } else if ($list['status'] == "2") {
                                        echo "<a id='1' href='javascript:void(0)'>正常</a>";
                                        echo "<a id='2' href='javascript:void(0)'  class='selected' >禁用</a>";
                                        echo "<a id='0' href='javascript:void(0)'>待审核</a>";
                                    } else {
                                        echo "<a id='1' href='javascript:void(0)'>正常</a>";
                                        echo "<a id='2' href='javascript:void(0)'  >禁用</a>";
                                        echo "<a id='0' href='javascript:void(0)'  class='selected'>待审核</a>";
                                    }
                                    ?>
                                    <input type="text" style="display:none;" name="status" value="<?php echo $list['status']; ?>">
                                </div>
                            </div>

                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>用户名</label>
                                <div class="kv-item-content">
                                    <input type="text" name="user_name" placeholder="用户名" value=" <?php echo $list['user_name'] ?>" />
                                </div>
                                <span class="Validform_checktip">*登录的用户名</span>
                            </div>
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>登录密码</label>
                                <div class="kv-item-content">
                                    <input type="password" name="password" placeholder="登录密码" value=" <?php echo $list['password'] ?>" />
                                </div>
                                <span class="Validform_checktip">*登录的密码，至少6位</span>
                            </div>
   <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>联系方式</label>
                                <div class="kv-item-content">
                                    <input type="text" name="tel" placeholder="登录密码" value=" <?php echo $list['tel'] ?>" />
                                </div>
                                <span class="Validform_checktip">联系方式</span>
                            </div>
                             <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>邮箱账号</label>
                                <div class="kv-item-content">
                                    <input type="text" name="email" placeholder="邮箱账号" value=" <?php echo $list['email'] ?>" />
                                </div>
                                <span class="Validform_checktip">邮箱账号</span>
                            </div>
      <div class="kv-item ue-clear time">
                                    <label><span class="impInfo">*</span>生日日期</label>
                                    <div class="kv-item-content">
                                        <input type="text" name="birthaday" placeholder="发布时间" onfocus="WdatePicker({dateFmt: 'yyyy-MM-dd HH:mm:ss'})" value="<?php echo date('y-m-d h:m:s', $list['birthaday']); ?>" />
                                        <i class="time-icon"></i>

                                    </div>
                                </div>
                            
                                <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>通讯地址</label>
                                <div class="kv-item-content">
                                    <input type="text" name="address" placeholder="通讯地址" value=" <?php echo $list['address'] ?>" />
                                </div>
                                <span class="Validform_checktip">通讯地址</span>
                            </div>
                            
                            
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>上传图片</label>
                                <div class="kv-item-content file" style="width: 355px">
                                    <span class="text"> <?php echo $list['img'] ?></span>
                                    <input type="file" name="userfile" id="userfile"/>
                                    <input type="button" class="button normal long2" value="浏览.."  style="top: -23px" />
                                </div>

                            </div>
                       
                            <div class="kv-item ue-clear">
                                <label>用户性别</label>
                                <div class="kv-item-content sexs ">
                                    <?php
                                    if ($list['sex'] == "男") {
                                        echo "<a href='javascript:void(0)' class='selected'>男</a>";
                                        echo "<a href='javascript:void(0)'>女</a>";
                                        echo "<a href='javascript:void(0)'>保密</a>";
                                    } else if ($list['sex'] == "女") {
                                        echo "<a href='javascript:void(0)'>男</a>";
                                        echo "<a href='javascript:void(0)' class='selected' >女</a>";
                                        echo "<a href='javascript:void(0)>保密</a>";
                                    } else {
                                        echo "<a href='javascript:void(0)' >男</a>";
                                        echo "<a href='javascript:void(0)' >女</a>";
                                        echo "<a href='javascript:void(0)' class='selected'>保密</a>";
                                    }
                                    ?>
                                    <input type="text" style="display:none;" name="sex" value="<?php echo $list['sex']; ?>">
                                </div>
                            </div>

                


                        </div>
                    </div>
                    <div id="main2" style="display: none"  class="main">
                        <div class="subfild-content base-info">
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>账户金额</label>
                                <div class="kv-item-content">
                                    <input type="text" name="amount" placeholder="SEO标题" datatype="*2-100" sucmsg=" "  value="<?php echo $list['amount'] ?>"/>
                                </div>
                                <span class="Validform_checktip">*账户上的余额</span>
                            </div>
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>账户积分</label>
                                <div class="kv-item-content">
                                    <input type="text" name="point" placeholder="SEO关健字" datatype="*2-100" sucmsg=" " value=" <?php echo $list['point'] ?>" />
                                </div>
                                <span class="Validform_checktip">*积分也可做为交易</span>
                            </div>
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>经验值</label>
                                <div class="kv-item-content">
                                    <input type="text" name="exp" placeholder="SEO描述" datatype="*2-100" sucmsg=" " value=" <?php echo $list['exp'] ?>" />
                                </div>
                                <span class="Validform_checktip">最多255个字</span>
                            </div>
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>注册时间</label>
                                <div class="kv-item-content">
                                    <p><?php echo Date('Y-m-d H:i:s', $list['createtime']) ?></p>
                                </div>
                            </div>
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>注册IP</label>
                                <div class="kv-item-content">
                                    <p><?php echo $list['reg_ip'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="buttons" style="clear:both"> 
                        <input class="button"  type="submit" value="确认" />
                        <input type="hidden"  name='btn' value="edit">
                        <input type="hidden"  name='id' value="<?php echo $list['id']; ?>">
                        <input type="hidden"  name='img' value="<?php echo $list['img']; ?>">
                    </div>
            </div>
        </form>

    </div>
</div>
</body>
</html>