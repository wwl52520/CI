<?php ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>管理日志</title>
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
                <a href="">管理日志</a>
            </span>
        </div>
        <div class="layui-row new_list_main_operation">
            <div class="layui-col-md2">
                <ul >
                    <li><a href="javascript:;" id="alldelete" ><i class="layui-icon">&#xe640;</i>删除日志</a></li>
                </ul>
            </div>
            
            <div class="layui-col-md2 layui-col-md-offset8 " >
                <div class="new_list_right">
                    <input type="text" name="keyword" id='serReload' autocomplete="off" > <a id="serach_news" href="javascript:;" data-type="reload"><i class="layui-icon icon iconfont">&#xe618;</i></a>
                </div>
            </div>
        </div>
        <table id="demo" lay-filter="amount_table"></table>
    </div>
    <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/iconfont.js"></script>
    <script>
    layui.use(['jquery', 'form', 'layer', 'table', 'element'], function () {
        var element = layui.element;
        var layer = layui.layer;
        window.jQuery = window.$ = layui.jquery;
        var table = layui.table;

        window.localStorage.clear();
        //session存储本页面，F5刷新时保证页面不会丢失
        //这里是设置了一个值，页面刷新时 页面会自动跳到main.php下面，该文件下则将设置的值赋给iframe的src，从而使地址得到保存
        window.localStorage.setItem("thisurl", window.location.href);

        table.render({
            elem: '#demo',
            height: 500,
            limit: 10 //每页5条
            ,
            url: '<?php echo site_url() .$this->router->fetch_class() ?>/return_list' //数据接口
            ,
            page: true //开启分页
            ,
            id: 'amountRoload',
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
                        type: 'checkbox',
                        title: '选择'
                    } //开启复选框
                    , {
                        field: 'user_name',
                        title: '用户名',
                      
                        templet: '#titleTpl'
                    }, {
                        field: 'action_type',
                        align: 'center',
                        title: '操作类型',
                      
                    }, {
                        field: 'remark',
                        align: 'center',
                        title: '备注',
                        
                    }, {
                        field: 'user_ip',
                        align: 'center',
                        title: '用户IP',
                       
                    }, {
                        field: 'add_time',
                        align: 'center',
                        title: '生成时间',
                       
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
                table.reload('amountRoload', {
                    where: {
                        keyword: titleloads
                    }
                })
            }
        };

        //导航栏删除
        $("#alldelete").click(function () {
            layer.confirm('删除7天前的管理日志，你确定吗?', {
                btn: ['取消', '确定'],
                btn2: function (index) {
                    $.ajax({
                        url: "<?php echo site_url().$this->router->fetch_class(); ?>/delete",
                        type: "post",
                        error: function () {},
                            success: function (data) {
                                window.location.reload();
                                layer.msg('删除' + data + '条记录!', {
                                    icon: 1,
                                    time: 2000
                                });
                            }
                    });
                }
            })
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
</body>

</html>
