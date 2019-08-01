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
                    <span class="span_three">SEO选项</span>
                </h3>

                <form method="post" action="<?php echo base_url() ?>news/add"  id='addnew' class="demoform" enctype="multipart/form-data" style="width: 1600px">
                    <div id="main" class="main" >
                        <div class="subfild-content base-info">
                            <div class="kv-item ue-clear">
                                <label>所属类别</label>
                                <div class="kv-item-content" id="selecate">
                                    <select>
                                        <option value="0">请选择</option>
                                        <?php foreach ($category as $item): ?>
                                            <option value="<?php echo $item['Id']; ?>"><?php echo $item['category_Name']; ?></option>   
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="text"  style="display:none;"  name="newtype"  value="">
                                </div>
                            </div>
                            <div class="kv-item ue-clear">
                                <label>显示状态</label>
                                <div class="kv-item-content xszt">

                                    <a id="1"  href='javascript:void(0)' class='selected'>已审核</a>
                                    <a id="0" href='javascript:void(0)'>未审核</a>
                                    <input type="hidden"  name="status" value="1">
                                </div>

                            </div>
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>文章标题</label>
                                <div class="kv-item-content">
                                    <input type="text" name="title" placeholder="文章标题" value=" " />
                                </div>
                                <span class="Validform_checktip">*标题最多60个字符</span>
                            </div>
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>上传图片</label>
                                <div class="kv-item-content file" style="width: 355px">
                                    <span class="text"> </span>

                                    <input type="file" name="userfile" id="userfile"/>
                                    <input type="button" class="button normal long2" value="浏览.."  style="top: -23px" />

                                </div>

                            </div>
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>排序数字</label>
                                <div class="kv-item-content">
                                    <input type="text" name="sort" placeholder="99" class="sort" value="" />
                                </div>
                                <span class="kv-item-tip">数字越小，越靠前</span>
                            </div>
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>浏览量</label>
                                <div class="kv-item-content">
                                    <input type="text" name="click" placeholder="0" class="sort" value="" />
                                </div>
                                <span class="kv-item-tip">浏览页面，该数字+1</span>
                            </div>
                            <div class="kv-item ue-clear time">
                                <label><span class="impInfo">*</span>发布时间</label>
                                <div class="kv-item-content">
                                    <input type="text" name="addate" placeholder="发布时间" onfocus="WdatePicker({dateFmt: 'yyyy-MM-dd HH:mm:ss'})" value="" />
                                    <i class="time-icon"></i>

                                </div>
                            </div>
                            <div style="width:150px;height:120px;margin-left:50px">
                                <input type="hidden" name="img" value="">

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
                        <input type="hidden"  name='id' value="">
                        <input type="hidden"  name='img' value="">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>