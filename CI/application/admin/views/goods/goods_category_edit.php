<?php ?>
<html
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>商品分类——新增</title>
        <meta http-equiv="X-UA-Compatible" content="IE=emulateIE7" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/layui/css/layui.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/layui/css/iconfont.css" media="all" />
        <style>
            .uploads{padding: 0!important}
        </style>

    </head>
    <body>

        <div id="main">
            <div class="layui-row new_nav">
                <span class="layui-breadcrumb" lay-separator="">
                    <a href="<?php echo "<script>history.go(-1);</script>"; ?>"><i class="layui-icon icon iconfont">&#xe62f;</i>返回上一页</a>
                    <a href="<?php echo site_url()?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
                    <a href="javascript:;">分类编辑</a>
                </span>
            </div>
            <form class="layui-form layui-form-pane" action="<?php echo site_url() ?>Goods_category/edit" method="post"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
                <div class="layui-tab">
                    <ul class="layui-tab-title">
                        <li class="layui-this">基本信息</li>
                        <li>SEO选项</li>
                    </ul>
                    <div class="layui-tab-content">
                        <div class="layui-tab-item  tab_content layui-show" pane>

                            <div class="layui-form-item">
                                <label class="layui-form-label">所属类别</label>
                                <div class="layui-input-block">
                                    <select name="city" lay-verify="required" >
                                        <option></option>
                                           <option value="0">无父级栏目</option>
                         <?php echo $cate;?>
                                    </select>
                                    <input type="hidden" name="pid" value="">
                                </div>
                            </div>

                            <div class="layui-form-item" >
                                <label class="layui-form-label">分类名称</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="category_Name" required lay-verify="required" placeholder="请输入分类名称" autocomplete="off" class="layui-input" value="<?php echo $list['category_Name'];?>">
                                </div>
                            </div>
                            
                                <div class="layui-form-item" >
                                <label class="layui-form-label">图片上传</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="img" placeholder="请输入" autocomplete="off"　 class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux uploads">
                                    <button type="button" class="layui-btn" id="upload">
                                        <i class="layui-icon ">&#xe67c;</i>上传图片
                                    </button>
                                </div>
                            </div>

                            <div class="layui-form-item" >
                                <label class="layui-form-label">排序数字</label>
                                <div class="layui-input-inline sort">
                                    <input type="text" name="sort" placeholder="99" autocomplete="off" class="layui-input" value="<?php echo $list['sort'];?>">
                                </div>
                                <div class="layui-form-mid layui-word-aux">数字越小,越靠前</div>
                            </div>
                        </div>
                        <div class="layui-tab-item tab_content ">

                            <div class="layui-form-item" >
                                <label class="layui-form-label">SEO标题</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="seo_title" placeholder="请输入文章标题" autocomplete="off" class="layui-input" value="<?php echo $list['seo_title'];?>">
                                </div>
                                <div class="layui-form-mid layui-word-aux">标题最多50个字符</div>
                            </div>
                            <div class="layui-form-item" >
                                <label class="layui-form-label">SEO关键字</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="seo_keywords" placeholder="请输入文章标题" autocomplete="off" class="layui-input" value="<?php echo $list['seo_keywords'];?>">
                                </div>
                                <div class="layui-form-mid layui-word-aux">关键字最多100个字符</div>
                            </div>

                            <div class="layui-form-item layui-form-text ">
                                <label class="layui-form-label">SEO描述</label>
                                <div class="layui-input-block">
                                    <textarea name="seo_description" placeholder="请输入内容" class="layui-textarea"><?php echo $list['seo_description'];?></textarea>
                                </div>
                                <div class="layui-form-mid layui-word-aux">描述最多个字符</div>
                            </div>
                        </div>
                    </div>
                    <div class="layui-form-item form_btn">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            <input type="hidden" name="id" value="<?php echo $list['id']?>">
                        </div>
                    </div>
            </form>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/iconfont.js"></script>
        <script>
           layui.use(['jquery', 'form','upload', 'element'], function () {
                var form = layui.form;
                var upload = layui.upload;
                var element = layui.element;
                window.jQuery = window.$ = layui.jquery;
           
            //图片上传
                upload.render({
                  elem:'#upload'
                  ,field:'userfile'      //定义上传文件的name值
                  ,url:'<?php echo site_url().$this->router->fetch_class()?>/return_img'
               //  ,multiple:true    //允许上传多个
               // ,auto:false      //不自动上传
               // ,bindAction:'#upload'
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
                form.on('select', function (data)
                {
                    console.log(data.elem); //得到select原始DOM对象
                    console.log(data.value); //得到被选中的值
                    console.log(data.othis); //得到美化后的DOM对象

                    $("input[name='pid']").attr('value', data.value);
                });
            });
        </script>
        
           <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/common.js"></script>
    </body>
</html>