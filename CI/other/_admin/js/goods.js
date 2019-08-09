 //页面加载完判断按钮状态
    //按钮状态    
    window.onload = function () {
        $("input[name='status']").each(function () {
            if ($(this).val() == 0) {
                $(this).next('div').removeClass('layui-form-onswitch');
                $(this).next('div').children("em").text("关闭");

            } else {
                $(this).next('div').addClass('layui-form-onswitch');
                $(this).next('div').children("em").text("开启");
            }
        });
       //复选框状态
       $("#goods_type input").each(function () {
            var values = $(this).val();
            if (values == 1) {
                $(this).next('div').addClass('layui-form-checked');
                $(this).prev().attr('value', 1);
            }
        });
    }
        //商品规格增加
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
                offset: '300px',
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

                                    if ($(this).attr('img').length < 1) {
                                        $(this).attr('img', '*');
                                    }
                                    //得到规格父类的信息
                                    parent_info = $(this).attr('pid') + "-" + "0" + "-" + $(this).attr('pname') + "-" + "*" + "|";
                                    //得到规格子类的信息
                                    goods_spec_list += $(this).attr('id') + "-" + $(this).attr('pid') + "-" + $(this).attr('value') + "-" + $(this).attr('img') + '|';
                                }
                                //去掉最后一个逗号
                            });
                            goods_spec_list = parent_info + goods_spec_list;
                            //如果数组为空就不赋值,因为存在不是所有的item_box的ul下面都有规格选中 所以这里要过滤掉空的
                            if (temps.length > 0) {
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
            if ($src == "<?php echo base_url()?>" + $(this).val()) {
                $(this).remove();
            }
        });
    };