<?php ?>
<html
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>会员组别——修改</title>
        <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
        <style>
            .layui-form-item{width: 1000px}
            .uploads{padding: 0!important}
            .layui-form-pane .layui-form-label{width: 130px}
        </style>

    </head>
    <div id="main">
        <div class="layui-row new_nav">
            <span class="layui-breadcrumb" lay-separator="">
                <a href="#" onclick="javascript :history.back(-1);"><i class="layui-icon icon iconfont">&#xe62f;</i>返回上一页</a>
                <a href="<?php echo site_url()?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
                <a href="javascript:;">会员组别修改</a>
            </span>
        </div>
        <form class="layui-form layui-form-pane" action="<?php echo site_url() ?>User_group/edit" method="post"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this">基本信息</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item  tab_content layui-show" pane>


                        <div class="layui-form-item" >
                            <label class="layui-form-label">组别名称</label>
                            <div class="layui-input-inline title">
                                <input type="text" name="title"  lay-verify="required" required lay-verify="user_name"  autocomplete="off" class="layui-input" value="<?php echo $list['title'] ?>">
                            </div>

                        </div>

                        <div class="layui-form-item" >
                            <label class="layui-form-label">注册会员默认组</label>
                            <div class="layui-input-inline checkbtn" >
                                <input type="hidden" name="is_default" value="0">
                                <input type="checkbox" name="is_default"  lay-skin="switch" lay-filter="is_default" lay-text="是|否" value="<?php echo $list['is_default'] ?>">
                            </div>

                        </div>

                        <div class="layui-form-item" >
                            <label class="layui-form-label">参与自动升级</label>
                            <div class="layui-input-inline checkbtn" >
                                <input type="hidden" name="is_grade_up" value="0">
                                <input type="checkbox"  name="is_grade_up"   lay-skin="switch" lay-filter="is_grade_up" lay-text="是|否" value="<?php echo $list['is_grade_up'] ?>">
                            </div>
                        </div>

                        <div class="layui-form-item" >
                            <label class="layui-form-label">等级值</label>
                            <div class="layui-input-inline title">
                                <input type="text" name="grade" required lay-verify="required|number" placeholder="请输入等级值" autocomplete="off" class="layui-input" value="<?php echo $list['grade'] ?>">
                            </div>
                            <div class="layui-form-mid layui-word-aux">*升级顺序，取值范围1-100，等级值越大，会员等级越高。</div>
                        </div>
                        <div class="layui-form-item" >
                            <label class="layui-form-label">升级所需积分</label>
                            <div class="layui-input-inline title">
                                <input type="text" name="upgrade_exp" required lay-verify="required|number"  autocomplete="off" class="layui-input"  value="<?php echo $list['upgrade_exp'] ?>">
                            </div>
                            <div class="layui-form-mid layui-word-aux">*自动升级所需要的积分。</div>
                        </div>

                        <div class="layui-form-item" >
                            <label class="layui-form-label">初始金额</label>
                            <div class="layui-input-inline sort">
                                <input type="text" name="amount" required lay-verify="required|number"  autocomplete="off" class="layui-input"  value="<?php echo $list['amount'] ?>"><span>元</span>
                            </div>
                            <div class="layui-form-mid layui-word-aux">*自动到该会员组赠送的金额，负数则扣减</div>
                        </div>

                        <div class="layui-form-item" >
                            <label class="layui-form-label">初始积分</label>
                            <div class="layui-input-inline sort">
                                <input type="text" name="point" required lay-verify="required|number"  autocomplete="off" class="layui-input" value="<?php echo $list['point'] ?>"><span>分</span>
                            </div>
                            <div class="layui-form-mid layui-word-aux">*自动到该会员组赠送的积分，负数则扣减。</div>
                        </div>

                        <div class="layui-form-item" >
                            <label class="layui-form-label">购物折扣</label>
                            <div class="layui-input-inline sort">
                                <input type="text" name="discount" required lay-verify="required|number"  autocomplete="off" class="layui-input" value="<?php echo $list['discount'] ?>">
                            </div>
                            <div class="layui-form-mid layui-word-aux">*购物享受的折扣，取值范围：1-100。</div>
                        </div>

                    </div>
                </div>
                <div class="layui-form-item form_btn">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        <input type="hidden" name="id" value="<?php echo $list['id']; ?>">
                    </div>
                </div>
        </form>
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
                        
                 

                        //switch事件监听
                        form.on('switch', function (data) {
                            console.log(data.elem); //得到checkbox原始DOM对象
                            console.log(data.elem.checked); //是否被选中，true或者false
                            console.log(data.value); //复选框value值，也可以通过data.elem.value得到
                            console.log(data.othis); //得到美化后的DOM对象
                            if (data.elem.checked === true) {
                                if (data.value == "1") {
                                    data.othis.removeClass("layui-form-onswitch");
                                    $(data.othis).children("em").text("否");
                                    data.elem.value = "0";
                                } else {
                                    data.othis.addClass("layui-form-onswitch");
                                    $(data.othis).children("em").text("是");
                                    data.elem.value = "1";
                                }
                            } else {
                                if (data.value == "1") {
                                    data.othis.removeClass("layui-form-onswitch");
                                    $(data.othis).children("em").text("否");
                                    data.elem.value = "0";
                                } else {
                                    data.othis.addClass("layui-form-onswitch");
                                    $(data.othis).children("em").text("是");
                                    data.elem.value = "1";
                                }
                            }
                        });

                        window.onload = function () {
                            $('input:checkbox').each(function () {
                                if ($(this).val() == 0) {
                                    $(this).next('div').removeClass('layui-form-onswitch');
                                    $(this).next('div').children("em").text("否");
                                } else {
                                    $(this).next('div').addClass('layui-form-onswitch');
                                    $(this).next('div').children("em").text("是");
                                }
                            });
                        }

                    });
    </script>      
<script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/common.js"></script>
</html>