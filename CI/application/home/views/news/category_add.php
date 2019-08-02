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
        <script>
        $(function()
        {
         $id= $("input[name='newtype']").val();
          $("#selecate option").each(function ()
                {
                    if ($(this).val() === $id)
                    {
                        $(this).attr('selected', 'selected');

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
                    <span class="span_three">SEO选项</span>
                </h3>
                <volist name='list' id='edit'>
                    <form method="post" action="<?php echo base_url() ?>news_category/add"  id='editnew' class="demoform" enctype="multipart/form-data" style="width: 1600px">
                        <div id="main" class="main" >
                            <div class="subfild-content base-info">
                                <div class="kv-item ue-clear">
                                    <label>所属类别</label>
                                    <div class="kv-item-content" id="selecate">
                                        <select id="selecate">
                                            <?php
                                            foreach ($category as $item) {
                                                if ($item['pid'] == '0') {
                                                    echo '<option value=' . $item['Id'] . '>' . $item['category_Name'] . '</option>';
                                                    foreach ($category as $sitem) {
                                                        if ($sitem['pid'] == $item['Id'] && $sitem['pid'] != '0') {
                                                            echo '<div>';
                                                            echo '<option value=' . $sitem['Id'] . ' >' . '├' . $sitem['category_Name'] . '</option>';
                                                            echo '</div>';
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden"  name="newtype" value="<?php if(isset($list['id'])){echo $list['id'];}?>">
                                        
                                    </div>
                                </div>
                                <div class="kv-item ue-clear">
                                    <label><span class="impInfo">*</span>文章标题</label>
                                    <div class="kv-item-content">
                                        <input type="text" name="category_Name" placeholder="文章标题" value="" />
                                    </div>
                                    <span class="Validform_checktip">*标题最多60个字符</span>
                                </div>

                                <div class="kv-item ue-clear">
                                    <label><span class="impInfo">*</span>排序数字</label>
                                    <div class="kv-item-content">
                                        <input type="text" name="sort" placeholder="99" class="sort" value="" />
                                    </div>
                                    <span class="kv-item-tip">数字越小，越靠前</span>
                                </div>

                            </div>
                            <div class="kv-item ue-clear"style="height:auto">
                                <label><span class="impInfo">*</span>内容描述</label>
                                <textarea id="editor_id" name="editor_id" style="width: 94%;height:400px" >
                                        
                                </textarea>
                            </div>
                        </div>

                        <div id="main3" style="display: none"  class="main">
                            <div class="subfild-content base-info">
                                <div class="kv-item ue-clear">
                                    <label><span class="impInfo">*</span>SEO标题</label>
                                    <div class="kv-item-content">
                                        <input type="text" name="seo_title" placeholder="SEO标题" datatype="*2-100" sucmsg=" "  value=""/>
                                    </div>
                                    <span class="Validform_checktip">*非必填 最多250个字</span>
                                </div>
                                <div class="kv-item ue-clear">
                                    <label><span class="impInfo">*</span>SEO关健字</label>
                                    <div class="kv-item-content">
                                        <input type="text" name="seo_keywords" placeholder="SEO关健字" datatype="*2-100" sucmsg=" " value=" " />
                                    </div>
                                    <span class="Validform_checktip">最多255个字</span>
                                </div>
                                <div class="kv-item ue-clear">
                                    <label><span class="impInfo">*</span>SEO描述</label>
                                    <div class="kv-item-content">
                                        <input type="text" name="seo_description" placeholder="SEO描述" datatype="*2-100" sucmsg=" " value=" " />
                                    </div>
                                    <span class="Validform_checktip">最多255个字</span>
                                </div>
                            </div>
                        </div>
                        <div class="buttons" style="clear:both"> 
                            <input class="button"  type="submit" value="确认" />
                             <input type="hidden"  name='btn' value="add">
                         
                        </div>
                        </div>
                    </form>
                </volist>
            </div>
        </div>
    </body>
</html>