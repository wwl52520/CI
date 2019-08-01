<?php ?>
<html
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>商品——新增</title>
        <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
        <style>
            .uploads{padding: 0!important}
            .layui-form-checkbox i{top:0px!important}
            #demo2 ul{}
            #demo2 ul li{ list-style: none;width: 92px; display: inline-block; margin-right: 15px;}
            #demo2 ul li a{text-align: center;margin-bottom: 10px; display: block;}
            .layui-upload-img{width: 92px; height: 92px; margin: 0 10px 10px 0;border:2px solid red}

        </style>

    </head>
    <body>

        <div id="main">
            <div class="layui-row new_nav">
                <span class="layui-breadcrumb" lay-separator="">
                    <a href="#" onclick="javascript :history.back(-1);"><i class="layui-icon icon iconfont">&#xe62f;</i>返回上一页</a>
                    <a href="<?php echo site_url() ?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
                    <a href="javascript:;">内容列表</a>
                </span>
            </div>
            <form class="layui-form layui-form-pane" action="<?php echo site_url() ?>Goods/add" method="post"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
                <div class="layui-tab">
                    <ul class="layui-tab-title">
                        <li class="layui-this">基本信息</li>
                        <li>详细描述</li>
                        <li>SEO选项</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item  tab_content layui-show" pane>

                            <div class="layui-form-item">
                                <label class="layui-form-label">所属类别</label>
                                <div class="layui-input-block">
                                    <select name="cate_id" lay-verify="required" >
                                        <option></option>
                                        <?php echo $cate; ?>
                                    </select>

                                </div>
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">审核状态</label>
                                <div class="layui-input-block" >
                                    <input type="hidden" name="status" value="0" >
                                    <input type="checkbox" name="status"  checked lay-skin="switch" value="1" lay-filter="status" lay-text="启用|禁用">

                                </div>
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">推荐类型</label>
                                <div class="layui-input-block">
                                    <input type="hidden" name="is_top" value="0"  >
                                    <input type="checkbox" name="is_top" value="0"  title="置顶">
                                    <input type="hidden" name="is_red" value="0" >
                                    <input type="checkbox" name="is_red" value="0" title="推荐">
                                    <input type="hidden" name="is_msg" value="0"  >
                                    <input type="checkbox" name="is_msg" value="0" title="评论">
                                    <input type="hidden" name="is_slide" value="0"  >
                                    <input type="checkbox" name="is_slide" value="0" title="幻灯片">
                                </div>
                            </div>

                            <div class="layui-form-item" >
                                <label class="layui-form-label">内容标题</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="title" required lay-verify="required" placeholder="请输入文章标题" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">标题最多100个字符</div>
                            </div>

                            <div class="layui-form-item" >
                                <label class="layui-form-label">副标题</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="sub_title"  autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">可为空，最多100个字符</div>
                            </div>


                            <div class="layui-form-item" >
                                <label class="layui-form-label">图片上传</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="img_url" placeholder="请输入" autocomplete="off"　 class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux uploads">
                                    <button type="button" class="layui-btn" id="upload">
                                        <i class="layui-icon ">&#xe67c;</i>上传图片
                                    </button>
                                </div>
                            </div>
                            <!--判断是否为商城-->
                            <?php
                            $site = $this->session->userdata("sites");
                            if ($site['is_shop']) {
                                ?>

                                <div class="layui-form-item" >
                                    <label class="layui-form-label">商品货号</label>
                                    <div class="layui-input-inline title">
                                        <input type="text" name="goods_no"  autocomplete="off" class="layui-input" value="">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">允许字母、下划线，100个字符内</div>
                                </div>

                                <div class="layui-form-item" >
                                    <label class="layui-form-label">库存数量</label>
                                    <div class="layui-input-inline sort">
                                        <input type="text" name="stock" placeholder="0" autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">库存数量为0时显示缺货状态</div>
                                </div>
                                <div class="layui-form-item" >
                                    <label class="layui-form-label">市场价格</label>
                                    <div class="layui-input-inline sort">
                                        <input type="text" name="market_price" placeholder="0" autocomplete="off" class="layui-input"><span>元</span>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">市场的参与价格，不参与计算</div>
                                </div>
                                <div class="layui-form-item" >
                                    <label class="layui-form-label">销售价格</label>
                                    <div class="layui-input-inline sort">
                                        <input type="text" name="sell_price" placeholder="0" autocomplete="off" class="layui-input"><span>元</span>
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">*出售的实际交易价格</div>
                                </div>
                                <div class="layui-form-item" >
                                    <label class="layui-form-label">交易积分</label>
                                    <div class="layui-input-inline sort">
                                        <input type="text" name="point" placeholder="0" autocomplete="off" class="layui-input">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux">*正为返还，负为消费积分</div>
                                </div>

                                <?php
                            }
                            if ($site['is_spec']) {
                                ?>
                                <div class="layui-form-item" >
                                    <label class="layui-form-label">商品规格</label>
                                    <div class="layui-input-inline sort">
                                        <a class="layui-btn" href="javascript:;" onclick="spec_add()">设置规格</a>
                                    </div>

                                </div>
                                <!--商品规格列表-->
                                <div class="table-container" style="    margin-bottom: 20px; margin-left: 110px;">
                                    <input type="hidden" name="goods_spec_list" id="goods_spec_list" value="">
                                    <table border="0" cellspacing="0" cellpadding="0" class="border-table" width="82%">
                                        <thead>
                                            <tr>
                                                <th align="center" width="15%">货号</th>
                                                <th width="8%">市场价(元)</th>
                                                <th width="8%">销售价(元)</th>
                                                <th width="8%">库存(件)</th>
                                                <th width="30%">规格</th>

                                            </tr>
                                        </thead>
                                        <tbody id="item_box"></tbody>
                                    </table>
                                </div>

                            <?php } ?>

                            <div class="layui-form-item" >
                                <label class="layui-form-label">排序数字</label>
                                <div class="layui-input-inline sort">
                                    <input type="text" name="sort" placeholder="99" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">数字越小,越靠前</div>
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">浏览量</label>
                                <div class="layui-input-inline sort">
                                    <input type="text" name="click" placeholder="1" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">浏览页面,该数字+1</div>
                            </div>

                            <div class="layui-form-item" >
                                <label class="layui-form-label">发布时间</label>
                                <div class="layui-input-inline" style="position:relative;">
                                    <input type="text" name="add_time" value="<?php echo Date('Y-m-d H:i:s', time()) ?>" class="layui-input" id="addate">
                                    <i class="layui-icon add_time">&#xe637;</i>
                                </div>
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">图片相册</label>
                                <div class="layui-input-inline title">
                                </div>
                                <div class="layui-form-mid layui-word-aux uploads">
                                    <button type="button" class="layui-btn" id="pl_upload">
                                        <i class="layui-icon ">&#xe67c;</i>批量上传
                                    </button>
                                </div>
                            </div>
                            <blockquote  style="margin-left:110px">
                                <div class="layui-upload-list" id="demo2">
                                    <ul>

                                    </ul>
                                </div>

                        </div>
                        <div class="layui-tab-item tab_content"> 
                            <div class="layui-form-item" style="width:100%" >
                                <label class="layui-form-label">内容</label>
                                <div class="layui-input-inline content">
                                    <textarea id="content" name="content" style="width: 94%;height:400px" >
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="layui-tab-item tab_content ">

                            <div class="layui-form-item" >
                                <label class="layui-form-label">SEO标题</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="seo_title" placeholder="请输入文章标题" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">标题最多50个字符</div>
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">SEO关键字</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="seo_keywords" placeholder="请输入文章标题" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">关键字最多100个字符</div>
                            </div>

                            <div class="layui-form-item layui-form-text ">
                                <label class="layui-form-label">SEO描述</label>
                                <div class="layui-input-block">
                                    <textarea name="seo_description" placeholder="请输入内容" class="layui-textarea"></textarea>
                                </div>
                                <div class="layui-form-mid layui-word-aux">描述最多个字符</div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item form_btn">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
                    </div>
            </form>
        </div>
        <div id="spec_list" style="margin-top:30px">
            <?php foreach ($spec_list as $value): ?>
                <?php if ($value['pid'] == 0) { ?>
                    <dl>
                        <dt><?php echo $value['title']; ?></dt>
                        <dd>
                            <ul class="spec-item">
                                <?php
                                foreach ($spec_list as $childs) {
                                    if ($childs['pid'] == $value['id']) {
                                        echo "<li pid='" . $childs['pid'] . "' pname='" . $value['title'] . "' id='" . $childs['id'] . "' value='" . $childs['title'] . "' img='" . $childs['img_url'] . "'  ><a title='" . $childs['title'] . "' href='javascript:;'><i>" . $childs['title'] . "</i></a></li>";
                                    }
                                }
                                ?>
                            </ul>
                        </dd>
                    </dl>
                <?php } ?>
            <?php endforeach; ?>
        </div>    

        <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/iconfont.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/kindeditor/kindeditor.js"></script>  
        <script charset="utf-8" src="<?php echo base_url(); ?>other/kindeditor/lang/zh-CN.js"></script>
        <script>
                                            layui.use(['jquery', 'form', 'laydate', 'layer', 'upload', 'element'], function () {
                                                var form = layui.form;
                                                var upload = layui.upload;
                                                var element = layui.element;
                                                var laydate = layui.laydate;
                                                window.jQuery = window.$ = layui.jquery;

                                                //执行一个laydate实例
                                            laydate.render({
    elem: '#addate',
     type:'datetime',
     format:'yyyy-MM-dd HH:mm'
     });
                                                // 执行图片上传实例
                                                upload.render({
                                                    elem: '#upload',
                                                    field: 'userfile' //定义上传文件的name值
                                                    ,
                                                    url: '<?php echo site_url() . $this->router->fetch_class() ?>/return_img',
                                                    done: function (res) {
                                                        $("input[name='img_url']").attr('value', res.data);
                                                    }, error: function () {
                                                        alert('上传接口有误');
                                                    }
                                                });

                                                var num = 0;
                                                upload.render({
                                                    elem: '#pl_upload',
                                                    field: 'userfile' //定义上传文件的name值
                                                    ,
                                                    url: '<?php echo site_url() . $this->router->fetch_class() ?>/return_img',
                                                    multiple: true //允许上传多个
                                                            // ,auto:false      //不自动上传
                                                            // ,bindAction:'#upload'
                                                    ,
                                                    done: function (res) {
                                                        $('#demo2 ul').append('<li><img src="/' + res.data + '"   class="layui-upload-img"><a id="img_del_' + num + '" href="javascript:;" onclick="img_del(this)" >删除</a></li>'); //预览图
                                                        $("#demo2").append("<input type='hidden' name='albums[]' value=" + res.data + ">");
                                                        num++;
                                                    }, error: function () {
                                                        alert('上传接口有误');
                                                    }
                                                });

                                                //switch事件监听
                                                form.on('switch(status)', function (data) {
                                                    if (data.elem.checked === true) {
                                                        $("input[name='status']").attr('value', 1);
                                                    } else {
                                                        $("input[name='status']").attr('value', 0);
                                                    }

                                                });
                                                //checkox事件监听
                                                form.on('checkbox', function (data) {
                                                    if (data.elem.checked === true) {
                                                        data.elem.value = "1";
                                                    } else {
                                                        data.elem.value = "0";
                                                    }
                                                });

                                                $(".spec-item li").click(function () {
                                                    $(this).toggleClass('selected');
                                                });



                                            });
        </script> 
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/common.js"></script>
        <script>
                                            function spec_add() {
                                                var res_array = [];
                                                var res_array2 = [];
                                                var goods_spec_list = '';
                                                var goods_no = '';
                                                layui.use(['upload'], function () {
                                                    layer.open({
                                                        type: 1,
                                                        title: '商品规格',
                                                        content: $('#spec_list'),
                                                        area: ['540px', '325px'],
                                                        btn: ['确定', '取消'],
                                                        yes: function (index) {
                                                            //首先清除#goods_spec,#hide_goods_spec_list  方便比如要重新添加规格的时候，就将旧的删掉
                                                            $("#goods_spec_list").val(0);
                                                            $("#item_box tr").remove();
                                                            $(".spec-item").each(function (i) {
                                                                var temps = [];
                                                                var temps2 = [];
                                                                var parent_info = '';
                                                                //这一部分是填充好goods_spec数据表需要的字段信息放在id=goods_spec的div中
                                                                $(".spec-item").eq(i).children("li").each(function (j) {
                                                                    //判断父规格下是否有子规格选中
                                                                    if ($(this).hasClass("selected")) {
                                                                        //获取父类的值用于笛卡尔积数据返回显示在商品货号列表
                                                                        temps[j] = $(this).attr('pname') + ":" + $(this).attr('value');
                                                                        temps2[j] = $(this).attr('id');

                                                                        if ($(this).attr('img').length < 1)
                                                                        {
                                                                            $(this).attr('img', '*');
                                                                        }
                                                                        //得到规格父类的信息
                                                                        parent_info = $(this).attr('pid') + "--" + "0" + "--" + $(this).attr('pname') + "--" + "*" + "|";
                                                                        //得到规格子类的信息
                                                                        goods_spec_list += $(this).attr('id') + "--" + $(this).attr('pid') + "--" + $(this).attr('value') + "--" + $(this).attr('img') + '|';
                                                                    }
                                                                    //去掉最后一个逗号
                                                                });
                                                                goods_spec_list = parent_info + goods_spec_list;
                                                                //如果数组为空就不赋值,因为存在不是所有的item_box的ul下面都有规格选中 所以这里要过滤掉空的
                                                                if (temps.length > 0)
                                                                {
                                                                    res_array[i] = temps;
                                                                    res_array2[i] = temps2;
                                                                }
                                                            });

                                                            $("#goods_spec_list").prop('value', goods_spec_list);
                                                            //获取笛卡尔积返回的数据
                                                            $retrun_result = return_descartes(res_array);
                                                            console.log($retrun_result);
                                                            $retrun_result2 = return_descartes(res_array2);
                                                            //如果商品货号为空 则用随机数
                                                            if ($("input[name='goods_no']").val().length < 1) {
                                                                goods_no = "SD" + MathRandGoodNo(10);
                                                            } else {
                                                                goods_no = $("input[name='goods_no']").val();
                                                            }

                                                            //填充table中,数据用于goods_spec_item表
                                                            for (var i = 0; i < $retrun_result.length; i++) {
                                                                $("#item_box ").append("<tr>\n\
                                                 <td><input type='text'name='spec_goods_no[]'class='td-input' value='" + goods_no + "-" + (i + 1) + "' /></td>\n\
                                                 <td><input type='text'name='spec_market_price[]' class='td-input' value='0'></td>\n\
                                                 <td><input type='text' name='spec_sell_price[]' class='td-input' value='0'></td>\n\
                                                 <td><input type='text' name='spec_stock[]' class='td-input' value='0'></td>\n\
                                                 <td>\n\
                                                     <input type='hidden' name='spec_ids[]'value='" + $retrun_result2[i] + "' >\n\
                                                     <input type='hidden' name='spec_text[]'value='" + $retrun_result[i] + "' >\n\
                                                     <p style='color:#666'>" + $retrun_result[i] + "</p>\n\
                                                </td>\n\
                                                 </tr>");
                                                            }
                                                            layer.close(index); //如果设定了yes回调，需进行手工关闭
                                                        },
                                                        cancel: function (index) {
                                                            layer.close(index); //如果设定了yes回调，需进行手工关闭
                                                        }
                                                    });
                                                });
                                            }
                                            ;

                                            //获取商品规格的笛卡尔积
                                            function return_descartes(res_arr) {
                                                var result = res_arr.reduce((last, current) => {
                                                    const array = [];
                                                    last.forEach(par1 => {
                                                        current.forEach(par2 => {
                                                            array.push(par1 + ',' + par2);
                                                        });
                                                    });
                                                    return array;
                                                });
                                                return result;
                                            }

                                            //生成随机货号
                                            function MathRandGoodNo(n) {
                                                var num = "";
                                                for (var i = 0; i < n; i++) {
                                                    num += Math.floor(Math.random() * 10);
                                                }
                                                return num;
                                            }

                                            //相册图片删除
                                            function img_del(data) {
                                                // $("#"+$id.data()).parent("li").remove();
                                                //获取img的src
                                                var $src = $(data).prev("img").attr("src");
                                                //删除当前的li
                                                $(data).parent("li").remove();
                                                $("input[name='albums[]']").each(function () {
                                                    if ($src == "/" + $(this).val()) {
                                                        $(this).remove();
                                                    }
                                                })
                                            }
        </script>

    </body>
</html>