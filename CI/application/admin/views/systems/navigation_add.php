<?php
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>新增栏目管理</title>
    <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
   <style>
            .uploads{padding: 0!important}
             .layui-form-checkbox i{top:0px!important}
        </style>
</head>
    <body>
        <div id="main">
    <div class="layui-row new_nav">
        <span class="layui-breadcrumb" lay-separator="">
            <a href="#" onclick="javascript :history.back(-1);"><i class="layui-icon icon iconfont">&#xe62f;</i>返回上一页</a>
            <a href="<?php echo site_url()?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
            <a href="javascript:;">栏目新增</a>
        </span>
    </div>
    <form class="layui-form layui-form-pane" action="<?php echo site_url() ?>Navigation/add" method="post">
        <div class="layui-tab">
            <ul class="layui-tab-title">
                <li class="layui-this">新增栏目</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item  tab_content layui-show" pane>

                    <div class="layui-form-item">
                                <label class="layui-form-label">所属类别</label>
                                <div class="layui-input-block">
                                    <select name="city" lay-verify="required" >
                                        <option></option>
                                        <option value="0">无父级栏目</option>
                                        <?php echo $nav_add; ?>
                                    </select>
                                    <input type="hidden" name="id" value="">
                                </div>
                            </div>
                    <div class="layui-form-item" >
                        <label class="layui-form-label">栏目名称</label>
                        <div class="layui-input-inline title">
                            <input type="text" name="title" required lay-verify="required" placeholder="请输入文章标题" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">*栏目名称唯一不可重复</div>
                    </div>
  <div class="layui-form-item" >
                        <label class="layui-form-label">控制器名称</label>
                        <div class="layui-input-inline title">
                            <input type="text" name="controller" required lay-verify="required" placeholder="请输入控制器名称" autocomplete="off" class="layui-input">
                        </div>
                      
                    </div>
                      <div class="layui-form-item" >
                        <label class="layui-form-label">Action名称</label>
                        <div class="layui-input-inline title">
                            <input type="text" name="action" required lay-verify="required" placeholder="请输入Action名称" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid layui-word-aux">*可添加多个 以逗号分隔</div>
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
    <!--为表格中的title列绑定一个超链接*-->

</div>
<script type="text/html" id="barDemo">
    <input type="checkbox" name="checkall"> 
    </script>
<script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>other/layui/iconfont.js"></script>
<script>
                layui.use(['jquery','element', 'layer','form', 'table'], function () {
                    var layer = layui.layer;
                    var form=layui.form;
                    var element=layui.element;
                    window.jQuery = window.$ = layui.jquery;
                    var table = layui.table;

          
             
        form.on('select',function(data)
              {
                    console.log(data.elem); //得到select原始DOM对象
                    console.log(data.value); //得到被选中的值
                    console.log(data.othis); //得到美化后的DOM对象
               $("input[name='id']").attr('value',data.value);
              });
                });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/common.js"></script>
    </body>
</html>