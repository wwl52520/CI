<?php ?>
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
                <a href="<?php echo site_url() ?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
                <a href="javascript:;" onclick="exportCate()">分类列表</a>
            </span>
        </div>
        <div class="layui-row new_list_main_operation">
            <div class="layui-col-md12">
                <ul >
                    <li><a href="<?php echo site_url() ?>News_category/show"><i class="icon iconfont">&#xe621;</i>新增</a></li>

                    <li><a href="javascript:;" id="delall"><i class="icon iconfont">&#xe74a;</i>全选</a></li>
                    <li><a href="javascript:;" id="alldelete"  onclick="list_operation('delete')"><i class="layui-icon">&#xe640;</i>删除</a></li>
                    <li><a href="javascript:;" id="excel_file" ><i class="layui-icon">&#xe67c;</i>导入文件</a></li>
                    <li><a href="javascript:;" onclick="exportCate()"><i class="layui-icon">&#xe67c;</i>导出文件</a></li>
                </ul>
            </div>
        </div>
        <table lay-filter="news_category" lay-data="{id: 'cateRoload'}">
            <thead>
                <tr>
                    <th lay-data="{field:'id',type:'checkbox'}"></th>
                    <th lay-data="{field:'id', width:150, sort:true}">ID</th>
                    <th lay-data="{field:'category_Name'}">分类名称</th>
                    <th lay-data="{field:'sort', sort:true}">排序</th>
                    <th lay-data="{fixed: 'right',  align:'center', toolbar: '#barDemo'}">操作</th>
                </tr> 
            </thead>
            <tbody>
                <?php echo $cate ?>
            </tbody>
        </table>
        <!--为表格中的title列绑定一个超链接*-->

        <script type="text/html" id="barDemo">
            <a href='<?php echo site_url() ?>News_category/show/{{d.id}}' class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>  
            <a class="layui-btn layui-btn-xs" lay-event="del">删除</a>     
        </script>
    </div>

    <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/iconfont.js"></script>
    <script>
                        layui.use(['jquery', 'layer', 'upload', 'table', 'element'], function () {
                            var element = layui.element;
                            var layer = layui.layer;
                            window.jQuery = window.$ = layui.jquery;
                            var table = layui.table;
                            var upload = layui.upload;

                            table.init('news_category', {
                                height: '500' //设置高度
                                ,
                                limit: 100 //注意：请务必确保 limit 参数（默认：10）是与你服务端限定的数据条数一致
                            });

                            var uploadInst = upload.render({
                                elem: '#excel_file',
                                field: 'excel_file' //定义上传文件的name值
                                ,
                                url: '<?php echo site_url() . $this->router->fetch_class() ?>/excel_put',
                                accept: "file"
                                        //  ,multiple:true    //允许上传多个
                                        //auto:false      //不自动上传
                                        // ,bindAction:'#upload'
                                ,
                                done: function (res) {
                                    layer.open({
                                        title: '提示',
                                        content: '上传' + res['total'] + '条,成功' + res['success'] + '条,失败' + res['error'] + '条',
                                        btn: ['确定'],
                                        yes: function () {
                                            window.location.reload();
                                        }
                                    });
                                }, error: function () {
                                    alert('上传接口有误');
                                }
                            });

                            //监听工具条   监控工具，表头是toolbar，表格是tool
                            table.on('tool(news_category)', function (obj) //注释 toolbar 是工具条事件名,news_table是table原始容器的属性lay-filter=“对应的值”
                            {
                                var data = obj.data; //获取当前行数据
                                console.log(data['id']);
                                var layEvent = obj.event; //获取lay-event对应的值
                                var tr = obj.tr; //获取当前行的DOM对象
                                if (layEvent === 'del') {
                                    layer.confirm('确定删除行?', function (index) {
                                        obj.del();
                                        layer.close(index);
                                        del_or_change(data['id'], "<?php echo site_url() . $this->router->fetch_class() ?>/delete", "delete"); //这里的Id字段要与数据库中保持一致
                                    });
                                }
                            });
                        });

                        function exportCate() {
                            layui.use(['layer'], function () {
                                var layer = layui.layer;
                                layer.open({
                                    type: 1,
                                    title: '请输入要导出的分类数量',
                                    content: "<input type='text' class='offset layui-layer-input' value='100'>",
                                    time: 5000,
                                    btn: ['确定', '取消'],
                                    yes: function (index) {
                                        var $offset = $(".offset").val();
                                        window.location.href = '<?= site_url() ?>news_category/excel_export?offset=' + $offset;
                                        layer.close(index);
                                    }
                                })
                            })
                        }
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
                                    var checkStatus = table.checkStatus('cateRoload');
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