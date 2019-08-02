<?php ?>
<html
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>规格——修改</title>
        <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
        <style>
            .uploads{padding: 0!important}
            .layui-layer-content .layui-form-item{width: 100%}
            #spec_list{display: none}
            #layui-layer-content #spec_list{display: block}
            #spec_list .layui-form-label{border-width:0;border-style:none}
            .hide_spec{}
            .border-table{min-width: 500px;border-width: 1px;margin: 0;background: #fff;}
            .border-table th, .border-table td{    margin: 0; padding: 2px 10px; line-height: 26px; height: 28px;border: 1px solid #eee; vertical-align: middle;  white-space: nowrap; word-break: keep-all;}
            .border-table thead th{    margin: 0;padding: 2px 10px; line-height: 26px; height: 28px; border: 1px solid #eee; vertical-align: middle;white-space: nowrap;word-break: keep-all;font-size: 12px}
             .border-table td{text-align: center;font-size: 12px}
            .border-table td .img-box {display: inline-block;height: 32px;vertical-align: middle;margin: 0 40%}
            .border-table td .img-box img { padding: 1px;width: 30px;height: 30px;border: 1px solid #eee;}
            .border-table td i{margin-right: 6px}
        </style>

    </head>
    <body>

        <div id="main">
            <div class="layui-row new_nav">
                <span class="layui-breadcrumb" lay-separator="">
                    <a href="<?php echo "<script>history.go(-1);</script>"; ?>"><i class="layui-icon icon iconfont">&#xe62f;</i>返回上一页</a>
                    <a href="<?php echo site_url() ?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
                    <a href="javascript:;">内容列表</a>
                </span>
            </div>
            
            <form class="layui-form layui-form-pane" action="<?php echo site_url() ?>Goods_spec/edit" method="post"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
                <div class="layui-tab">
                    <ul class="layui-tab-title">
                        <li class="layui-this">基本信息</li>
                      
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item  tab_content layui-show" pane>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">规格名称</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="title" required lay-verify="required"  autocomplete="off" class="layui-input" value="<?= $list[0]['title']?>" >
                                </div>
                            </div>
                    
                            
                                <div class="layui-form-item" >
                                <label class="layui-form-label">备注说明</label>
                                <div class="layui-input-inline title">
                                     <textarea name="remake"  class="layui-textarea" style="min-height:70px"><?=$list[0]['remake']?></textarea>
                                </div>
                            </div>
                            
                            
                            <div class="layui-form-item" >
                                <label class="layui-form-label">排序数字</label>
                                <div class="layui-input-inline sort">
                                    <input type="text" name="sort_id" placeholder="99" autocomplete="off" class="layui-input"  value="<?=$list[0]['sort_id']?>">
                                </div>
                                
                            </div>


                            <div id="spec_list" style="margin-top:30px">
                                <div class="layui-form-item" >
                                    <label class="layui-form-label">规格名称</label>
                                    <div class="layui-input-inline title">
                                        <input type="text" name="spec_title"   autocomplete="off" class="layui-input" >
                                    </div>
                                </div>
                                <div class="layui-form-item" >
                                    <label class="layui-form-label">图片上传</label>
                                    <div class="layui-input-inline title">
                                        <input type="text" name="spec_img"  autocomplete="off"　 class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux uploads">
                                        <button type="button" class="layui-btn" id="upload">
                                            浏览..
                                        </button>
                                    </div>
                                </div>
                                <div class="layui-form-item" >
                                    <label class="layui-form-label">排序数字</label>
                                    <div class="layui-input-inline sort">
                                        <input type="text" name="spec_sort" autocomplete="off" class="layui-input">
                                    </div>
                                </div>
                                <div class="layui-form-mid layui-word-aux" style="float:none;text-align:center;font-size: 12px;padding: 0!important;line-height: 0px;color:#666;">提示：未上传图片则显示文字选项</div>
                            </div>
                           
                            <div class="layui-form-item" >
                                <label class="layui-form-label">商品规格</label>
                                <div class="layui-input-inline sort">
                                    <a id="spec_add" class="layui-btn" href="javascript:;" onclick="spec_add()">设置规格</a>
                                </div>
                            </div>
                            <div class="hide_spec">
                                <table border="0" cellspacing="0" cellpadding="0" class="border-table">
                                    <thead>
                                    <tr>
                                        <th width="12%">名称</th>
                                        <th width="16%">图片</th>
                                        <th width="12%">排序</th>
                                        <th width="10%">操作</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                      
                                            foreach ($list as $chil_item) {
                                                if($chil_item['pid']==$list[0]['id'])
                                                {
                                                echo "<tr>";
                                                echo "<input type='hidden'name='spec_content[]' value=" . $chil_item['title'] . "|" . $chil_item['img_url'] . "|" . $chil_item['sort_id'] . ">";
                                                echo "<td><span>" . $chil_item['title'] . "</span></td>";
                                                if ($chil_item['img_url'] == FALSE) {
                                                    echo "<td><span class='img-box'></span></td>";
                                                } else {
                                                    echo "<td><span class='img-box'><img src='/" . $chil_item['img_url'] . "'></span></td>";
                                                }
                                                echo "<td>" . $chil_item['sort_id'] . "</td>";
                                                echo "<td><a href='javascript:;' onclick='spec_edit(this)'><i class='layui-icon'></i></a><a href=' javascript:;' onclick='spec_del(this)'><i class='layui-icon'></i></a></td>";
                                                echo "</tr>";
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>

                    </div>
                    <div class="layui-form-item form_btn">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            <input type="hidden" name="id" value="<?=$list[0]['id']?>">
                        </div>
                    </div>
            </form>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/iconfont.js"></script>
        <script>
            layui.use(['jquery', 'form', 'upload', 'element'], function () {
                var form = layui.form;
                var upload = layui.upload;
                var element = layui.element;
                window.jQuery = window.$ = layui.jquery;
                upload.render({
                    elem: '#upload',
                    field: 'userfile', //定义上传文件的name值
                    url: '<?php echo site_url() . $this->router->fetch_class() ?>/return_img',
                    done: function (res,index) {
                        $("input[name='spec_img']").prop('value', res.data);
                       img_contents=res.data;
                    }, error: function () {
                        alert('上传接口有误');
                    }
                });

            });
        </script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/common.js"></script>
        <script>
    var img_contents = '';
    
    function spec_add() {
        assignment_input();
        layui.use(['upload'], function () {
            layer.open({
                type: 1,
                title: '商品规格',
                content: $('#spec_list'),
                area: ['540px', '325px'],
                btn: ['确定', '取消'],
                yes: function (index) {
                        img_contents = $("input[name='spec_title']").val() + '|' + $("input[name='spec_img']").val() + '|' + $("input[name='spec_sort']").val();
                        $imgs = "/" + $("input[name='spec_img']").val();
                        $(".hide_spec table tbody").append("<tr><input type='hidden' name='spec_content[]' value=" + img_contents + "><td><span  >" + $("input[name='spec_title']").val() + "</span></td><td><span class='img-box'><img src=" + $imgs + "></span></td><td>" + $("input[name='spec_sort']").val() + "</td><td><a href='javascript:;' onclick='spec_edit(this)'><i  class='layui-icon'>&#xe642;</i></a><a href='javascript:;' onclick='spec_del(this)'><i class='layui-icon'>&#xe640;</i></a></td></tr>");
                        layer.close(index); //如果设定了yes回调，需进行手工关闭
                    },
                    cancel: function (index) {
                        layer.close(index); //如果设定了yes回调，需进行手工关闭
                    }
            });
        });
    };

    function spec_edit(current) {
        $content = $(current).parent("td").siblings("input[name='spec_content[]']").val(); //获取新增的三个input的总值
        var $res = new Array();
        $res = $content.split("|");
        $("#spec_list input[type='text']").each(function (i) {
            $(this).prop('value', $res[i]);
        });
        layui.use(['upload'], function () {
            layer.open({
                type: 1,
                title: '商品规格',
                content: $('#spec_list'),
                area: ['540px', '325px'],
                btn: ['确定', '取消'],
                yes: function (index) {
                        $(current).parent("td").parent("tr").remove();
                        img_contents = $("input[name='spec_title']").val() + '|' + $("input[name='spec_img']").val() + '|' + $("input[name='spec_sort']").val();
                        $imgs = "/" + $("input[name='spec_img']").val();
                        $(".hide_spec table tbody").append("<tr><input type='hidden' name='spec_content[]' value=" + img_contents + "><td><span  >" + $("input[name='spec_title']").val() + "</span></td><td><span class='img-box'><img src=" + $imgs + "></span></td><td>" + $("input[name='spec_sort']").val() + "</td><td><a href='javascript:;' onclick='spec_edit(this)'><i  class='layui-icon'>&#xe642;</i></a><a href='javascript:;' onclick='spec_del(this)'><i class='layui-icon'>&#xe640;</i></a></td></tr>");
                        layer.close(index); //如果设定了yes回调，需进行手工关闭
                       // assignment_input();
                    },
                    cancel: function (index) {
                        layer.close(index);
                    }
            });
           
        });
    };

    function spec_del(current) {
        $(current).parent("td").parent("tr").remove();
    }

    //赋值input
    function assignment_input() {
        $("#spec_list input").each(function () {
            $(this).prop('value','');
        });
    }
</script>
    </body>
</html>