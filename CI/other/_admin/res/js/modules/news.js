layui.define(['jquery', 'form', 'layer', 'table', 'element'], function(exports){
    var element = layui.element;
    var layer = layui.layer;
    window.jQuery = window.$ = layui.jquery;
    var table = layui.table;

       window.localStorage.clear();
              //session存储本页面，F5刷新时保证页面不会丢失
                //这里是设置了一个值，页面刷新时 页面会自动跳到main.php下面，该文件下则将设置的值赋给iframe的src，从而使地址得到保存
                window.localStorage.setItem("thisurl", window.location.href);

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
        url: "<?php echo site_url() ?>news/return_list" 
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
                    field: 'id',
                    align: 'center',
                    title: 'ID',
                    width: 120,
                    sort: true
                }, {
                    field: 'title',
                    title: '标题',
                    width: 300,
                    templet: '#titleTpl'
                }, {
                    field: 'category_Name',
                    align: 'center',
                    title: '分类名称',
                    width: 300
                }, {
                    field: 'Status',
                    align: 'center',
                    title: '审核状态',
                    width: 100
                }, {
                    field: 'nsort',
                    align: 'center',
                    title: '排序',
                    width: 150,
                     sort: true
                }, {
                    field: 'click',
                    align: 'center',
                    title: '点击量',
                    width: 150,
                    sort: true
                }, {
                    field: 'addate',
                    align: 'center',
                    title: '发布时间',
                    width: 250
                }, {
                    fixed: 'right',
                    title: '操作',
                    width: 220,
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
                    deletes(data['id']);
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
                            $id += ',' + data[i]['id'];
                        }
                        deletes($id);
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

    //控制全选
    $("#delall").click(function () {
        $("input:checkbox").next("div").toggleClass("layui-form-checked");
    });

    //列表数据删除
    function deletes($id) {
        $.ajax({
            url: "<?php echo site_url() ?>news/delete",
            type: "post",
            dataType: "json",
            data: {
                'iditem': $id
            },
            error: function () {
                },
                success: function (data) {
                    if (data.count > 0) {
                       $(".layui-form-checked").parents("tr").remove(); //删除dom元素
                        layer.msg('删除成功！', {
                            icon: 1,
                            time: 2000
                        });
                        window.location.reload();
                    }
                }
        });
    }

    //.on将元素添加某个时间
    $("#serach_news").on('click', function () {
        var type = $(this).data('type');
        active[type] ? active[type].call(this) : '';
    });
    $(".news_list_cate ul li a").click(function () {
        $(this).addClass("checked");
        $(this).parent("li").siblings("li").children("a").removeClass("checked");
        var type = $(this).data('type');
        active[type] ? active[type].call(this) : '';
    });
    $(".news_list_status ul li a").click(function () {
        $(this).addClass("checked");
        var type = $(this).data('type');
        active[type] ? active[type].call(this) : '';
    });
})
