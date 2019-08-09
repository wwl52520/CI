<?php ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>首页</title> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/layui.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(''); ?>other/layui/css/iconfont.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>other/_admin/css/index.css" media="all" />
    </head>
    <body  style="overflow-y: hidden">
         <?php $this->load->view('header'); ?>
        <div class="layui-index-main">
           <?php $this->load->view('left_Nav'); ?>
            <div class="layui-right">
                <iframe   class="layui-iframe" data-id='0' src="<?php echo site_url() ?>Index/main"></iframe>
            </div>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/layui.all.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>other/layui/iconfont.js"></script>
        <script>
        layui.use(['jquery','form','element'],function(){
        var element=layui.element;
        window.jQuery = window.$ = layui.jquery;
       $(".layui-left").height($(window).height());
       $(".layui-right").width($(document).width()-200);
       $(".layui-iframe").height($(window).height());
       $(".layui-nav-left li").click(function()
       {
          var index=$(this).index();
          $(".layui-left ul").eq(index).show();
          $(".layui-left ul").eq(index).siblings("ul").hide();
       });
       $(".layui-nav-child dd a").click(function()
       {
            $url=$(this).attr("data-url");
            $(".layui-iframe").attr("src",$url);
       });
       
       //屏幕发生变化，高度相应变化
                       $(window).resize(function(){
                              $("body").css('overflow-y','auto');
                                     $(".layui-left").height($(window).height());
                                    $(".layui-right").width($(window).width()-200);
                                    $(".layui-iframe").height($(window).height());
                         });   
        //session存储本页面，F5刷新时保证页面不会丢失
        //这里是设置了一个值，页面刷新时 页面会自动跳到main.php下面，该文件下则将设置的值赋给iframe的src，从而使地址得到保存
        var links = window.localStorage.getItem("thisurl");
        var ids=window.localStorage.getItem("thisid");
        var left_id=window.localStorage.getItem("this_left_id");
        console.log(left_id+"s");
        if(ids !=null)
        { 
            $("#"+ ids).siblings("li").removeClass('layui-this').end().addClass('layui-this');
            $data=ids.split("_");
            $(".layui-left ul").eq($data[1]-1).removeClass("layui-tab-item").end()
            $(".layui-left ul").eq($data[1]-1).siblings("ul").addClass("layui-tab-item");
        }
        if (links != null) {
            $(".layui-iframe").attr('src', links);
        } 
          if(left_id !="undefined" && left_id !=null)
        { 
            $("#"+ left_id).siblings("dd").removeClass('layui-this').end().addClass('layui-this');
            $("#"+ left_id).parents(".layui-nav-item").addClass("layui-nav-itemed");
            $("#"+ left_id).parents(".layui-nav-item").siblings().removeClass("layui-nav-itemed");
        }   
});
      

        </script>
<script type="text/javascript" src="<?php echo base_url(); ?>other/_admin/js/jquery_3.3.1.min.js"></script>
        <script>
         //退出
    function  quit($url)
    {
        $.ajax({
            url:$url,
            type:"post",
            success:function(data)
            {
                window.localStorage.clear();
                window.location.href="<?php echo site_url('Login/index');?>";
            },
            error:function()
            {
                alert('退出错误!');
            }
        })
    }
        </script>
    </body>
</html>
