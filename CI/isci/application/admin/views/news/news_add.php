<?php ?>
<html
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>新闻——新增</title>
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
    <body>

        <div id="main">
            <div class="layui-row new_nav">
                <span class="layui-breadcrumb" lay-separator="">
                    <a href="#" onclick="javascript :history.back(-1);"><i class="layui-icon icon iconfont">&#xe62f;</i>返回上一页</a>
                    <a href="<?php echo site_url()?>Index/main"><i class="layui-icon">&#xe68e;</i>首页</a>
                    <a href="javascript:;">内容列表</a>
                </span>
            </div>
            <form class="layui-form layui-form-pane" action="<?php echo site_url()?>News/add" method="post"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
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
                                    <select name="city" lay-verify="required" >
                                        <option></option>
                                        <?php echo $cate; ?>
                                    </select>
                                    <input type="hidden" name="NewType" value="">
                                </div>
                            </div>
                                 <div class="layui-form-item" >
                                <label class="layui-form-label">审核状态</label>
                                <div class="layui-input-block" >
                                          <input type="hidden" name="Status" value="0" >
                                    <input type="checkbox" name="Status"  checked lay-skin="switch" value="1" lay-filter="status" lay-text="启用|禁用">
                                    
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
                                </div>
                            </div>
                            
                            <div class="layui-form-item" >
                                <label class="layui-form-label">文章标题</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="title" required lay-verify="required" placeholder="请输入文章标题" autocomplete="off" class="layui-input">
                                </div>
                                  <div class="layui-form-mid layui-word-aux">标题最多100个字符</div>
                            </div>
                            
                   
                            
                               <div class="layui-form-item" >
                                <label class="layui-form-label">图片上传</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="Img" placeholder="请输入" autocomplete="off"　 class="layui-input">
                                   
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
                                    <input type="text" name="addate" value="<?php echo  Date('Y-m-d H:i', time())?>" class="layui-input" id="addate">
                                   
                                    <i class="layui-icon add_time">&#xe637;</i>
                              
                                </div>
                            </div>
                            
                          
                        
                        </div>
                        <div class="layui-tab-item tab_content"> 
                         <div class="layui-form-item" >
                                <label class="layui-form-label">信息来源</label>
                                <div class="layui-input-inline title">
                                    <input type="text" name="source" placeholder="请输入信息来源" autocomplete="off" class="layui-input">
                                </div>
                                  <div class="layui-form-mid layui-word-aux">非必填,最多30个字</div>
                            </div>
                         <div class="layui-form-item" >
                                    <label class="layui-form-label">文章作者</label>
                                <div class="layui-input-inline sort">
                                    <input type="text" name="author" placeholder="作者" autocomplete="off" class="layui-input">
                                </div>
                                <div class="layui-form-mid layui-word-aux">非必填</div>
                            </div>
                        <div class="layui-form-item" style="width:100%" >
                                    <label class="layui-form-label">内容</label>
                                <div class="layui-input-inline content">
                                      <textarea id="content" name="Content" style="width: 94%;height:400px" >
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
      

                 //执行一个laydate实例
                laydate.render({
    elem: '#addate',
     type:'datetime',
     format:'yyyy-MM-dd HH:mm'
     });
              // 执行图片上传实例
              var uploadInst=upload.render({
                  elem:'#upload'
                  ,field:'userfile'      //定义上传文件的name值
                  ,url:'<?php echo site_url().$this->router->fetch_class()?>/return_img'
               //  ,multiple:true    //允许上传多个
               // ,auto:false      //不自动上传
               // ,bindAction:'#upload'
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
                  $("input[name='Img']").attr('value',res.data);
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
                   
               $("input[name='NewType']").attr('value',data.value);
              });
              
              //switch事件监听
              form.on('switch(Status)',function(data)
              {
               // console.log(data.elem); //得到checkbox原始DOM对象
               // console.log(data.elem.checked); //是否被选中，true或者false
               //  console.log(data.value); //复选框value值，也可以通过data.elem.value得到
               // console.log(data.othis); //得到美化后的DOM对象
                if(data.elem.checked ===true)
                {
                  $("input[name='Status']").attr('value',1);
                }
                else
                {
                     $("input[name='Status']").attr('value',0);
                }
            
              });
               //checkox事件监听
              form.on('checkbox',function(data)
              {
                   if(data.elem.checked ===true)
                {
               data.elem.value="1";
                }
                else
                {
                     data.elem.value="0";
                }
              });
    
                KindEditor.ready(function (K) {
                    var editor1 = K.create('textarea[name="Content"]', {
                        cssPath: '"<?php echo site_url(); ?>other/kindeditor/plugins/code/prettify.css',
                        uploadJson: '"<?php echo site_url(); ?>other/kindeditor/php/upload_json.php',
                        fileManagerJson: '"<?php echo site_url(); ?>other/kindeditor/php/file_manager_json.php',
                        allowFileManager: true,
                        afterCreate: function () {
                            var self = this;
                            K.ctrl(document, 13, function () {
                                self.sync();
                                K('form[name=example]')[0].submit();
                            });
                            K.ctrl(self.edit.doc, 13, function () {
                                self.sync();
                                K('form[name=example]')[0].submit();
                            });
                        }
                    });
                });
            });
        </script>     
                <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
                <script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/common.js"></script>
   </body>
</html>