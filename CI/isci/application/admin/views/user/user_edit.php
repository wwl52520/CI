<?php ?>
<html
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>会员新增——新增</title>
        <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
        <style>
            .uploads{padding: 0!important}
             .layui-form-checkbox i{top:0px!important}
        </style>

    </head>
    <div id="main">
            <div class="layui-row new_nav">
                <span class="layui-breadcrumb" lay-separator="">
                    <a href="#" onclick="javascript :history.back(-1);"><i class="layui-icon icon iconfont">&#xe62f;</i>返回上一页</a>
                    <a href="<?php echo site_url()?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
                    <a href="javascript:;">会员新增</a>
                </span>
            </div>
  
            <form class="layui-form layui-form-pane" action="<?php echo site_url()?>User/edit" method="post"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
                <div class="layui-tab">
                    <ul class="layui-tab-title">
                        <li class="layui-this">基本信息</li>
                         <li >账户信息</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item  tab_content layui-show" pane>
                            <div class="layui-form-item">
                                <label class="layui-form-label">会员组别</label> 
                                <div class="layui-input-block">
                                    <select name="city" lay-verify="required" >
                                        <option></option>
                                        <?php
                                        foreach ($user_group as $group) {
                                            if($group['id'] == $list['group_id']) {
                                                echo " <option selected='selected'  value=" . $group['id'] . " > " . $group['title'] . "</option>";
                                            } else {
                                                echo " <option   value=" . $group['id'] . " > " . $group['title'] . "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" name="group_id" value="<?php echo $list['group_id']?>">
                                </div>
                            </div>
                                      <div class="layui-form-item" >
                                <label class="layui-form-label">账号状态</label>
                                <div class="layui-input-block">
                                    <?php
                                    if ($list['status'] == "1")
                                    {
                                        echo '<input type="radio" name="status" value="1"  title="启用" checked>';
                                    echo '<input type="radio" name="status" value="0" title="禁用" >';
                                    echo '<input type="radio" name="status" value="2" title="待审核">';
                                    }
                                    else if ($list['status'] == "0") {
                                        echo '<input type="radio" name="status" value="1"  title="启用" >';
                                        echo '<input type="radio" name="status" value="0" title="禁用" checked>';
                                        echo '<input type="radio" name="status" value="2" title="待审核">';
                                    } else {
                                        echo '<input type="radio" name="status" value="1"  title="启用" >';
                                        echo '<input type="radio" name="status" value="0" title="禁用" >';
                                        echo '<input type="radio" name="status" value="2" title="待审核" checked>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">用户名</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="user_name" required lay-verify="user_name"  class="layui-input" value="<?php echo $list['user_name']; ?>">
                                </div>
                                <div class="layui-form-mid layui-word-aux loads">*登录的用户名</div>
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">密码</label>
                                <div class="layui-input-inline title">
                                    <input type="password" name="password" required lay-verify="pass" placeholder="请输入密码" autocomplete="off" class="layui-input" value="<?php echo base64_decode($list['password']);  ?>">
                                </div>
                                <div class="layui-form-mid layui-word-aux">*登录的密码，至少6位</div>
                                </div>
                                <div class="layui-form-item" >
                                    <label class="layui-form-label">昵称</label>
                                    <div class="layui-input-inline title">
                                        <input type="text" name="nickname" required lay-verify="required" placeholder="请输入昵称" autocomplete="off" class="layui-input" value="<?php echo $list['nickname']; ?>" >
                                    </div>
                                </div>
                                <div class="layui-form-item" >
                                    <label class="layui-form-label">联系方式</label>
                                    <div class="layui-input-inline title">
                                        <input type="text" name="tel" required lay-verify="required|phone" placeholder="请输入联系方式" autocomplete="off" class="layui-input" value="<?php echo $list['tel']; ?>" >
                                    </div>
                                </div>
                            
                               <div class="layui-form-item" >
                                    <label class="layui-form-label">邮箱账号</label>
                                    <div class="layui-input-inline title">
                                        <input type="text" name="email" required lay-verify="required|email" placeholder="请输入邮箱账号" autocomplete="off" class="layui-input" value="<?php echo $list['email']; ?>" >
                                    </div>
                                      <div class="layui-form-mid layui-word-aux">*取回密码时用</div>
                                </div>
                                <div class="layui-form-item" >
                                <label class="layui-form-label">生日日期</label>
                                <div class="layui-input-inline" style="position:relative;">
                                    <input type="text" name="birthaday" value="<?php echo  Date('Y-m-d',$list['birthaday'])?>" class="layui-input" id="addate">
                                    <i class="layui-icon add_time">&#xe637;</i>
                                </div>
                            </div>
                             <div class="layui-form-item" >
                                    <label class="layui-form-label">通讯地址</label>
                                    <div class="layui-input-inline title">
                                        <input type="text" name="address" placeholder="请输入通讯地址" autocomplete="off" class="layui-input" value="<?php echo $list['address']; ?>" >
                                    </div>
                                </div>
                                <div class="layui-form-item" >
                                    <label class="layui-form-label">图片上传</label>
                                    <div class="layui-input-inline title">
                                        <input type="text" name="img"　 class="layui-input" value="<?php echo $list['img']; ?>">
                                    </div>
                                    <div class="layui-form-mid layui-word-aux uploads">
                                        <button type="button" class="layui-btn" id="upload">
                                            <i class="layui-icon ">&#xe67c;</i>上传图片
                                        </button>
                                    </div>
                                    <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;display: none">
                                        预览图：
                                        <div class="layui-upload-list" id="demo2"></div>
                                </div>
                            
                                <div class="layui-form-item" >
                                <label class="layui-form-label">性别</label>
                                <div class="layui-input-block">
                                     <?php
                                    if ($list['sex'] == "男")
                                    {
                                        echo '<input type="radio" name="sex" value="男"  title="男" checked>';
                                       echo '<input type="radio" name="sex" value="女" title="女" >';
                                        echo '<input type="radio" name="sex" value="保密" title="保密" >';
                                    }
                                    else if ($list['sex'] == "女") {
                                           echo '<input type="radio" name="sex" value="男"  title="男" >';
                                       echo '<input type="radio" name="sex" value="女" title="女" checked>';
                                        echo '<input type="radio" name="sex" value="保密" title="保密" >';
                                    } else {
                                           echo '<input type="radio" name="sex" value="男"  title="男" >';
                                       echo '<input type="radio" name="sex" value="女" title="女" >';
                                        echo '<input type="radio" name="sex" value="保密" title="保密" checked>';
                                    }
                                    ?>
                                </div>
                            </div>
                            </div>
                        <div class="layui-tab-item  tab_content" pane>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">账户金额</label>
                                <div class="layui-input-inline sort">
                                    <input type="text" name="amount"  autocomplete="off" class="layui-input" value="<?php echo $list['amount']; ?>" ><span>元</span>
                                </div>
                                <div class="layui-form-mid layui-word-aux">*账户上的余额</div>
                            </div>
                            
                              <div class="layui-form-item" >
                                <label class="layui-form-label">账户积分</label>
                                <div class="layui-input-inline sort">
                                    <input type="text" name="point"    autocomplete="off" class="layui-input" value="<?php echo $list['point']; ?>"><span>分</span>
                                </div>
                                <div class="layui-form-mid layui-word-aux">*积分也可做为交易</div>
                            </div>
                            
                               <div class="layui-form-item" >
                                <label class="layui-form-label">经验值</label>
                                <div class="layui-input-inline sort">
                                    <input type="text" name="exp"   autocomplete="off" class="layui-input" value="<?php echo $list['exp']; ?>" >
                                </div>
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

        <script>
            layui.use(['jquery', 'form','laydate', 'layer','upload', 'element'], function () {
                var form = layui.form;
                var upload = layui.upload;
                var element = layui.element;
                var laydate = layui.laydate;
                window.jQuery = window.$ = layui.jquery;
                   
        

   //执行一个laydate实例
                laydate.render({
                   elem:'#addate'
                 });
              // 执行图片上传实例
              var uploadInst=upload.render({
                  elem:'#upload'
                  ,field:'userfile'                                 //定义上传文件的name值
                  ,url:'<?php echo site_url().$this->router->fetch_class()?>/return_img'
                //  ,multiple:true    //允许上传多个
                 // ,auto:false      //不自动上传
                 // .,bindAction:'#upload'
                  ,before:function(obj)
                  {                
                      obj.preview(function(index,file,result)
                      {
                        //  console.log(index); //得到文件索引
                        //  console.log(file); //得到文件对象
                       //   console.log(result); //得到文件base64编码，比如图片
                       //   $('#demo2').append('<img src="'+result+'" alt="'+file.name+'" class="layiui-upload-img">'); //预览图
                    });
                  }
                  ,done:function(res)
                  {
                  $("input[name='img']").attr('value',res.data);
                  }
                  ,error:function()
                  {
                      alert('上传接口有误');
                  }
              });
              //select下拉框的事件监听
              form.on('select',function(data)
              {
                    console.log(data.elem); //得到select原始DOM对象
                    console.log(data.value); //得到被选中的值
                    console.log(data.othis); //得到美化后的DOM对象
                   
               $("input[name='group_id']").attr('value',data.value);
              });


              form.verify(
              {
                username:function(value,item)
                {
                    if(value.length<6)
                    {
                        return '标题至少得6个字符啊';
                    }
                   if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value))
                   {
                        return '用户名不能有特殊字符';
                   }
                   if(/(^\_)|(\__)|(\_+$)/.test(value))
                   {
                       return '用户名首尾不能出现下划线\'_\'';
                   }
                   if(/^\d+\d+\d$/.test(value))
                   {
                      return '用户名不能全为数字';
                   }
                
                   if(/[\u4e00-\u9fa5]/.test(value))
                   {
                         return '用户名不能包含中文汉字';
                   }
                }
                ,pass:[
                         /^[\S]{6,12}$/
                     ,'密码必须6到12位，且不能出现空格'
    ]
             });
  $("input[name='user_name']").blur(function () {
            var $uname = $(this).val();
            var $id=$("input[name='id']").val();
            $(".loads").text("正在检测...");
            $.ajax({
                url: '<?php echo site_url().$this->router->fetch_class(); ?>/get_username',
                type: 'post',
                data: {
                    'uname': $uname,'id':$id
                },
                error: function () {}, success: function (data) {
                    if (data > 0) {
                        $("input[name='user_name']").focus();
                        $(".loads").text("× 该用户名已被占用,请更换！");
                        $(".loads").addClass("red");
                    } else {
                        $(".loads").addClass('oks');
                        $(".loads").text("√ 用户名可以使用！");
                    }
                }
            });
        });
           
            });
        </script>      
   <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/common.js"></script>
</html>