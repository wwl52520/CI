<?php ?>
<html
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>新增栏目地址</title>
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



    </head>
    <body>
        <div id="container">
            <?php $this->load->view('header'); ?>
            <div id="bd">
                <?php $this->load->view('Left_Nav') ?>
                 <h3 class="subfild">
                    <span class="span_one">基本信息</span>
                 
                </h3>
                <form method="post" action="<?php echo base_url() ?>systems/navigation_add"  id='addnew' class="demoform" enctype="multipart/form-data" style="width: 1600px">
                    <div id="main" class="main" >
                        <div class="subfild-content base-info">
                            <div class="kv-item ue-clear">
                                <label>栏目总览</label>
                                <div class="kv-item-content" id="selecate">
                                    <select>
                                        <option value="0">大分类</option>
                                        <?php foreach ($list as $item) : ?>
                                            <?php if ($item['pid'] == 0) 
                                                {   
                                                $items = explode(",", $item['powername']);
                                                echo " <option value='" . $item['id'] . "'>"."&nbsp;&nbsp;&nbsp;&nbsp;" . $item['title'] . "</option>";
                                                foreach ($list as $chitem) {
                                                    if ($chitem['pid'] != 0 && $chitem['pid'] == $item['id']) {
                                                        $chtems = explode(",", $chitem['powername']);
                                                        echo " <option value='" . $chitem['id'] . "'>"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". '├'  . $chitem['title'] . "</option>";
                                                    }
                                                }
                                            }
                                            ?>
                                        <?php endforeach; ?>

                                    </select>
                                    <input type="text"  style="display:none;"  name="newtype"  value="">
                                </div>
                            </div>
                          
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>栏目名称</label>
                                <div class="kv-item-content">
                                    <input type="text" name="title" placeholder="文章标题" value=" " />
                                </div>
                                <span class="Validform_checktip">*标题最多60个字符</span>
                            </div>
                          
                           <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>Controller</label>
                                <div class="kv-item-content">
                                    <input type="text" name="controller" placeholder="Controller" value=" " />
                                </div>
                                <span class="Validform_checktip">*Controller</span>
                            </div>
                           <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>Action</label>
                                <div class="kv-item-content">
                                    <input type="text" name="action" placeholder="Action" value=" " />
                                </div>
                                <span class="Validform_checktip">3级目录输入多个，单个则请以’,‘结尾</span>
                            </div>
                            
                        </div>
                        
                        
                       
                    </div>
                    
                    <div class="buttons" > 
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