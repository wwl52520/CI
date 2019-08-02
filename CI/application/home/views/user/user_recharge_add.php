<?php ?>
<html
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>新增会员组别</title>
        <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/skin_/nav.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/skin_/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/jquery.grid.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/css/admin.css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>other/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/js/WdatePicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/kindeditor/kindeditor.js"></script>  
        <script charset="utf-8" src="<?php echo base_url(); ?>other/kindeditor/lang/zh-CN.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/js/Common.js"></script>
        <style>
            #main{margin:0px 10px 0 40px;border: 1px solid #eee;padding: 40px}
            #main2{margin:0px 10px 0 40px;border: 1px solid #eee;padding: 40px}
            #main2 .kv-item input[type=text]{width: 50px}
            .subfild{ height:30px;  margin: 25px 20px 0px 40px}
            .subfild .span_one{ border:1px solid #eee;border-bottom: none;display:block;  width:85px; text-align:center; height:30px; line-height:24px;  font-size:14px;float:left;line-height: 30px}
            .subfild .span_two{border:1px solid #eee; border-bottom: none;display:block;  width:85px; text-align:center; height:30px; line-height:24px;  font-size:14px;float:left;line-height: 30px}
            .subfild .span_three{ border:1px solid #eee;border-bottom: none;display:block;  width:85px; text-align:center; height:30px; line-height:24px;  font-size:14px;float:left;line-height: 30px}
            .subfild-content {margin-bottom:25px;}
            .kv-item{height:30px}
            .kv-item.time .kv-item-content{ position:relative;}
            .kv-item.time .kv-item-content .time-icon{position:absolute;right:10px;top:6px;*top:8px;}
            .button{margin-left:40px;margin-top: 25px}
            .kv-item label,.kv-item .kv-item-label{position:relative;float:left;padding-left:7px;width: 8em;height:26px;line-height:26px;}
            .kv-item input[type=text], .kv-item textarea, .kv-item input[type=password], .kv-item input[type=file], .kv-item .file{}
            .test_name{color:Red}
           
        </style>
        <script>
            $(function ()
            {
                $(".kv-item-content input[name='username']").blur(function ()
                {
                    $username = $(this).val();
                    $.ajax({
                        url: '<?php echo base_url() ?>user_recharge/user_test',
                        type: 'post',
                        dataType: '',
                        data: {'user_name': $username},
                        error: function ()
                        {
                            alert(XMLHttpRequest.status);    //XMLHttpRequest 对象
                            alert(XMLHttpRequest.readyState); //错误信息
                            alert(textStatus);                //errorThrown
                        },
                        success: function (data)
                        {

                            if (data==null||data==undefined||data=="")
                            {
                                
                                 $(".test_name").text('该会员账户不存在！');
                                $(".test_name").css("font-weight", 'bold');
                                $(".kv-item-content input[name='username']").focus();
                                
                              
                            } else
                            {
                                  $(".test_name").text('√');
                                  $(" input[name='user_id']").val(data);
                            }

                        }
                    })
                });
            });
        </script>
    </head>
    <body>
        <div id="container">
            <?php $this->load->view('header'); ?>
            <div id="bd">
                <?php $this->load->view('Left_Nav') ?>
                <h3 class="subfild">
                    <span class="span_one">充值信息</span>

                </h3>

                <form method="post" action="<?php echo base_url() ?>user_recharge/add"  id='edit' class="demoform" enctype="multipart/form-data" style="width: 1600px">
                    <div id="main" class="main" >
                        <div class="subfild-content base-info">
                            <div class="kv-item ue-clear">
                                <label><span class="impInfo">*</span>用户名</label>
                                <div class="kv-item-content">
                                    <input type="text" name="username" placeholder="用户名" value=" " />
                                </div>
                                <span class="Validform_checktip test_name">*需要充值的会员用户名</span>
                            </div>
                            <input type="hidden" name="user_id" value="">
                            <div class="kv-item ue-clear">
                                <label>支付方式</label>
                                <div class="kv-item-content xszt">
                                    <a id='1'  href='javascript:void(0)'  class='selected'>账户余额</a>

                                    <input type="hidden"  name="payment_id" value="4">
                                </div>
                            </div>

                        </div>

                        <div class="kv-item ue-clear">
                            <label><span class="impInfo">*</span>订单号</label>
                            <div class="kv-item-content">
                                <input type="text" name="recharge_no" readonly="readonly" placeholder="等级值" value="<?php echo Date('ymdHis') . rand(1, 99); ?>" />
                            </div>
                            <span class="Validform_checktip">*系统随机生成订单号</span>
                        </div>

                     
                        <div class="kv-item ue-clear">
                            <label><span class="impInfo">*</span>充值金额</label>
                            <div class="kv-item-content">
                                <input type="text" name="amount" placeholder="充值金额" value=" " />
                            </div>
                            <span class="Validform_checktip">*自动到该会员组赠送的金额，负数则扣减。</span>
                        </div>
                      
                     
                    </div>
                    <div class="buttons" > 
                        <input class="button"  type="submit" value="确认" />
                        <input type="hidden"  name='btn' value="edit">
                        <input type="hidden"  name='id' value="">
                    </div>
            </div>
        </div>
    </form>

</div>
</div>
</body>
</html>