<?php ?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>栏目管理</title>
    <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
    <style>
        .iconfont{margin: 0 4px;color:Black;font-size: 16px}
        .td_cname{display: block;margin-left: 15px;}
        .layui-form-checkbox i{border-left: 1px solid #d2d2d2;top:1px!important}
        .layui-icon-ok{}
        .layui-table-cell div{margin: 0 5px!important}
        .laytable-cell-1-0-2 i{margin-top: 3px}
        .layui-breadcrumb{visibility:visible}
      
    </style>
</head>
<body>
    <div id="main">
        <div class="layui-row new_nav">
            <span class="layui-breadcrumb" lay-separator="">
                <a href="#" onclick="javascript :history.back(-1);"><i class="layui-icon icon iconfont">&#xe62f;</i>返回上一页</a>
                <a href="<?php echo site_url() ?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
                <a href="javascript:;">栏目管理</a>
            </span>
        </div>

        <div class="layui-row new_list_main_operation">
            <div class="layui-col-md2 ">
                <ul >
                    <li><a href="<?php echo site_url() ?>Navigation/show"><i class="icon iconfont">&#xe621;</i>新增</a></li>
                    <li><a href="javascript:;" id="alldelete" ><i class="layui-icon">&#xe640;</i>修改</a></li>
                </ul>
            </div>
        </div>
        <table class="layui-table tab_content" lay-filter="news_category">
            <thead>
                <tr>
                    <th lay-data="{field:'title', width:300}">导航名称</th>
                    <th lay-data="{field:'powername'}">权限分配</th>

                </tr> 
            </thead>
            <tbody>
<?php echo $nav_list; ?>
            </tbody>
        </table>
    </div>

    <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/iconfont.js"></script>
    <script>
                    layui.use(['jquery', 'element', 'form', 'table'], function () {
                        var layer = layui.layer;
                        var form = layui.form;
                        var element = layui.element;
                        window.jQuery = window.$ = layui.jquery;
                        var table = layui.table;
                        
                        //转换静态表格
                        table.init('news_category', {
                            limit: 100 //注意：请务必确保 limit 参数（默认：10）是与你服务端限定的数据条数一致
                                    //支持所有基础参数
                        });
                    });
    </script>
    <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/common.js"></script>
</body>
</html>