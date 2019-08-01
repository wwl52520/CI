<?php ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>商品——评论</title>
    <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
    <style>
        .comment_list{font-size: 12px}
        .comment_list p{}
        .comment_list p span{float: right;margin: 0 5px}
        .comment_list p .left_span{float: left;margin: 0 5px}
        .layui-table-cell,.layui-table-tool-panel li{overflow:inherit}
        .layui-table-cell{height: auto}
        .comment_list .reply{    height: 30px;background: #fbf8e7;border: 1px solid #f6e8b9;font-size: 12px;line-height: 30px;}
    </style>
</head>
<body>
    <div id="main">
        <div class="layui-row new_nav">
            <span class="layui-breadcrumb" lay-separator="">
                <a href="#" onClick="javascript :history.back(-1);"><i class="layui-icon icon iconfont">&#xe62f;</i>返回上一页</a>
                <a  href="<?php echo site_url()?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
                <a href="">内容列表</a>
            </span>
        </div>
        <div class="layui-row new_list_main_operation">
            <div class="layui-col-md1.5">
                <ul >
                    <li><a href="javascript:;"  onclick="list_operation('change')" ><i class="layui-icon">&#xe673;</i>审核</a></li>
                    <li><a href="javascript:;" id="delall"><i class="icon iconfont">&#xe74a;</i>全选</a></li>
                    <li><a href="javascript:;" id="alldelete"  onclick="list_operation('delete')"><i class="layui-icon">&#xe640;</i>删除</a></li>
                </ul>
            </div>
            <div class="layui-col-md2">
                <div class="new_list_select">
                    <span>所有属性</span>
                    <div class="icon_right"><i class="layui-icon">&#xe61a;</i></div>
                    <div class="news_list_status">
                        <ul>
                            <li><a href="javascript:;" id='1' name='Status' data-type="reload">已审核</a></li>
                            <li><a href="javascript:;"  id='0' name='Status' data-type="reload">未审核</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="layui-col-md2 layui-col-md-offset6 " >
                <div class="new_list_right">
                    <input type="text" name="keyword" id='serReload' autocomplete="off" > <a id="serach" href="javascript:;" data-type="reload"><i class="layui-icon icon iconfont">&#xe618;</i></a>
                </div>
            </div>
        </div>
        <table id="demo" lay-filter="news_table"></table>

        <!--为表格中的title列绑定一个超链接*-->
        <script type="text/html" id="titleTpl">
            <div class="comment_list">
                <p><a href="<?php echo site_url() ?>Goods_comment/show/{{d.goods_id}}"  class="layui-table-link">{{d.title}}</a><span>{{d.add_time}}</span><span>{{d.user_name}}</span></p>
                <div>
                    <span>{{d.content}}</span>
                    {{# if(d.is_reply==1){ }}
                    <p class="reply"><span class="left_span">管理员回复：{{d.reply_content}}</span><span>{{d.reply_time}}</span></p>
                    {{#} }} 
                </div>
            </div>
        </script>
        <script type="text/html" id="barDemo">
            <a href='<?php echo site_url() ?>Goods_comment/show/{{d.goods_id}}' class="layui-btn layui-btn-xs" lay-event="edit">回复</a>   
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

        //控制分类显示影藏
        $(".new_list_select").click(function () {
            if ($(this).children(".icon_right").next("div").hasClass("show")) {
                $(this).children(".icon_right").next("div").removeClass("show");
            } else {
                $(this).children(".icon_right").next("div").addClass("show");
            }
        });
        table.render({
            elem: '#demo',
            height: 500,
            limit: 10 //每页10条
            ,
            url: '<?php echo site_url() .$this->router->fetch_class()?>/return_list',
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
                        field: 'title',
                        title: '标题',
                        templet: '#titleTpl'
                    },{
                        fixed: 'right',
                        title: '操作',
                        width:150,
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
                var statusload = $(".news_list_status ul li a.checked").attr("name");
                if (statusload == null || statusload == "" || statusload == "undefined") {
                    statusload == "";
                } else {
                    var statuid = $(".news_list_status ul li a.checked").attr("id");
                    statusload = statusload + '=' + statuid;
                }

                //表格重载（多种搜索）
                table.reload('newsRoload', {
                    where: {
                        keyword: titleloads,
                        status: statusload
                    }
                })
            }
        };
        
        //首先判断是否为空
        //然后判断是删除还是改变状态
        
        
        /*
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
                                $id += ',' + data[i]['id'];
                            }
                            deletes($id, "<?php echo site_url().$this->router->fetch_class() ?>/delete");
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
*/
        //.on将元素添加某个时间
        $("#serach").on('click', function () {
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
        $(".news_list_status ul li a").click(function () {
            $(this).addClass("checked");
              $(this).parent("li").siblings("li").children("a").removeClass("checked");
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
                            deletes($id, "<?php echo site_url().$this->router->fetch_class() ?>/"+$type, $type);
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