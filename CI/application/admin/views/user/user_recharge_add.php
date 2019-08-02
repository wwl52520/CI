<?php ?>
<html
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>会员充值</title>
        <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
        <style>
            .uploads{padding: 0!important}
   
        </style>

    </head>
    <div id="main">
        <div class="layui-row new_nav">
            <span class="layui-breadcrumb" lay-separator="">
                <a href="#" onclick="javascript :history.back(-1);"><i class="layui-icon icon iconfont">&#xe62f;</i>返回上一页</a>
                <a href="<?php echo site_url()?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
                <a href="javascript:;">会员充值</a>
            </span>
        </div>
        <form class="layui-form layui-form-pane" action="<?php echo site_url() ?>User_recharge/add" method="post"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
            <div class="layui-tab">
                <ul class="layui-tab-title">
                    <li class="layui-this">充值信息</li>
                </ul>
                <div class="layui-tab-content">
                    <div class="layui-tab-item  tab_content layui-show" pane>
                        <div class="layui-form-item">
                            <label class="layui-form-label">会员组别</label>
                            <div class="layui-input-block">
                                <select name="payment_id" lay-verify="required" >
                                    <option></option>
                                    <option value="4">账户余额</option>
                                    <option value="2">支付宝</option>
                                </select>
                              
                            </div>
                        </div>
                        <div class="layui-form-item" >
                            <label class="layui-form-label">用户名</label>
                            <div class="layui-input-inline title">
                                <input type="text" name="user_name" readonly onfocus="this.removeAttribute('readonly');" required lay-verify="user_name" placeholder="请输入用户名" autocomplete="off" class="layui-input">
                            </div>
                            <div class="layui-form-mid layui-word-aux loads">*登录的用户名</div>
                        </div>

                        <div class="layui-form-item" >
                            <label class="layui-form-label">订单号</label>
                            <div class="layui-input-inline title">
                                <input type="text" name="recharge_no" readonly="readonly"  autocomplete="off" class="layui-input" value="<?php echo Date('ymdHis') . rand(1, 99); ?>">
                            </div>
                            <div class="layui-form-mid layui-word-aux">*系统随机生成订单号</div>
                        </div>

                        <div class="layui-form-item" >
                            <label class="layui-form-label">充值金额</label>
                            <div class="layui-input-inline sort">
                                <input type="text" name="amount"  autocomplete="off" class="layui-input"><span>元</span>
                            </div>
                            <div class="layui-form-mid layui-word-aux">*给该会员充值的金额，负数则扣减。</div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item form_btn">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        <input type="hidden" name="user_id" >
                    </div>
                </div>
        </form>
    </div>
    <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/iconfont.js"></script>
    <script>
                                    layui.use(['jquery', 'form', 'layer', 'element'], function () {
                                        var form = layui.form;
                                        var upload = layui.upload;
                                        var element = layui.element;
                                        var laydate = layui.laydate;
                                        window.jQuery = window.$ = layui.jquery;

                                        $("input[name='user_name']").blur(function () {
                                            var $uname = $(this).val();
                                           
                                            if($uname.length<6)
                                            {
                                                $(".loads").text("× 会员号不存在小于6位数！");
                                                  $(".loads").addClass('oks');
                                            }
                                            else
                                            {
                                             $(".loads").text("正在检测...");
                                            $.ajax({
                                                url: '<?php echo site_url() . $this->router->fetch_class(); ?>/get_username',
                                                type: 'post',
                                                data: {
                                                    'uname': $uname
                                                },
                                                error: function () {}, success: function (data) {
                                                    if (data == 0) {
                                                        $("input[name='user_name']").focus();
                                                        $(".loads").text("× 该用户名不存在,请输入正确的会员名称！");
                                                        $(".loads").addClass("red");
                                                    } else {
                                                        $(".loads").addClass('oks');
                                                        $(".loads").text("√");
                                                        $("input[name='user_id']").attr('value',data);
                                                    }
                                                }
                                            });
                                            }
                                        });
                                    });
    </script>      
<script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/common.js"></script>
</html>