<?php ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>管理员列表</title>
    <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
</head>
<body>
    
    
<body>
    <div id="main">
        <div class="layui-row new_nav">
            <span class="layui-breadcrumb" lay-separator="">
                <a href="#" onClick="javascript :history.back(-1);"><i class="layui-icon icon iconfont">&#xe62f;</i>返回上一页</a>
                <a href="<?php echo site_url()?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
                <a href="">管理员列表</a>
            </span>
        </div>
        <div class="layui-row new_list_main_operation">
            <div class="layui-col-md2">
                <ul >
                    <li><a href="<?php echo site_url() ?>Admin/show"><i class="icon iconfont">&#xe621;</i>新增</a></li>
                    <li><a href="javascript:;" onclick="list_operation('change')"><i class="layui-icon">&#xe673;</i>审核</a></li>
                    <li><a href="javascript:;" id="delall"><i class="icon iconfont">&#xe74a;</i>全选</a></li>
                    <li><a href="javascript:;" id="alldelete" onclick="list_operation('delete')" ><i class="layui-icon">&#xe640;</i>删除</a></li>
                </ul>
            </div>
            
            <div class="layui-col-md2 layui-col-md-offset8 " >
                <div class="new_list_right">
                    <input type="text" name="keyword" id='serReload' autocomplete="off" > <a id="serach_news" href="javascript:;" data-type="reload"><i class="layui-icon icon iconfont">&#xe618;</i></a>
                </div>
            </div>
        </div>
        <table id="demo" lay-filter="news_table"></table>

        <!--为表格中的title列绑定一个超链接*-->
        <script type="text/html" id="titleTpl">
            <a href="<?php echo site_url() ?>Admin/show/{{d.ID}}"  class="layui-table-link">{{d.UserName}}</a>
        </script>
        <script type="text/html" id="barDemo">

            <a href='<?php echo site_url() ?>Admin/show/{{d.ID}}' class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>  
            <a class="layui-btn layui-btn-xs" lay-event="del">删除</a>     
        </script>
    </div>
    <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/iconfont.js"></script>
    <script>
    layui.use(['jquery', 'form', 'layer', 'table', 'element'], function () {
        var element = layui.element;
        var layer = layui.layer;
        window.jQuery = window.$ = layui.jquery;
        var table = layui.table;

   

        table.render({
            elem: '#demo',
            height: 500,
            limit: 10 //每页5条
            ,
            url: '<?php echo site_url() .$this->router->fetch_class()?>/return_list' //数据接口
            ,
            page: true //开启分页
            ,
            id: 'newsRoload',
            response: {
                statusName: 'status' //规定数据状态的字段名称，默认：code
                ,
                statusCode: 200 //规定成功的状态码，默认：0
                ,
                msgName: 'hint' //规定状态信息的字段名称，默认：msg
                ,
                countName: 'total' //规定数据总数的字段名称，默认：count
                ,
                dataName: 'rows' //规定数据列表的字段名称，默认：data
            }
            // ,limits:[5,10,15]               //每页/条
            ,
            cols: [
                [ //表头
                    {
                        type: 'checkbox'
                    } //开启复选框
                    , {
                        field: 'ID',
                        align: 'center',
                        title: 'ID',
                        width: 150,
                        sort: true
                    }, {
                        field: 'UserName',
                        title: '用户名',
                     
                        templet: '#titleTpl'
                    }, {
                        field: 'nikename',
                        align: 'center',
                        title: '昵称',
                    
                    }, {
                        field: 'islock',
                        align: 'center',
                        title: '状态',
                      
                    }, {
                        field: 'role_name',
                        align: 'center',
                        title: '角色',
                     
                    }, {
                        field: 'ctime',
                        align: 'center',
                        title: '添加时间',
                        width: 250
                    }, {
                        fixed: 'right',
                        title: '操作',
                      
                        align: 'center',
                        toolbar: '#barDemo'
                    }
                ]
            ]

        });
        var active = {
            reload: function () {
                var titleloads = $("#serReload").val();
                if (titleloads == null || titleloads == "" || titleloads == "undefined") {
                    titleloads == "";
                }

                //表格重载（多种搜索）
                table.reload('newsRoload', {
                    where: {
                        keyword: titleloads
                    }
                })
            }
        };

        //监听工具条   监控工具，表头是toolbar，表格是tool
        table.on('tool(news_table)', function (obj) //注释 toolbar 是工具条事件名,news_table是table原始容器的属性lay-filter=“对应的值”
            {
                var data = obj.data; //获取当前行数据
                var layEvent = obj.event; //获取lay-event对应的值
                var tr = obj.tr; //获取当前行的DOM对象
                if (layEvent === 'del') {
                    layer.confirm('确定删除行?', function (index) {
                       // obj.del();
                      //  layer.close(index);
                        deletes(data['id'],"<?php echo site_url().$this->router->fetch_class() ?>/delete");
                    });
                }
            });

        //导航栏删除
        $("#alldelete").click(function () {
            if ($(".layui-form-checkbox").hasClass("layui-form-checked")) {
                var checkStatus = table.checkStatus('newsRoload');
                var data = checkStatus.data;
                var $id = '';
                if (data.length > 0) {
                    layer.confirm('确定删除行?', {
                        btn: ['取消', '确定'],
                        btn2: function (index) {

                            for (var i = 0; i < data.length; i++) {
                                $id += ',' + data[i]['ID']; //这里的ID指代数据中的ID ，要保持和数据库中的字段一致
                            }
                            del_or_change($id,"<?php echo site_url().$this->router->fetch_class() ?>/delete","delete");
                           // console.log(checkStatus.data) //获取选中行的数据
                           // console.log(checkStatus.data.length) //获取选中行数量，可作为是否有选中行的条件
                           // console.log(checkStatus.isAll) //表格是否全选   
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
        //.on将元素添加某个时间
        $("#serach_news").on('click', function () {
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
    });
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/common.js"></script>
        <script>
                        function list_operation($type) {
                            layui.use(['table'], function () {
                                var table = layui.table;
                                $del_msg = "确定删除行";
                                $change_msg = "审核后前台将显示该信息，确定继续吗？";
                                if ($(".layui-form-checkbox").hasClass("layui-form-checked")) {
                                    var checkStatus = table.checkStatus('newsRoload');
                                    var data = checkStatus.data;
                                    var $id = '';
                                    $msg = $type == "delete" ? $del_msg : $change_msg;
                                    if (data.length > 0) {
                                        layer.confirm($msg, {
                                            btn: ['取消', '确定'],
                                            btn2: function (index) {
                                                for (var i = 0; i < data.length; i++) {
                                                    $id += ',' + data[i]['id'];
                                                }
                                                del_or_change($id, "<?php echo site_url() . $this->router->fetch_class() ?>/" + $type, $type);
                                            }
                                        });
                                    }
                                } else {
                                    layer.open({
                                        title: '提示',
                                        content: '请选择你要操作的行！'
                                    });
                                }
                            })
                        }
    </script>
</body>
   
</html>