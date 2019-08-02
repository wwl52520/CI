<?php ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>消费记录</title>
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
                <a href="">会员充值列表</a>
            </span>
        </div>
        <div class="layui-row new_list_main_operation">
            <div class="layui-col-md2">
                <ul >
                    <li><a href="<?= site_url()?>User_recharge/show"><i class="icon iconfont">&#xe74a;</i>新增</a></li>
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

    

        table.render({
            elem: '#demo',
            height: 500,
            limit: 10 //每页5条
            ,
            url: '<?php echo site_url(). $this->router->fetch_class()?>/return_list' //数据接口
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
                        type: 'checkbox',title:'选择'
                    } //开启复选框
                    ,{
                        field: 'user_name',
                        title: '用户名',
                        
                    }, {
                        field: 'recharge_no',
                        align: 'center',
                        title: '订单号',
                       
                    },{
                        field: 'payment_id',
                        title: '支付方式',
                        
                    },  {
                        field: 'amount',
                        align: 'center',
                        title: '金额',
                      
                    },  {
                        field: 'status',
                        align: 'center',
                        title: '状态',
                      
                    },{
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
            if ($(".layui-form-checkbox").hasClass("layui-form-checked")) {
                var checkStatus = table.checkStatus('amountRoload');
                var data = checkStatus.data;
                var $id = '';
                if (data.length > 0) {
                    layer.confirm('确定删除行?', {
                        btn: ['取消', '确定'],
                        btn2: function (index) {
                            for (var i = 0; i < data.length; i++) {
                                $id += ',' + data[i]['id']; //这里的ID指代数据中的ID ，要保持和数据库中的字段一致
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