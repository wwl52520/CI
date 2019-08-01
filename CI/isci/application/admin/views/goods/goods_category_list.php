<?php
?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>新闻分类列表</title>
    <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
    <style>
         .iconfont{margin: 0 4px}
         .td_cname{display: block;margin-left: 15px;}
         .iconfont{color:Black;clear: both}
         .offset{ text-align: center;width: 90%; height: 38px;margin:20px 0 5px 10px;border: 1px solid #e6e6e6}
    </style>
</head>

<body>
    <div id="main">
        <div class="layui-row new_nav">
            <span class="layui-breadcrumb" lay-separator="">
                <a href="#" onclick="javascript :history.back(-1);"><i class="layui-icon icon iconfont">&#xe62f;</i>返回上一页</a>
                <a href="<?php echo site_url()?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
                <a href="javascript:;" onclick="exportCate()">分类列表</a>
            </span>
        </div>
        <div class="layui-row new_list_main_operation">
            <div class="layui-col-md12">
                <ul >
                    <li><a href="<?php echo site_url() ?>Goods_category/show"><i class="icon iconfont">&#xe621;</i>新增</a></li>
                    <li><a href="javascript:;" id="delall"><i class="icon iconfont">&#xe74a;</i>全选</a></li>
                    <li><a href="javascript:;" id="alldelete" onclick="list_operation('delete')" ><i class="layui-icon">&#xe640;</i>删除</a></li>
                </ul>
                
            </div>
        </div>
        <table lay-filter="goods_category" lay-data="{id: 'cateRoload'}">
            <thead>
                <tr>
                    <th lay-data="{field:'id',type:'checkbox'}"></th>
                    <th lay-data="{field:'id', width:150, sort:true}">ID</th>
                    <th lay-data="{field:'category_Name', width:800}">分类名称</th>
                    <th lay-data="{field:'sort', sort:true}">排序</th>
                    <th lay-data="{fixed: 'right', width:150, align:'center', toolbar: '#barDemo'}">操作</th>
                </tr> 
            </thead>
            <tbody>
          <?php echo $cate?>
            </tbody>
        </table>
        <!--为表格中的title列绑定一个超链接*-->

        <script type="text/html" id="barDemo">
            <a href='<?php echo site_url() ?>Goods_category/show/{{d.id}}' class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>  
            <a class="layui-btn layui-btn-xs" lay-event="del">删除</a>     
        </script>
    </div>
   
    <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/iconfont.js"></script>
    <script>
layui.use(['jquery', 'layer', 'table', 'element'], function () {
    var element = layui.element;
    var layer = layui.layer;
    window.jQuery = window.$ = layui.jquery;
    var table = layui.table;
    var upload =layui.upload;
      window.localStorage.clear();
              //session存储本页面，F5刷新时保证页面不会丢失
                //这里是设置了一个值，页面刷新时 页面会自动跳到main.php下面，该文件下则将设置的值赋给iframe的src，从而使地址得到保存
                window.localStorage.setItem("thisurl", window.location.href);
    table.init('goods_category', {
        height: '500' //设置高度
        ,
        limit: 100 //注意：请务必确保 limit 参数（默认：10）是与你服务端限定的数据条数一致
    });



    //监听工具条   监控工具，表头是toolbar，表格是tool
    table.on('tool(goods_category)', function (obj) //注释 toolbar 是工具条事件名,news_table是table原始容器的属性lay-filter=“对应的值”
        {
            var data = obj.data; //获取当前行数据
            console.log(data['id']);
            var layEvent = obj.event; //获取lay-event对应的值
            var tr = obj.tr; //获取当前行的DOM对象
            if (layEvent === 'del') {
                layer.confirm('确定删除行?', function (index) {
                    obj.del();
                    layer.close(index);
                    deletes(data['id'],"<?php echo site_url().$this->router->fetch_class() ?>/delete");        //这里的Id字段要与数据库中保持一致
                });
            }
        });

    //导航栏删除
    $("#alldelete").click(function () {
        if ($(".layui-form-checkbox").hasClass("layui-form-checked")) {
            var checkStatus = table.checkStatus('cateRoload');
            var data = checkStatus.data;
          
            var $id = '';
            if (data.length > 0) {
                layer.confirm('本操作会删除本类别及下属子类别，是否继续？', {
                    btn: ['确定', '取消'],
                    yes: function (index) {
                        for (var i = 0; i < data.length; i++) {
                            $id += ',' + data[i]['id'];             ////这里的Id字段要与数据库中保持一致
                        }
                      
                        deletes($id,"<?php echo site_url().$this->router->fetch_class() ?>/delete");
                    }
                });
            }
        } else {
            layer.open({
                title: '提示',
                content: '请选择你要删除的行！'
            });
        }
    });

});


    </script>
       <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/common.js"></script>
</body>
</html>