<?php ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>产品列表</title>
    <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
    <style>
       .goods_attribute{}
       
       .goods_attribute{ display:inline-block; height:26px;  vertical-align:middle; }
		 .goods_attribute a{ display:block; float:left; margin:0 1px; padding:0; width:26px; height:26px; line-height:26px; text-align:center; border:1px solid #eee;  background:#fff; overflow:hidden; }
		 .goods_attribute a:first-child{}
         .goods_attribute a:hover{ text-decoration:none; }
        .goods_attribute a i{ color:#b6b6b6; font-size:16px; }
       .seleted{}
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
            <div class="layui-col-md2">
                <ul >
                    <li><a href="<?php echo site_url() ?>Goods/show"><i class="icon iconfont">&#xe621;</i>新增</a></li>
                    <li><a href="javascript:;" onclick="list_operation('change')"><i class="layui-icon">&#xe673;</i>审核</a></li>
                    <li><a href="javascript:;" id="delall"><i class="icon iconfont">&#xe74a;</i>全选</a></li>
                    <li><a href="javascript:;" id="alldelete" onclick="list_operation('delete')" ><i class="layui-icon">&#xe640;</i>删除</a></li>
                </ul>
            </div>
            <div class="layui-col-md2">
                <div class="new_list_select">
                    <span>所有类别</span>
                    <div class="icon_right"><i class="layui-icon">&#xe61a;</i></div>
                    <div class="news_list_cate">
                        <ul>
                        <?php echo $cate; ?>
                        </ul>
                    </div>
                </div>
                <div class="new_list_select">
                    <span>所有属性</span>
                    <div class="icon_right"><i class="layui-icon">&#xe61a;</i></div>
                    <div class="news_list_status">
                        <ul>
                            <li><a href="javascript:;" id='1' name='Status' data-type="reload">已审核</a></li>
                            <li><a href="javascript:;"  id='0' name='Status' data-type="reload">未审核</a></li>
                            <li><a href="javascript:;" id='1' name='is_top' data-type="reload">置顶</a></li>
                            <li><a href="javascript:;" id='1' name='is_slide' data-type="reload">幻灯片</a></li>
                            <li><a href="javascript:;" id='1' name='is_red' data-type="reload">推荐</a></li>
                            <li><a href="javascript:;" id='1' name='is_msg' data-type="reload">评论</a></li>
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
            <a href="<?php echo site_url() ?>Goods/show/{{d.cid}}/{{d.id}}"  class="layui-table-link">{{d.title}}</a>
        </script>
        <script type="text/html" id="attributeTpl">
            <div class="layui-row goods_attribute" id="{{d.id}}">
                <a hre='javascript:;'id='{{d.is_msg}}' name='is_msg'    onclick="change_attribute(this)">  <i  class="icon iconfont {{# if(d.is_msg==1) { }} selectd  {{#  } }}">&#xe63f;</i></a>
                <a hre='javascript:;' id='{{d.is_red}}' name='is_red'   onclick="change_attribute(this)" ><i  class="layui-icon  {{# if(d.is_red==1){ }}  selectd  {{# }}} " >&#xe6c6;</i></a>
                <a hre='javascript:;' id='{{d.is_top}}' name='is_top'    onclick="change_attribute(this)" ><i  class="layui-icon  {{# if(d.is_top==1) { }}   selectd  {{# } }} ">&#xe619;</i></a>
                <a hre='javascript:;'id='{{d.is_slide}}' name='is_slide' onclick="change_attribute(this)" ><i  class="layui-icon   {{# if(d.is_slide==1) { }} selectd  {{# } }} ">&#xe634;</i></a>
            </div>
        </script>
        <script type="text/html" id="barDemo">
            <a href='<?php echo site_url() ?>Goods/show/{{d.cid}}/{{d.id}}' class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>  
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
                    }, {
                        field: 'category_Name',
                        align: 'center',
                        title: '分类名称',
                       
                    }, {
                        field: 'status',
                        align: 'center',
                        title: '审核状态'
                    }, {
                        field: 'sort',
                        align: 'center',
                        title: '排序',
                         width:100,
                        sort: true
                    }, {
                        field: 'click',
                        align: 'center',
                        title: '属性',
                        width:200,
                        templet: '#attributeTpl',
                    }, {
                        field: 'add_time',
                        align: 'center',
                        title: '发布时间',
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
                var cateloads = $(".news_list_cate ul li a.checked").attr('id');
                if (cateloads == null || cateloads == "" || cateloads == "undefined") {
                    cateloads == "";
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
                        category: cateloads,
                        status: statusload
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
                        obj.del();
                        layer.close(index);
                        deletes(data['id'], "<?php echo site_url().$this->router->fetch_class() ?>/delete");
                    });
                }
            });
     
    });
</script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/common.js"></script>
        <script>
        function change_attribute(index)
        {
         $val=$(index).attr('id');
         $id=$(index).parent("div").attr('id');
         $name=$(index).attr('name');
         if($val==1){
             $val=0;
         }else{
             $val=1;
         }
        $.ajax({
            url:'<?php echo site_url() .$this->router->fetch_class()?>/change_attribute',
            type:'post',
            data:{'name':$name,'val':$val,'id':$id},
            error:function()
                {
                },
            success:function(data)
            {
                if(data>0)
                {
                    if($(index).children("i").hasClass("selectd"))
                    {
                        $(index).children("i").removeClass("selectd");
                    }
                    else
                    {
                         $(index).children("i").addClass("selectd");
                    }
                }
            }
        });

        }
        
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