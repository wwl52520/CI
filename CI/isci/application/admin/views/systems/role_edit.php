<?php
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>修改角色管理</title>
    <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
    <style>

        .iconfont{margin: 0 4px;color:Black;font-size: 16px}
        .td_cname{display: block;margin-left: 15px;}
        .layui-form-checkbox i{border-left: 1px solid #d2d2d2}
        .layui-icon-ok{}
        .layui-table-cell div{margin: 0 5px!important}
        .laytable-cell-1-0-2 i{margin-top: 3px}
        .layui-breadcrumb{visibility:visible}
        .layui-form-checkbox i{top:0!important}
    </style>
</head>

</head>
<body>
<div id="main">
    <div class="layui-row new_nav">
        <span class="layui-breadcrumb" lay-separator="">
            <a href="#" onclick="javascript :history.back(-1);"><i class="layui-icon icon iconfont">&#xe62f;</i>返回上一页</a>
            <a href="<?php echo site_url()?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
            <a href="javascript:;">角色管理编辑</a>
        </span>
    </div>
    <form class="layui-form layui-form-pane" action="<?php echo site_url() ?>Role/edit" method="post">
        <div class="layui-tab">
            <ul class="layui-tab-title">
                <li class="layui-this">编辑角色管理</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item  tab_content layui-show" pane>

                    <div class="layui-form-item" >
                        <label class="layui-form-label">角色名称</label>
                        <div class="layui-input-inline title">
                            <input type="text" name="role_name" required lay-verify="required" placeholder="请输入文章标题" autocomplete="off" class="layui-input" value="<?php echo $role['role_name']?>" >
                        </div>
                        <div class="layui-form-mid layui-word-aux">*角色名称唯一不可更改</div>
                    </div>

                    <table class="layui-table" lay-filter="news_category">
                        <thead>
                            <tr>
                                <th lay-data="{field:'title', width:300}">导航名称</th>
                                <th lay-data="{field:'powername', width:998}">权限分配</th>
                                <th lay-data="{fixed: 'right', width:168, align:'center', toolbar: '#barDemo'}">操作</th>
                            </tr> 
                        </thead>
                        <tbody>
                            <?php echo $tree_nav;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
              <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    <input type="hidden" name="role_id" value="<?php echo $role['id']?>">
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
       layui.use(['jquery','element', 'layer', 'form', 'table'], function () {
        var layer = layui.layer;
        var form = layui.form;
        var element=layui.element;
     window.jQuery = window.$ = layui.jquery;
     var table = layui.table;
     $('body', parent.document).css({"overflow-y":"auto"});

     
     
     //转换静态表格
     table.init('news_category', {
         limit: 100 //注意：请务必确保 limit 参数（默认：10）是与你服务端限定的数据条数一致
             //支持所有基础参数
     });
 $(".layui-table-fixed-r").remove();
     //单个权限分配
     var $checkid = $(".checkid").next('div');
     var $role_cate;
     $checkid.click(function () {
         if ($(this).hasClass("layui-form-checked")) {
             $(this).prev(".checkid").attr("checked", true);
         } else {
             $(this).prev(".checkid").attr("checked", false);
         }
     });

     //控制全选
     var $allcheck = $("input[name='checkall']").next('div');
     var $role_cate;
     $allcheck.click(function () {
         if ($(this).hasClass("layui-form-checked")) {
             $role_cate = $(this).parent("div").parent("td").prev("td").children().children(".layui-form-checkbox");
             $role_cate.addClass("layui-form-checked");
             $role_cate.prev(".checkid").attr("checked", true);
         } else {
             $role_cate = $(this).parent("div").parent("td").prev("td").children().children(".layui-form-checkbox");
             $role_cate.removeClass("layui-form-checked");
             $role_cate.prev(".checkid").attr("checked", false);
         }
     });
     $(function () {
         $.ajax({
             url: '<?php echo site_url().$this->router->fetch_class() ?>/rule_load',
             type: "post",
             dateType: "",
             data: {
                 "id": '<?php echo $this->uri -> segment(3);?>'
             },
             error: function () {
                     alert('载入失败');
                 },
                 success: function (data) {
                     $rules = data.split(',');
                     $ruleslist = $("input[name='allck[]']");
                     for (var j in $ruleslist) {
                         for (var i in $rules) {
                             if ($rules[i] === $ruleslist[j].value) {
                                 $ruleslist.eq(j).attr('checked', "checked");
                                 $ruleslist.eq(j).next('div').addClass('layui-form-checked');
                             }
                         }
                     }
                 }
         });
     });
 });         
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/common.js"></script>
</body>
</html>