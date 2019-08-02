<?php ?>
<html
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>新增会员组别</title>
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
            .kv-item label,.kv-item .kv-item-label{position:relative;float:left;padding-left:7px;width: 8em;height:26px;line-height:26px;}
            .kv-item input[type=text], .kv-item textarea, .kv-item input[type=password], .kv-item input[type=file], .kv-item .file{}
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

                <form method="post" action="<?php echo base_url() ?>user_group/add"  id='edit' class="demoform" enctype="multipart/form-data" style="width: 1600px">
                    <div id="main" class="main" >
                        <div class="subfild-content base-info">
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>组别名称</label>
                                <div class="kv-item-content">
                                    <input type="text" name="title" placeholder="用户名" value=" " />
                                </div>

                            </div>
                            <div class="kv-item ue-clear">
                                <label>注册会员默认组</label>
                                <div class="kv-item-content xszt">
                                    <a id='1'  href='javascript:void(0)'>是</a>
                                    <a id='0' href='javascript:void(0)'   class='selected'>否</a>
                                    <input type="text" style="display:none;" name="is_default" value="0">
                                </div>
                            </div>
                            <div class="kv-item ue-clear">
                                <label>参与自动升级</label>
                                <div class="kv-item-content sexss">

                                    <a id='1'  href='javascript:void(0)' >是</a>
                                    <a id='0' href='javascript:void(0)' class='selected'>否</a>

                                    <input type="text" style="display:none;" name="is_grade_up" value="0">
                                </div>
                            </div>


                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>等级值</label>
                                <div class="kv-item-content">
                                    <input type="text" name="grade" placeholder="等级值" value=" " />
                                </div>
                                <span class="Validform_checktip">*升级顺序，取值范围1-100，等级值越大，会员等级越高。</span>
                            </div>

                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>升级所需积分</label>
                                <div class="kv-item-content">
                                    <input type="text" name="upgrade_exp" placeholder="升级所需积分" value=" " />
                                </div>
                                <span class="Validform_checktip">自动升级所需要的积分。</span>
                            </div>
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>初始金额</label>
                                <div class="kv-item-content">
                                    <input type="text" name="amount" placeholder="初始金额" value=" " />
                                </div>
                                <span class="Validform_checktip">*自动到该会员组赠送的金额，负数则扣减。</span>
                            </div>
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>初始积分</label>
                                <div class="kv-item-content">
                                    <input type="text" name="point" placeholder="初始积分" value=" " />
                                </div>
                                <span class="Validform_checktip">*自动到该会员组赠送的积分，负数则扣减。</span>
                            </div>
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>购物折扣</label>
                                <div class="kv-item-content">
                                    <input type="text" name="discount" placeholder="初始金额" value=" " />
                                </div>
                                <span class="Validform_checktip">购物享受的折扣，取值范围：1-100。</span>
                            </div>


                        </div>
                    </div>

                    <div class="buttons" > 
                        <input class="button"  type="submit" value="确认" />
                        <input type="hidden"  name='btn' value="edit">
                        <input type="hidden"  name='id' value="">

                    </div>
            </div>
        </form>

    </div>
</div>
</body>
</html>