<?php ?>
<html
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>管理员信息——编辑</title>
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
                    <a href="javascript:;">内容列表</a>
                </span>
            </div>
        <?php echo validation_errors(); ?>
        
<?php 
$attribut=array('class'=>'layui-form layui-form-pane');
echo form_open(site_url()."Admin/edit",$attribut); 
?>
       <!--  <form class="layui-form layui-form-pane" action="<?php echo site_url()?>admin/edit" method="post">--> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
                <div class="layui-tab">
                    <ul class="layui-tab-title">
                        <li class="layui-this">基本信息</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item  tab_content layui-show" pane>
                            <div class="layui-form-item">
                                <label class="layui-form-label">角色选择</label>
                                <div class="layui-input-block">
                                    <select name="city" lay-verify="required" >
                                        <option></option>
                                        <?php foreach ($admin_role as $role): ?>
                                            <?php if ($role['id'] == $admin_list['role_id']): ?>
                                                <option selected="selected"  value="<?php echo $role['id'] ?>" ><?php echo $role['role_name'] ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo $role['id'] ?>" ><?php echo $role['role_name'] ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <input type="hidden" name="role_id" value="<?=$admin_list['role_id']?>">
                                </div>
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">状态</label>
                                <div class="layui-input-block" >
                                     <input type="hidden" name="islock">
                                    <input type="checkbox" name="islock"  checked lay-skin="switch" value="<?=$admin_list['islock']?>" lay-filter="islock" lay-text="是|否">
                                </div>
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">用户名</label>
                                <div class="layui-input-inline title">
                                   
                                    <input type="text" name="UserName"  required lay-verify="username" placeholder="请输入用户名" autocomplete="off" readonly="readonly" class="layui-input" value="<?=$admin_list['UserName']?>">
                                </div>
                                <div class="layui-form-mid layui-word-aux loads">*请输入有效的用户名</div>
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">密码</label>
                                <div class="layui-input-inline title">
                                    <input type="password" name="Password" required lay-verify="pass" placeholder="请输入密码" autocomplete="off" class="layui-input" value="0_0_0_0">
                                </div>
                                <div class="layui-form-mid layui-word-aux">*请输入有效的密码</div>
                                </div>
                                <div class="layui-form-item" >
                                    <label class="layui-form-label">昵称</label>
                                    <div class="layui-input-inline title">
                                        <input type="text" name="nikename" required lay-verify="required" placeholder="请输入昵称" autocomplete="off" class="layui-input" value="<?=$admin_list['nikename']?>">
                                    </div>
                                </div>
                                <div class="layui-form-item" >
                                    <label class="layui-form-label">电话号码</label>
                                    <div class="layui-input-inline title">
                                        <input type="text" name="telephone" required lay-verify="required|phone" placeholder="请输入昵称" autocomplete="off" class="layui-input"  value="<?=$admin_list['telephone']?>">
                                    </div>
                                </div>
                                <div class="layui-form-item" >
                                    <label class="layui-form-label">图片上传</label>
                                    <div class="layui-input-inline title">
                                        <input type="text" name="img" placeholder="请输入" autocomplete="off"　 class="layui-input" value="<?=$admin_list['img']?>">
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
                            </div>
                        </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        <input type="hidden" name="id" value="<?=$admin_list['ID']?>">
                         <input type="hidden" name="salt" value="<?=$admin_list['salt']?>">
                         <input type="hidden" name="is_pass" value="<?=$admin_list['Password']?>">
                    </div>
                </div>
            </form>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/iconfont.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/kindeditor/kindeditor.js"></script>  
        <script charset="utf-8" src="<?php echo base_url(); ?>other/kindeditor/lang/zh-CN.js"></script>
        <script>
            layui.use(['jquery', 'form','laydate', 'layer','upload', 'element'], function () {
                var form = layui.form;
                var upload = layui.upload;
                var element = layui.element;
                var laydate = layui.laydate;
                window.jQuery = window.$ = layui.jquery;
     

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
                   
               $("input[name='role_id']").attr('value',data.value);
              });
              
              //switch事件监听
              form.on('switch(islock)',function(data)
              {
               // console.log(data.elem); //得到checkbox原始DOM对象
               // console.log(data.elem.checked); //是否被选中，true或者false
               //  console.log(data.value); //复选框value值，也可以通过data.elem.value得到
               // console.log(data.othis); //得到美化后的DOM对象
                if(data.elem.checked ===true)
                {
                  $("input[name='islock']").attr('value',1);
                } 
                else
                {
                     $("input[name='islock']").attr('value',0);
                }
            
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
                }
                ,pass:[
                         /^[\S]{6,33}$/
                     ,'密码必须6到12位，且不能出现空格'
    ]
             }); 
               //checkox事件监听
              form.on('checkbox',function(data)
              {
                    console.log(data.elem); //得到checkbox原始DOM对象
                    console.log(data.elem.checked); //是否被选中，true或者false
                    console.log(data.value); //复选框value值，也可以通过data.elem.value得到
                    console.log(data.othis); //得到美化后的DOM对象
                  
                   if(data.elem.checked ===true)
                {
                 $(this).attr('value',1);
                }
              });
     $("input[name='UserName']").blur(function () {
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
                        $("input[name='UserName']").focus();
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